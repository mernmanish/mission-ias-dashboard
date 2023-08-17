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
use App\Models\LiveClass;
use DateTime;
use DateInterval;
use Carbon\Carbon;

class LiveClassController extends Controller
{
    public function index()
    {
        $currentDateTime = now();
        $video=LiveClass::whereDate('expiry_date','>', $currentDateTime)->orderBy('id','desc')->get();
        return view('admin.live-class.all',['video'=>$video]);
    }

    public function addVideo()
    {
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        $category=Category::where('status','1')->orderBy('id','desc')->get();
        $subCat=SubCategory::where('status','1')->orderBy('id','desc')->get();
        return view('admin.live-class.add',['course'=>$course,'category'=>$category,'subCat'=>$subCat]);
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
        $currentDateTime = Carbon::now();
        // $interval = new DateInterval('PT24H'); // PT24H represents 24 hours duration
        // $currentDateTime->add($interval);
        $expiry_date = $currentDateTime->addDays(1);
        $data = [
            'course_id' => $request->course_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            // 'dish_type' => $request->dish_type,
            'video_title' => $request->video_title,
            'video_link' =>  $request->video_link,
            'source_type' => $request->source_type,
            'access' => $request->access,
            'expiry_date' => $expiry_date
        ];
        // $videData = [
        //     'course_id' => $request->course_id,
        //     'category_id' => $request->category_id,
        //     'subcategory_id' => $request->subcategory_id,
        //     // 'dish_type' => $request->dish_type,
        //     'video_title' => $request->video_title,
        //     'video_link' =>  $request->video_link,
        //     'source_type' => $request->source_type,
        //     'access' => $request->access
        // ];
        if ($request->hasFile('image_link')) {
            $file = $request->file('image_link')->move('video', $request->file('image_link')->getClientOriginalName());
            $data['image_link'] = $file->getPathname();
        }
        // if ($request->hasFile('image_link')) {
        //     $file = $request->file('image_link')->move('video', $request->file('image_link')->getClientOriginalName());
        //     $videData['image_link'] = $file->getPathname();
        // }

        if($request->id=="")
        {
            // $videoAdd = Video::create($videData);
            $video = LiveClass::create($data);
            $vidData = [
                'course_id' => $video->course_id,
                'category_id' => $video->category_id,
                'subcategory_id' => $video->subcategory_id,
                // 'dish_type' => $request->dish_type,
                'video_title' => $video->video_title,
                'video_link' =>  $video->video_link,
                'source_type' => $video->source_type,
                'access' => $video->access,
                'image_link' => $video->image_link
            ];
            $videoAdd = Video::create($vidData);
            return redirect('all-live-class')->with('message','Live Class created successfully.');
        }
        else
        {
            $video = LiveClass::where('id',$request->id)->update($data);
            return redirect('all-live-class')->with('message','Live Class Updated successfully.');
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
        $video =  LiveClass::find($id);
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        $category=Category::where('status','1')->orderBy('id','desc')->get();
        $subCat=SubCategory::where('status','1')->orderBy('id','desc')->get();
        return view('admin.live-class.edit',['video' => $video,'course'=>$course,'category'=>$category,'subCat'=>$subCat]);
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
        $videos = LiveClass::find($request->id);
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
        LiveClass::find($id)->delete();
        return redirect('all-live-class')->with('message', 'Live Class deleted successfully.');
    }
}
