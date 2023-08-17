<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::orderBy('id','desc')->get();
        return view('admin.event.all',['event' => $event]);
    }

    public function add()
    {
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        $category=Category::where('status','1')->orderBy('id','desc')->get();
        $subCat=SubCategory::where('status','1')->orderBy('id','desc')->get();
        return view('admin.event.add',['course'=>$course,'category'=>$category,'subCat'=>$subCat]);
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
            'event_name' => $request->event_name,
            'description' => $request->description,
            'video_link' =>  $request->video_link,
            'source_type' => $request->source_type,
            'access' => $request->access
        ];

        if ($request->hasFile('image_link')) {
            $file = $request->file('image_link')->move('event', $request->file('image_link')->getClientOriginalName());
            $data['image_link'] = $file->getPathname();
        }
        if($request->id=="")
        {
            $event = Event::create($data);
            return redirect('all-event')->with('message','Event created successfully.');
        }
        else
        {
            $event = Event::where('id',$request->id)->update($data);
            return redirect('all-event')->with('message','Event Updated successfully.');
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
            'description' => 'required',
            'event_name' => 'required|string|max:255',
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
        $event =  Event::find($id);
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        $category=Category::where('status','1')->orderBy('id','desc')->get();
        $subCat=SubCategory::where('status','1')->orderBy('id','desc')->get();
        return view('admin.event.edit',['event' => $event,'course'=>$course,'category'=>$category,'subCat'=>$subCat]);
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
        $videos = Event::find($request->id);
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
    public function delete($id)
    {
        Event::destroy($id);
        return redirect('all-event')->with('message','Event Deleted successfully.');
    }

}
