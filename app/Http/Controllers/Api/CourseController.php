<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\AssignCourse;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\UserPayment;
use Validator;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 404;

    public function courseList()
    {
        // $userID = Auth::user()->id;
        $data = Course::where('status','1')->get();
        $response = [
            'status'=> 'success',
            'data' => $data
        ];
        return response()->json($response,200);
    }
    public function assignCourseList()
    {
        $userID = Auth::user()->id;
        $data = AssignCourse::where('status','active')->where('user_id',$userID)->whereDate('expire_date','>',date('Y-m-d'))->get();
        $response = [
            'status'=> 'success',
            'data' => $data
        ];
        return response()->json($response,200);
    }

    public function courseDetails(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'course_id'=>'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),202);
        }
        $data = Course::where('id',$request->course_id)->get();
        $response = [
            'status'=> 'success',
            'data' => $data
        ];
        return response()->json($response,200);
    }

    public function categoryList()
    {
        // $userID = Auth::user()->id;
        $data = Category::where('status','1')->get();
        $response = [
            'status'=> 'success',
            'data' => $data
        ];
        return response()->json($response,200);
    }

    public function subCategoryList()
    {
        // $userID = Auth::user()->id;
        $data = SubCategory::where('status','1')->get();
        $response = [
            'status'=> 'success',
            'data' => $data
        ];
        return response()->json($response,200);
    }

    public function coursePurchase(Request $request)
    {
        try{
            $validator=Validator::make($request->all(),
            [
                'course_id'=>'required',
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),202);
            }
            $courseDetails = Course::where('id',$request->course_id)->latest()->first();
            $data = [
                'user_id' => Auth::user()->id,
                'course_id' => $request->course_id,
                'amount' => $courseDetails->discount_fee,
                'payment_status' => 'pending'
            ];

            $payment = UserPayment::create($data);
            $response = [
                'status'=> 'success',
                'data' => $payment
            ];
            return response()->json($response,201);
            }
            catch(\Exception $e)
            {
                return response()->json(['error' => $e->getMessage()], 500);
            }
    }

    public function verifyPayment(Request $request)
    {
        try{
            $validator=Validator::make($request->all(),
            [
                'payment_id'=>'required',
                'payment_status' => 'required',
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),202);
            }
            $data = [
                'payment_status' => $request->payment_status
            ];
            $payment = UserPayment::where('id',$request->payment_id)->update($data);
            if($request->payment_status=="paid")
            {
                $prevPayment = UserPayment::where('id',$request->payment_id)->latest()->first();
                $courseDetails = Course::where('id',$prevPayment->course_id)->latest()->first();
                $duration = $courseDetails->duration;
                $join_date = date('Y-m-d');
                $pattern = '/\d+/'; // Regular expression to match one or more digits
                $matches = [];
                preg_match_all($pattern, $duration, $matches);
                $numbers = array_map('intval', $matches[0]);
                $months = $numbers[0];
                $expire_date = date('Y-m-d', strtotime($join_date . ' + ' . $months . ' months'));
                $assignData = [
                    'user_id' => $request->user_id,
                    'mobile' => $request->mobile,
                    'course_id' => $prevPayment->course_id,
                    'amount' => $courseDetails->course_fee,
                    'join_date' => $join_date,
                    'expire_date' => $expire_date,
                    'remarks' => 'online payment done successfully'
                ];
                $assignResponse = AssignCourse::create($assignData);
                $response = [
                    'status'=> 'success',
                    'data' => $assignData
                ];
                return response()->json($response,201);
           }
           else{
            $response = [
                'status'=> 'failed',
                'message' => 'Payment failed, Something went wrong'
            ];
            return response()->json($response,400);
           }
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function courseTypeList($id)
    {
        try{
            if($id==0)
            {
            $data = CourseType::where('status','1')->get();
            }
            else{
                $data = CourseType::where('id',$id)->where('status','1')->get();
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


}
