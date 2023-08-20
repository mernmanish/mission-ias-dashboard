<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB;
use DataTables;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $user = User::orderBy('id','desc')->get();
        // return view('admin.users.all',['user' => $user]);

        if ($request->ajax()) {
            $data = User::select('*')->orderBy('join_date','desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    if(!empty($row->image_link)){
                    return '<img src="' . $row->image_link . '" alt="User Image" style="height:30px">';
                    }
                    else
                    {
                        return '';
                    }
                  })
                  ->rawColumns(['image', 'action','delete'])
                  ->addColumn('action', function ($row) {
                    $btn = '';
                    if ($row->status == 'active') {
                        $btn .= '<span class="badge rounded-pill bg-success">Active</span>';
                    } elseif ($row->status == 'inactive') {
                        $btn .= '<span class="badge rounded-pill bg-danger">Inactive</span>';
                    } else {
                        $btn .= '<span class="badge rounded-pill bg-warning">Block</span>';
                    }
                    return $btn;
                })
                ->addColumn('delete', function ($row) {
                    $del_btn = '';
                    $del_btn .= '<a class="btn btn-sm btn-danger" style="color:#cb2316;" data-href="'.url("delete-user-data/$row->id").'" onclick="deleteItem(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></</a>';
                    return $del_btn;
                })
                ->addColumn('joinDate', function ($row) {
                    $join = date('d-F-Y',strtotime($row->join_date));
                    return $join;
                })

                ->filterColumn('mobile', function ($row, $keyword) {
                    if (stristr(__("mobile"), $keyword))
                        $row->whereHas('mobile', function (Builder $row) {
                            $row->where('mobile', );
                        });
                    })
                // ->rawColumns(['action'])
                ->make(true);

        }

        return view('admin.users.all');
    }

    public function userList(Request $request)
    {
        //
    }

    public function loginUser()
    {
        $user = User::where('is_login','yes')->orderBy('id','desc')->get();
        return view('admin.users.login-user',['user' => $user]);
    }

    public function userBulkUpload()
    {
        return view('admin.users.bulk-upload');
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

    public function importUserExcel(Request $request)
    {
        $this->validator($request->all())->validate();
        $imported_items = array();
        $excel = $request->file('excel');
        $userList = Excel::toArray('test', $excel, ExcelExcel::XLSX);
        $userList = array_slice($userList[0], 1);
        foreach ($userList as $key => $user) {
            if($user[1]==null || empty($user[1]))
            {
                continue;
            }
            $cuDate = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($user[5]))->format('Y-m-d');
            $item = User::create(
                [
                    'id' => $user[0] ?? "",
                    'name' => $user[1] ?? '',
                    'city' => $user[2] ?? '',
                    'email' => $user[3] ?? '',
                    'mobile' => $user[4] ?? '',
                    'password'=>md5($user[4]) ?? "0",
                    'join_date' => $cuDate ?? '',

                ]
            );
                array_push($imported_items, $item);
        }
        if($item){
            return redirect('all-users')->with('message','Excel Uploaded successfully.');
        }
        else{
            return redirect('user-bulk-upload')->with('error','Something Went Wrong !');
        }
    }

    protected function validator(array $data)
    {
        // error_log('$data[number is : ' . $data['number']);
        //  $messages = "Please Fill Details";
        return Validator::make($data, [
            'excel' => ['file', 'mimes:xlsx', 'max:10240'],
        ]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        User::destroy($id);
        return redirect('all-users')->with('message','User Deleted Successfully.');
    }
}
