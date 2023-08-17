<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Banner;
use Validator;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 404;

    public function bannerList()
    {
        // $userID = Auth::user()->id;
        $data = Banner::where('status','1')->get();
        $response = [
            'status'=> 'success',
            'data' => $data
        ];
        return response()->json($response,200);
    }


}
