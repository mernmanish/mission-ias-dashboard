<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Course;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::orderBy('id','desc')->get();
        return view('admin.banner.all',['banner' => $banner]);
    }

    public function add()
    {
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        return view('admin.banner.add',['course'=>$course]);
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
            'banner_title' => $request->banner_title,
        ];

        if ($request->hasFile('image_link')) {
            $file = $request->file('image_link')->move('banner', $request->file('image_link')->getClientOriginalName());
            $data['image_link'] = $file->getPathname();
        }
        if($request->id=="")
        {
            $event = Banner::create($data);
            return redirect('all-banner')->with('message','Banner created successfully.');
        }
        else
        {
            $event = Banner::where('id',$request->id)->update($data);
            return redirect('all-banner')->with('message','Banner Updated successfully.');
        }
    }

    protected function validator(array $data)
    {
        // error_log('$data[number is : ' . $data['number']);
        //  $messages = "Please Fill Details";
        return Validator::make($data, [
            'course_id' => 'required',
            'banner_title' => 'required',
            'image_link' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
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
        $banner = Banner::find($id);
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        return view('admin.banner.edit',['course'=>$course,'banner' => $banner]);
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
        $batch = Banner::find($request->id);
         $batch->status=$request->status;
         if($request->status=="0")
         {
           $batch->id=$request->id;
           $batch->status=1;
         }
         else
         {
            $batch->id=$request->id;
            $batch->status=0;
         }
         if($batch->save())
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
        Banner::destroy($id);
        return redirect('all-banner')->with('message','Banner Deleted successfully.');
    }
}
