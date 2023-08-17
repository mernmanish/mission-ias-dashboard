<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Validator;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 404;

    public function eventList($id)
    {
        // $userID = Auth::user()->id;
        try{
            if($id==0)
            {
            $data = Event::where('status','1')->get();
            }
            else{
                $data = Event::where('id',$id)->where('status','1')->get();
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
