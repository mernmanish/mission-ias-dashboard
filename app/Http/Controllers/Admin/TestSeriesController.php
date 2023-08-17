<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\TestSeries;
use App\Models\TestStats;


class TestSeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test = TestSeries::orderBy('id','desc')->get();
        return view('admin.testseries.all',['test' => $test]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        $subCat=SubCategory::where('status','1')->orderBy('id','desc')->get();
        return view('admin.testseries.add',['course'=>$course,'subCat'=>$subCat]);
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
        if(!empty($request->test_category))
        {
            $test_category = implode(",",$request->test_category);
        }
        else{
            $test_category = "";
        }
        if(!empty($request->no_of_question))
        {
            $no_of_question = implode(",",$request->no_of_question);
        }
        else{
            $no_of_question = "";
        }
        $data = [
            'course_id' => $request->course_id,
            'subcategory_id' => $request->subcategory_id,
            // 'dish_type' => $request->dish_type,
            'test_series_name' => $request->test_series_name,
            'price' => $request->price,
            'time' =>  $request->time,
            'post_by' => $request->post_by,
            'test_category' => $test_category,
            'no_of_question' => $no_of_question,
            'description' => $request->description,
            'is_advance_mode' => $request->is_advance_mode,
            'is_support_negative' => $request->is_support_negative,
            'negative_marks' => $request->negative_marks,
            'access' => $request->access,
            'test_type' => $request->test_type
        ];

        if ($request->hasFile('image_link')) {
            $file = $request->file('image_link')->move('testseries', $request->file('image_link')->getClientOriginalName());
            $data['image_link'] = $file->getPathname();
        }
        if($request->id=="")
        {
            $event = TestSeries::create($data);
            return redirect('all-test-series')->with('message','Test Series created successfully.');
        }
        else
        {
            $event = TestSeries::where('id',$request->id)->update($data);
            return redirect('all-test-series')->with('message','Test Series Updated successfully.');
        }
    }
    protected function validator(array $data)
    {
        // error_log('$data[number is : ' . $data['number']);
        //  $messages = "Please Fill Details";
        return Validator::make($data, [
            'course_id' => 'required',
            'subcategory_id' => 'required',
            'description' => 'required',
            'test_series_name' => 'required|string|max:255',
            'price' => 'required',
            'time' => 'required',
            'image_link' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'post_by' => 'required'
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
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        $subCat=SubCategory::where('status','1')->orderBy('id','desc')->get();
        $test = TestSeries::find($id);
        return view('admin.testseries.edit',['course'=>$course,'subCat'=>$subCat,'test' => $test]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
        $videos = TestSeries::find($request->id);
        $videos->status=$request->status;
        if($request->status=="0")
        {
          $videos->id=$request->id;
          $videos->status=1;
        }
        else
        {
           $videos->id=$request->id;
           $videos->status=0;
        }
        if($videos->save())
        {
           $data['success']=true;
        }
        else
        {
           $data['success']=false;
        }
       return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        TestSeries::destroy($id);
        return redirect('all-test-series')->with('message','Test Series Deleted successfully.');
    }

    public function testScore($id)
    {
        $score = TestStats::orderBy('overall_score','desc')->where('test_id',$id)->get();
        $scoreData = $data = TestStats::select('total_question', 'total_attempt')->where('test_id',$id)->get();
        // foreach($score as $key => $value)
        // {
        //     $scoreData [] = ["Total Question",$value['total_question'],"Total Attempt",$value['total_attempt']];
        //     // $scoreData [] = [$value['total_question'],$value['total_attempt'],$value['correct_answer'],$value['wrong_answer'],$value['not_attempt'],$value['negative_marks']];
        // }
        return view('admin.testseries.test-score',['score'=>$score,'scoreData' => $scoreData]);
    }
}
