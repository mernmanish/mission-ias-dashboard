<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\TestSeries;
use App\Models\TestSeriesQuestion;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;

class TestSeriesQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $question = TestSeriesQuestion::where('test_id',$id)->orderBy('id','asc')->get();
        return view('admin.question.all',['question' => $question,'test_id' => $id]);
    }

    public function add($id)
    {
        $test = TestSeries::find($id);
        $test_category = explode(",",$test->test_category);
        $exp_data = explode(",",$test->no_of_question);
        $totalQuestion = array_sum($exp_data);
        $addedQuestion = TestSeriesQuestion::where('id',$id)->count();
        return view('admin.question.add',['addedQuestion'=>$addedQuestion,'test' => $test,'total_question' => $totalQuestion,'test_category' => $test_category,'test_id'=>$id]);
    }

    public function viewQuestionDetails($id)
    {
        $question = TestSeriesQuestion::find($id);
        return view('admin.question.view-question-details',['question' => $question]);
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
        if(!empty($request->option_e))
        {
            $option_e = $request->option_e;
        }
        else
        {
            $option_e = "";
        }
        $data = [
            'test_id' => $request->test_id,
            'test_category' => $request->test_category,
            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'option_e' => $option_e,
            'answer' => $request->answer,
            'solution' => $request->solution
        ];

        if ($request->hasFile('question_image')) {
            $file = $request->file('question_image')->move('TestSeriesQuestion', $request->file('question_image')->getClientOriginalName());
            $data['question_image'] = $file->getPathname();
        }
        if ($request->hasFile('option_a_image')) {
            $file = $request->file('option_a_image')->move('TestSeriesQuestion', $request->file('option_a_image')->getClientOriginalName());
            $data['option_a_image'] = $file->getPathname();
        }
        if ($request->hasFile('option_b_image')) {
            $file = $request->file('option_b_image')->move('TestSeriesQuestion', $request->file('option_b_image')->getClientOriginalName());
            $data['option_b_image'] = $file->getPathname();
        }
        if ($request->hasFile('option_c_image')) {
            $file = $request->file('option_c_image')->move('TestSeriesQuestion', $request->file('option_c_image')->getClientOriginalName());
            $data['option_c_image'] = $file->getPathname();
        }
        if ($request->hasFile('option_d_image')) {
            $file = $request->file('option_d_image')->move('TestSeriesQuestion', $request->file('option_d_image')->getClientOriginalName());
            $data['option_d_image'] = $file->getPathname();
        }
        if ($request->hasFile('option_e_image')) {
            $file = $request->file('option_e_image')->move('TestSeriesQuestion', $request->file('option_e_image')->getClientOriginalName());
            $data['option_e_image'] = $file->getPathname();
        }
        if ($request->hasFile('solution_image')) {
            $file = $request->file('solution_image')->move('TestSeriesQuestion', $request->file('solution_image')->getClientOriginalName());
            $data['solution_image'] = $file->getPathname();
        }
        if($request->id=="")
        {
            $event = TestSeriesQuestion::create($data);
            return redirect('view-test-series-question/'.$request->test_id.'')->with('message','Question created successfully.');
        }
        else
        {
            $event = TestSeriesQuestion::where('id',$request->id)->update($data);
            return redirect('view-test-series-question/'.$request->test_id.'')->with('message','Question Updated successfully.');
        }
    }
    protected function validator(array $data)
    {
        // error_log('$data[number is : ' . $data['number']);
        //  $messages = "Please Fill Details";
        return Validator::make($data, [
            'test_category' => 'required',
            'question_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'option_a_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'option_b_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'option_c_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'option_d_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'answer' => 'required',
            'solution_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024']
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
        $question = TestSeriesQuestion::find($id);
        $test = TestSeries::where('id',$question->test_id)->first();
        $test_category = explode(",",$test->test_category);
        $exp_data = explode(",",$test->no_of_question);
        $totalQuestion = array_sum($exp_data);
        return view('admin.question.edit',['test' => $test,'total_question' => $totalQuestion,'test_category' => $test_category,'question'=>$question]);
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
    public function destroy($id)
    {
        TestSeriesQuestion::destroy($id);
        return redirect()->back()->with('message','Question Deleted Successfully');
    }

    public function importTestSeriesQuestion(Request $request)
    {
        $imported_items = array();
        $excel = $request->file('excel');
        $uploadTest = Excel::toArray('test', $excel, ExcelExcel::XLSX);
        $uploadTest = array_slice($uploadTest[0], 1);
        //dd($userList);
        foreach ($uploadTest as $key => $test) {
            if($test[1]==null || empty($test[1]))
            {
                continue;
            }
            $item = TestSeriesQuestion::create(
                [
                    'test_id' => $request->test_id,
                    'test_category' => $test[1] ?? '',
                    'question' => $test[2] ?? '',
                    'option_a' => $test[3] ?? '',
                    'option_b' => $test[4] ?? '',
                    'option_c' => $test[5] ?? '',
                    'option_d'=> $test[6] ?? '',
                    'option_e'=> $test[7] ?? '',
                    'answer'=> $test[8] ?? '',
                    'solution'=> $test[9] ?? ''
                ]
            );
                array_push($imported_items, $item);
        }
        if($item){
            return redirect('view-test-series-question/'.$request->test_id.'')->with('message','Question created successfully.');
        }
        else{
            return redirect('view-test-series-question/'.$request->test_id.'')->with('message','Something went wrong.');
        }
    }
}
