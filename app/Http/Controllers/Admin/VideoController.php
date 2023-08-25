<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Video;
use App\Models\VideoChat;
use App\Models\VideoChatReply;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video=Video::orderBy('id','desc')->get();
        return view('admin.video.all',['video'=>$video]);
    }

    public function addVideo()
    {
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        $category=Category::where('status','1')->orderBy('id','desc')->get();
        $subCat=SubCategory::where('status','1')->orderBy('id','desc')->get();
        return view('admin.video.add',['course'=>$course,'category'=>$category,'subCat'=>$subCat]);
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
        $data = [
            'course_id' => $request->course_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            // 'dish_type' => $request->dish_type,
            'video_title' => $request->video_title,
            'video_link' =>  $request->video_link,
            'source_type' => $request->source_type,
            'access' => $request->access
        ];

        if ($request->hasFile('image_link')) {
            $file = $request->file('image_link')->move('video', $request->file('image_link')->getClientOriginalName());
            $data['image_link'] = $file->getPathname();
        }
        if($request->id=="")
        {
            $video = Video::create($data);
            return redirect('all-videos')->with('message','Video created successfully.');
        }
        else
        {
            $video = Video::where('id',$request->id)->update($data);
            return redirect('all-videos')->with('message','Video Updated successfully.');
        }
    }
    protected function validator(array $data)
    {
        // error_log('$data[number is : ' . $data['number']);
        //  $messages = "Please Fill Details";
        return Validator::make($data, [
            'course_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'video_title' => 'required|string|max:255',
            'video_link' => 'required|string|max:255',
            'source_type' => 'required|string|max:255',
            'image_link' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'access' => 'required|string|max:255',
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
        $video =  Video::find($id);
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        $category=Category::where('status','1')->orderBy('id','desc')->get();
        $subCat=SubCategory::where('status','1')->orderBy('id','desc')->get();
        return view('admin.video.edit',['video' => $video,'course'=>$course,'category'=>$category,'subCat'=>$subCat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
        $videos = Video::find($request->id);
        $videos->status=$request->status;
        if($request->status=="0")
        {
          $videos->id=$request->id;
          $videos->status=1;
        }
        else
        {
           $videos->id=$request->id;
           $videos->status=0;
        }
        if($videos->save())
        {
           $data['success']=true;
        }
        else
        {
           $data['success']=false;
        }
       return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::find($id)->delete();
        return redirect('all-videos')->with('message', 'Video deleted successfully.');
    }

    public function chatList()
    {
        $chat = VideoChat::orderBy('id','desc')->get();
        return view('admin/video/all-chat',compact('chat'));
    }

    public function replyChatList(Request $request)
    {
        $chat_id=$request->id;
        $getData=VideoChatReply::where('chat_id',$chat_id)->get();
        $data ="";
        $i=1;
        if(!empty($getData)){ foreach($getData as $rows){
            $data .= '<p>'.$rows->message.'</p>';
        }
        }
        else{
            $data .='<p>Reply Message Not found !</p>';
        }
        return response()->json($data);
    }

    // public function addReplyChat(Request $request)
    // {
    //     $chatData = VideoChat::where('id',$request->chat_id)->latest()->first();
    //     $data = [
    //         'message' => $request->message,
    //         'chat_id' => $request->chat_id,
    //         'user_id' => $chatData->user_id,
    //         'video_id' => $chatData->video_id,
    //         'sender_id' =>session('sessionadmin')['id']
    //     ];
    //     $video = VideoChatReply::create($data);
    //     return redirect()->back()->with('message','Message Reply successfully !');
    // }


}
