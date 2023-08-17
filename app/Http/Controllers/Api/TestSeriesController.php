<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TestSeries;
use App\Models\TestSeriesQuestion;
use App\Models\TestStats;
use App\Models\TestAttempt;
use Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class TestSeriesController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 404;

    public function testSeriesList($id)
    {
        // $userID = Auth::user()->id;
        try{
            if($id==0)
            {
            $data = TestSeries::where('status','1')->get();
            }
            else{
                $data = TestSeries::where('id',$id)->where('status','1')->get();
            }
            $response = [
                'status'=> 'success',
                'data' => $data
            ];
            return response()->json($response,200);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function testSeriesQuestion($id)
    {
        try{
            $limit = 1;
            $data = TestSeriesQuestion::where('test_id',$id)->paginate($limit);
            return Response::json($data, 200);
            // $response = [
            //     'status'=> 'success',
            //     'data' => $data
            // ];
            // return response()->json($response,200);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function testSubmit(Request $request)
    {
        try{
            $validator=Validator::make($request->all(),[
                'test_id'=>'required',
                'attempt_time'=>'required',
                'question_id'=>'required',
                'answer'=>'required',
                'correct_answer'=>'required'
            ]);

            if($validator->fails())
            {
                return response()->json($validator->errors(),202);
            }
            $question_id = explode(",",$request->question_id);
            $answer = explode(",",$request->answer);
            $correct_answer = explode(",",$request->correct_answer);
            foreach($question_id as $key => $val)
            {
                $data = [
                    'test_id' => $request->test_id,
                    'user_id' => Auth::user()->id,
                    'attempt_time' => $request->attempt_time,
                    'question_id' => $val,
                    'answer' => $answer[$key],
                    'correct_answer' => $correct_answer[$key],
                ];
                TestAttempt::create($data);
            }
            $testInfo = TestSeries::where('id',$request->test_id)->latest()->first();
            $total_question = TestSeriesQuestion::where('test_id',$request->test_id)->count();
            $total_attempt = TestAttempt::where(['test_id'=>$request->test_id,'user_id'=>Auth::user()->id])->whereNotNull('answer')->count();
            $correct_answer = TestAttempt::where(['test_id'=>$request->test_id,'user_id'=>Auth::user()->id])->whereColumn('answer', '=', 'correct_answer')->count();
            $wrong_answer = TestAttempt::where(['test_id'=>$request->test_id,'user_id'=>Auth::user()->id])->whereColumn('answer', '<>', 'correct_answer')->count();
            $not_attempt = $total_question - $total_attempt;
            $negative_marks= $wrong_answer * $testInfo->negative_marks;
            $overall_marks = $correct_answer - $negative_marks;
            $accuracy = $correct_answer * 100/$total_attempt;
            $overall_score = $overall_marks * 100/$total_question;
            $testData= [
                'test_id' => $request->test_id,
                'user_id' => Auth::user()->id,
                'total_question' => $total_question,
                'attempt_time' => $request->attempt_time,
                'total_attempt' => $total_attempt,
                'correct_answer' => $correct_answer,
                'wrong_answer' => $wrong_answer,
                'not_attempt' => $not_attempt,
                'negative_marks' => $negative_marks,
                'overall_score' => $overall_score,
                'accuracy' => $accuracy,
            ];
            $testStats = TestStats::create($testData);
            $response = [
                'status'=> 'success',
                'data' => $testStats
            ];
            return response()->json($response,201);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function testSubmitList(Request $request)
    {
        try{
            $validator=Validator::make($request->all(),[
                'test_id'=>'required',
            ]);

            if($validator->fails())
            {
                return response()->json($validator->errors(),202);
            }
            $result = TestAttempt::where(['test_id'=>$request->test_id,'user_id'=>Auth::user()->id])->get();
            $response = [
                'status'=> 'success',
                'data' => $result
            ];
            return response()->json($response,200);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function testStats(Request $request)
    {
        try{
            $validator=Validator::make($request->all(),[
                'test_id'=>'required',
            ]);

            if($validator->fails())
            {
                return response()->json($validator->errors(),202);
            }
            $result = TestStats::where(['test_id'=>$request->test_id,'user_id'=>Auth::user()->id])->get();
            $response = [
                'status'=> 'success',
                'data' => $result
            ];
            return response()->json($response,200);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




}
