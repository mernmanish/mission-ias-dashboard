<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;
use Validator;
use Illuminate\Support\Facades\Log;

class VideoController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 404;

    public function videoList()
    {
        $data = Video::where('status','1')->get();
        $response = [
            'status'=> 'success',
            'data' => $data
        ];
        return response()->json($response,200);
    }

    public function courseVideoList(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'course_id'=>'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),202);
        }
        $data = Video::where('status','1')->where('course_id',$request->course_id)->get();
        $response = [
            'status'=> 'success',
            'data' => $data
        ];
        return response()->json($response,200);
    }


}
