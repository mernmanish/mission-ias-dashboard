<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\StudyMaterial;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sm = StudyMaterial::orderBy('id','desc')->get();
        return view('admin.material.all',['sm' => $sm]);
    }

    public function addStudyMaterial()
    {
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        $category=Category::where('status','1')->orderBy('id','desc')->get();
        $subCat=SubCategory::where('status','1')->orderBy('id','desc')->get();
        return view('admin.material.add',['course'=>$course,'category'=>$category,'subCat'=>$subCat]);
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
            'writer_name' => $request->writer_name,
            'pdf_title' =>  $request->pdf_title,
            'price' => $request->price,
            'access' => $request->access,
            'description' => $request->description,
            'download_option' => $request->download_option
        ];

        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file')->move('study-material', $request->file('pdf_file')->getClientOriginalName());
            $data['pdf_file'] = $file->getPathname();
        }
        if ($request->hasFile('image_link')) {
            $file = $request->file('image_link')->move('study-material', $request->file('image_link')->getClientOriginalName());
            $data['image_link'] = $file->getPathname();
        }
        if($request->id=="")
        {
            $video = StudyMaterial::create($data);
            return redirect('all-study-material')->with('message','Study Material created successfully.');
        }
        else
        {
            $video = StudyMaterial::where('id',$request->id)->update($data);
            return redirect('all-study-material')->with('message','Study Material Updated successfully.');
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
            'writer_name' => 'required|string|max:255',
            'pdf_title' => 'required|string|max:255',
            'price' => 'required',
            'access' => 'required',
            'description' => 'required',
            'download_option' => 'required',
            'image_link' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'pdf_file' => ['file', 'mimes:pdf', 'max:10240']
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
        $sm = StudyMaterial::find($id);
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        $category=Category::where('status','1')->orderBy('id','desc')->get();
        $subCat=SubCategory::where('status','1')->orderBy('id','desc')->get();
        return view('admin.material.edit',['sm' => $sm,'course'=>$course,'category'=>$category,'subCat'=>$subCat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeMaterials(Request $request)
    {
        $videos = StudyMaterial::find($request->id);
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
        StudyMaterial::destroy($id);
        return redirect('all-study-material')->with('message','Study Material deleted successfully');
    }
}
