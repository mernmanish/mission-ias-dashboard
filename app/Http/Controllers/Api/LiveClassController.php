<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;
use Validator;
use App\Models\LiveClass;
use Illuminate\Support\Facades\Log;
use DateTime;
use DateInterval;
use Carbon\Carbon;

class LiveClassController extends Controller
{
    public function liveClassList()
    {
        $currentDateTime = now();
        $data = LiveClass::whereDate('expiry_date','>', $currentDateTime)->where('status','1')->get();
        $response = [
            'status'=> 'success',
            'data' => $data
        ];
        return response()->json($response,200);
    }

    public function courseLiveClassList(Request $request)
    {
        $currentDateTime = now();
        $validator=Validator::make($request->all(),[
            'course_id'=>'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),202);
        }
        $data = LiveClass::whereDate('expiry_date','>', $currentDateTime)->where('status','1')->where('course_id',$request->course_id)->get();
        $response = [
            'status'=> 'success',
            'data' => $data
        ];
        return response()->json($response,200);
    }
}
