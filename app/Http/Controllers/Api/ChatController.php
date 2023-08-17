<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VideoChat;
use App\Models\VideoChatReply;
use Validator;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function createChat(Request $request)
    {
        try{
            $validator=Validator::make($request->all(),
            [
                'video_id'=>'required',
                'message'=>'required'
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(),202);
            }
            $data = [
                'user_id' => Auth::user()->id,
                'video_id' => $request->video_id,
                'message' => $request->message
            ];
            $chat = VideoChat::create($data);
            $response = [
                'status'=> 'success',
                'data' => $chat
            ];
            return response()->json($response,201);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function chatList($id)
    {
        try{
            if($id==0)
            {
            $data = VideoChat::where('status','1')->get();
            }
            else{
                $data = VideoChat::where('id',$id)->where('status','1')->get();
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

    public function chatReplyList(Request $request)
    {
        try{
            $validator=Validator::make($request->all(),[
                'chat_id'=>'required'
            ]);

            if($validator->fails())
            {
                return response()->json($validator->errors(),202);
            }
            $data = VideoChatReply::where('chat_id',$request->chat_id)->get();
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
