<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\News;
use App\Models\AssignCourse;
use Validator;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 404;

    public function newsList($id)
    {
        // $userID = Auth::user()->id;
        if($id==0)
        {
          $data = News::where('status','1')->get();
        }
        else{
            $data = News::where('id',$id)->where('status','1')->get();
        }
        $response = [
            'status'=> 'success',
            'data' => $data
        ];
        return response()->json($response,200);
    }




}
