<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\VideoChat;
use App\Models\VideoChatReply;
use App\Models\LiveClass;



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

    public function chatList(Request $request)
    {
        $validator=Validator::make($request->all(),
        [
            'video_id'=>'required'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),202);
        }
        try{
            $video_id = $request->video_id;
            $data = DB::table('video_chats')
            ->leftJoin('users', 'video_chats.user_id', '=', 'users.id')
            ->select('video_chats.*', DB::raw('COALESCE(users.name, "Admin") as username'))
            ->where('video_chats.video_id',$video_id)
            ->get();
            // $data = VideoChat::where('video_id',$video_id)->orderBy('id','asc')->get();
            // foreach($data as $rows)
            // {
            //     $response = [
            //         'status'=> 'success',
            //         'data' => $rows
            //     ];
            //     return response()->json($response,200);
            // }
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

    public function liveUser(Request $request)
    {
        try{
            $validator=Validator::make($request->all(),[
                'video_id'=>'required',
                'type'=>'required'
            ]);

            if($validator->fails())
            {
                return response()->json($validator->errors(),202);
            }
            $live = LiveClass::where('id',$request->video_id)->latest()->first();
            $prevLive = $live->live_user;
            if($request->type=="online")
            {
                $currentCount = $prevLive + 1;
                $data = [
                    'live_user' => $currentCount
                ];
                $updateLive = LiveClass::where('id',$request->video_id)->update($data);
            }
            else{
                $currentCount = $prevLive - 1;
                $data = [
                    'live_user' => $currentCount
                ];
                $updateLive = LiveClass::where('id',$request->video_id)->update($data);
            }
            $response = [
                'status'=> 'success'
            ];
            return response()->json($response,200);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


}
