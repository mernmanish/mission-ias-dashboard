<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB;
use DataTables;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\User;
use App\Models\AssignCourse;
use App\Models\UserPayment;
class AssignCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AssignCourse::select('*')->orderBy('id','desc');
            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('image', function ($row) {
                //     if(!empty($row->image_link)){
                //     return '<img src="' . $row->image_link . '" alt="User Image" style="height:30px">';
                //     }
                //     else
                //     {
                //         return '';
                //     }
                //   })
                  ->rawColumns(['status','actions'])
                  ->addColumn('status', function ($rows) {
                    $btn = '';
                    if ($rows->status == 'active') {
                        $btn .= '<span class="badge rounded-pill bg-success">Active</span>';
                    } elseif ($rows->status == 'inactive') {
                        $btn .= '<span class="badge rounded-pill bg-danger">Inactive</span>';
                    } else {
                        $btn .= '<span class="badge rounded-pill bg-warning">Block</span>';
                    }
                    return $btn;
                })
                // ->rawColumns(['actions'])
                ->addColumn('actions', function ($row) {
                    $actionData = '';
                    $actionData .= '<div class="list-icons">
                    <div class="dropdown">
                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                            <i class="icon-menu9"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a data-href="'.url("delete-assign-course/$row->id").'" onclick="deleteItem(this)" class="dropdown-item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</</a>';
                            if($row['status']=="active"){
                                $actionData .= '<a href="javascript:void(0)"  onclick="changeAssign("'.$row['id'].'","'.$row['status'].'")" class="dropdown-item"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Inactive</</a>';
                            }
                            else{
                              $actionData .= '<a href="javascript:void(0)"  onclick="changeAssign("'.$row['id'].'","'.$row['status'].'")" class="dropdown-item"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Active</</a>';
                            }
                            $actionData .= '</div>
                   </div>
                </div>';
                    return $actionData;
                })
                ->addColumn('joinDate', function ($row) {
                    $join = date('d-M-Y',strtotime($row->join_date));
                    return $join;
                })
                ->addColumn('userName', function ($row) {
                    $user_name = $row->user->name ?? 'N/A';
                    return $user_name;
                })
                ->addColumn('userMobile', function ($row) {
                    $user_mobile = $row->user->mobile ?? 'N/A';
                    return $user_mobile;
                })
                ->addColumn('userCourse', function ($row) {
                    $user_course = $row->course->name ?? 'N/A';
                    return $user_course;
                })
                ->addColumn('expiryDate', function ($row) {
                    $join = date('d-M-Y',strtotime($row->expire_date));
                    return $join;
                })
                // ->rawColumns(['action'])
                ->make(true);
        }
        // $assignData = AssignCourse::orderBy('join_date','desc')->get();
        return view('admin.assign-course.all');
    }

    public function addAssignCourse()
    {
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        return view('admin.assign-course.add',['course'=>$course]);
    }

    public function assignBulkUpload()
    {
        return view('admin.assign-course.bulk-upload');
    }

    public function searchUser(Request $request)
    {
        $mobile = $request->mobile;
        $data = User::where('mobile','LIKE', '%'.$mobile.'%')->latest()->first();
        $data['success']=true;
        return response()->json($data);

    }

    public function getAssignCourse(Request $request)
    {
        $course_id = $request->course_id;
        $data = Course::where('id',$course_id)->latest()->first();
        $data['success']=true;
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();
        $courseDetails = Course::where('id',$request->course_id)->latest()->first();
        $duration = $courseDetails->duration;
        $join_date = date('Y-m-d');
        $pattern = '/\d+/'; // Regular expression to match one or more digits
        $matches = [];
        preg_match_all($pattern, $duration, $matches);
        $numbers = array_map('intval', $matches[0]);
        $months = $numbers[0];
        $expire_date = date('Y-m-d', strtotime($join_date . ' + ' . $months . ' months'));
        $checkCourse = AssignCourse::where(['mobile'=>$request->mobile,'course_id'=>$request->course_id])->count();
        if($checkCourse > 0){
            return redirect('add-assign-course')->with('error','Course Already Assigned.');
        }
        else{
            $data = [
                'user_id' => $request->user_id,
                'mobile' => $request->mobile,
                'course_id' => $request->course_id,
                'amount' => $request->course_fee,
                'join_date' => $join_date,
                'expire_date' => $expire_date,
                'remarks' => $request->remarks
            ];
            //dd($data);
            if($request->id=="")
            {
                $event = AssignCourse::create($data);
                return redirect('all-assign-course')->with('message','Course Assign successfully.');
            }
            else
            {
                $event = AssignCourse::where('id',$request->id)->update($data);
                return redirect('all-assign-course')->with('message','Course Assign Changed successfully.');
            }
        }

    }

    public function import(Request $request)
    {
        $imported_items = array();
        $excel = $request->file('excel');
        $assignList = Excel::toArray('test', $excel, ExcelExcel::XLSX);
        $assignList = array_slice($assignList[0], 1);
        //dd($userList);
        foreach ($assignList as $key => $assign) {
            if($assign[1]==null || empty($assign[1]))
            {
                continue;
            }
            $user = User::where('mobile',$assign[0])->latest()->first();
            if($user)
            {
            $course = Course::where('name','LIKE', '%'.$assign[1].'%')->latest()->first();
            if($course)
            {
            $join_date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($assign[3]))->format('Y-m-d');
            $expire_date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($assign[4]))->format('Y-m-d');
            //dd($course->id);
            $item = AssignCourse::create(
                [
                    'user_id' => $user->id ?? '',
                    'mobile' => $user->mobile ?? '',
                    'course_id' => $course->id ?? '',
                    'amount' => $assign[2] ?? '',
                    'join_date' => $join_date ?? '',
                    'expire_date'=> $expire_date ?? ''
                ]
            );
                array_push($imported_items, $item);
            }
            else{
                return redirect('assign-bulk-upload')->with('error','Course '.$assign[1].' Not Exits Courses');
            }
          }
          else{
            return redirect('assign-bulk-upload')->with('error','Mobile no '.$assign[0].' Not Exits Users');
          }
        }
        if($item){
            return redirect('all-assign-course')->with('message','Excel Import successfully.');
        }
        else{
            return redirect('all-assign-course')->with('error','Something Went Wrong !');
        }
    }
    protected function validator(array $data)
    {
        // error_log('$data[number is : ' . $data['number']);
        //  $messages = "Please Fill Details";
        return Validator::make($data, [
            'mobile' => 'required',
            'course_id' => 'required',
            'course_fee' => 'required',
            'user_name' => 'required'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        AssignCourse::destroy($id);
        return redirect('all-assign-course')->with('message','Course Assign Deleted successfully.');
    }

    public function change(Request $request)
    {
         $batch = AssignCourse::find($request->id);
         $batch->status=$request->status;
         if($request->status=="inactive")
         {
           $batch->id=$request->id;
           $batch->status="active";
         }
         else
         {
            $batch->id=$request->id;
            $batch->status="inactive";
         }
         if($batch->save())
         {
            $data['success']=true;
         }
         else
         {
            $data['success']=false;
         }
        return response()->json($data);
    }

    public function onlinePayment()
    {
        $all = UserPayment::get();
        return view('admin.assign-course.payment-history',['payment' => $all]);
    }
}