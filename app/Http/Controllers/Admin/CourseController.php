<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Batch;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\CourseType;
class CourseController extends Controller
{

    public function index()
    {
        $data=Category::all();
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        return view('admin.category',['catlist'=>$data,'course' => $course]);
    }

    public function create(Request $request)
    {
         if (! empty($request->id)) {
             $validator=$request->validate([
                'name'=>'required|unique:categories,name'
            ]);
             $category = Category::find($request->id);
             $category->name=$request->name;
             $category->course_id=$request->course_id;
             $category->remarks=$request->remarks;
             $category->mip_address=$request->ip();
             $category->whats_app_link=$request->whats_app_link;
             $category->mu_id=session('sessionadmin')['id'];
        }
        else{
             $validator=$request->validate([
                'name'=>'required|unique:categories,name'
            ]);
            $category=new Category;
            $category->name=$request->name;
            $category->course_id=$request->course_id;
            $category->remarks=$request->remarks;
            $category->mip_address=$request->ip();
            $category->ip_address=$request->ip();
            $category->cu_id=session('sessionadmin')['id'];
            $category->mu_id=session('sessionadmin')['id'];
        }
        if($category->save())
        {
            if (! empty($request->id)) {
                $data['status']="updated";
            } else {
                $data['status']="added";
            }
                $data['success']=true;
        }
        else
        {
            $data['success']=false;
        }

        return response()->json($data);
    }

    public function edit($id)
    {
      $data=Category::find($id);
      return response()->json($data);
    }

    public function deletecategory($id)
    {
        Category::destroy($id);
        $data['success']=true;
        return response()->json($data);
    }
    public function changecategories(Request $request)
    {
         $category = Category::find($request->id);
         $category->status=$request->status;
         if($request->status=="0")
         {
           $category->id=$request->id;
           $category->status=1;
         }
         else
         {
            $category->id=$request->id;
            $category->status=0;
         }
         if($category->save())
         {
            $data['success']=true;
         }
         else
         {
            $data['success']=false;
         }
        return response()->json($data);
    }
    public function addCourses()
    {
        $cType = CourseType::where('status','1')->orderBy('id','desc')->get();
        return view('admin.course.add',compact('cType'));
    }
    public function courseList()
    {
        $data=Course::all();
        return view('admin.course.all',['coursedata'=>$data]);
    }
    public function manageCourse(Request $request)
    {
        $this->validator($request->all())->validate();
        $data = [
            'name' => $request->name,
            'duration' => $request->duration,
            'course_type_id' => $request->course_type_id,
            'course_fee' => $request->course_fee,
            'discount_fee' => $request->discount_fee,
            'description' =>  $request->description,
            'whats_app_link' =>  $request->whats_app_link,
        ];

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image')->move('course', $request->file('image')->getClientOriginalName());
        //     $data['image'] = $file->getPathname();
        // }

        if ($request->hasFile('image_link')) {
            $file = $request->file('image_link')->move('course', $request->file('image_link')->getClientOriginalName());
            $data['image'] = $file->getPathname();
        }
        if ($request->hasFile('syllabus')) {
            $file = $request->file('syllabus')->move('course', $request->file('syllabus')->getClientOriginalName());
            $data['syllabus'] = $file->getPathname();
        }
        if($request->id=="")
        {
            $video = Course::create($data);
            return redirect('course-list')->with('message','Course created successfully.');
        }
        else
        {
            $video = Course::where('id',$request->id)->update($data);
            return redirect('course-list')->with('message','Course Updated successfully.');
        }
    }
    protected function validator(array $data)
    {
        // error_log('$data[number is : ' . $data['number']);
        //  $messages = "Please Fill Details";
        return Validator::make($data, [
            'name' => 'required',
            'course_type_id' => 'required',
            'duration' => 'required',
            'course_fee' => 'required',
            'discount_fee' => 'required',
            'description' => 'required',
            'whats_app_link' => 'required',
            'image_link' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
        ]);

    }
    public function edit_course($id)
    {
        $course=Course::find($id);
        $cType = CourseType::where('status','1')->orderBy('id','desc')->get();
        return view('admin.course.edit',['course' => $course,'cType'=>$cType]);
    }
    public function deletecourse($id)
    {
        Course::destroy($id);
        return redirect('course-list')->with('message', 'Course Deleted successfully.');
    }
    public function changecoursestatus(Request $request)
    {
         $course = Course::find($request->id);
         $course->status=$request->status;
         if($request->status=="0")
         {
           $course->id=$request->id;
           $course->status=1;
         }
         else
         {
            $course->id=$request->id;
            $course->status=0;
         }
         if($course->save())
         {
            $data['success']=true;
         }
         else
         {
            $data['success']=false;
         }
        return response()->json($data);
    }

    public function subCategory()
    {
        $course=Course::where('status','1')->orderBy('id','desc')->get();
        $category=Category::where('status','1')->orderBy('id','desc')->get();
        $subCat=SubCategory::orderBy('id','desc')->get();
        return view('admin.sub-category',['course'=>$course,'category'=>$category,'subCat'=>$subCat]);
    }

    public function storeSubCategory(Request $request)
    {
        if (! empty($request->id)) {
            $validator=$request->validate([
               'name'=>'required'
           ]);
            $category = SubCategory::find($request->id);
            $category->name=$request->name;
            $category->course_id=$request->course_id;
            $category->category_id=$request->category_id;
       }
       else{
            $validator=$request->validate([
               'name'=>'required'
           ]);
           $category=new SubCategory;
           $category->name=$request->name;
           $category->course_id=$request->course_id;
           $category->category_id=$request->category_id;
       }
       if($category->save())
       {
           if (! empty($request->id)) {
               $data['status']="updated";
           } else {
               $data['status']="added";
           }
               $data['success']=true;
       }
       else
       {
           $data['success']=false;
       }

       return response()->json($data);
    }

    public function changeSubCategories(Request $request)
    {
        $course = SubCategory::find($request->id);
         $course->status=$request->status;
         if($request->status=="0")
         {
           $course->id=$request->id;
           $course->status=1;
         }
         else
         {
            $course->id=$request->id;
            $course->status=0;
         }
         if($course->save())
         {
            $data['success']=true;
         }
         else
         {
            $data['success']=false;
         }
        return response()->json($data);
    }

    public function editSubcategory($id)
    {
        $data=SubCategory::find($id);
        return response()->json($data);
    }

    public function deleteSubCategory($id)
    {
        SubCategory::destroy($id);
        $data['success']=true;
        return response()->json($data);
    }

    public function changeCategory(Request $request)
    {
        $course_id=$request->course_id;
        $district=Category::where(['course_id'=>$course_id,'status'=>'1'])->get();
        $data='<option value="">Select Category</option>';
        foreach($district as $rows){
             $data .='<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
         }
         return response()->json($data);
    }

    public function changeSubCategory(Request $request)
    {
        $category_id=$request->category_id;
        $district=subCategory::where(['category_id'=>$category_id,'status'=>'1'])->get();
        $data='<option value="">Select Sub Category</option>';
        foreach($district as $rows){
             $data .='<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
         }
         return response()->json($data);
    }

    public function changeSubCategoryData(Request $request)
    {
        $course_id=$request->course_id;
        $district=subCategory::where(['course_id'=>$course_id,'status'=>'1'])->get();
        $data='<option value="">Select Sub Category</option>';
        foreach($district as $rows){
             $data .='<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
         }
         return response()->json($data);
    }
    public function courseType()
    {
        $cType = CourseType::orderBy('id','desc')->get();
        return view('admin.course.course-type',compact('cType'));
    }
    public function storeCourseType(Request $request)
    {
        if (! empty($request->id)) {
            $validator=$request->validate([
               'course_type'=>'required'
           ]);
            $category = CourseType::find($request->id);
            $category->course_type=$request->course_type;
       }
       else{
            $validator=$request->validate([
               'course_type'=>'required'
           ]);
           $category=new CourseType;
           $category->course_type=$request->course_type;
       }
       if($category->save())
       {
           if (! empty($request->id)) {
               $data['status']="updated";
           } else {
               $data['status']="added";
           }
               $data['success']=true;
       }
       else
       {
           $data['success']=false;
       }

       return response()->json($data);
    }


    public function changesCourseType(Request $request)
    {
        $course = CourseType::find($request->id);
         $course->status=$request->status;
         if($request->status=="0")
         {
           $course->id=$request->id;
           $course->status=1;
         }
         else
         {
            $course->id=$request->id;
            $course->status=0;
         }
         if($course->save())
         {
            $data['success']=true;
         }
         else
         {
            $data['success']=false;
         }
        return response()->json($data);
    }

    public function editCourseType($id)
    {
        $data=CourseType::find($id);
        return response()->json($data);
    }

    public function deleteCourseType($id)
    {
        CourseType::destroy($id);
        $data['success']=true;
        return response()->json($data);
    }

    public function batch()
    {
        $data=Batch::all();
        return view('admin.batch',['batchdata'=>$data]);
    }
    public function managebatch(Request $request)
    {
        if (! empty($request->id)) {
            $validator=$request->validate([
               'code'=>'required',
               'course_id'  =>  'required',
               'seats'=> 'required|numeric'
           ]);
            $batch = Batch::find($request->id);
            $batch->code=$request->code;
            $batch->course_id=$request->course_id;
            $batch->seats=$request->seats;
            $batch->remarks=$request->remarks;
            $batch->mu_id=session('sessionadmin')['id'];
            $batch->mip_address=$request->ip();

       }
       else{
            $validator=$request->validate([
                'code'=>'required|unique:batches,code',
               'course_id'  =>  'required',
               'seats'=> 'required|numeric'
           ]);
            $batch=new Batch;
            $batch->code=$request->code;
            $batch->course_id=$request->course_id;
            $batch->seats=$request->seats;
            $batch->remarks=$request->remarks;
            $batch->mip_address=$request->ip();
           $batch->ip_address=$request->ip();
           $batch->cu_id=session('sessionadmin')['id'];
           $batch->mu_id=session('sessionadmin')['id'];
       }

       if($batch->save())
       {
           if (! empty($request->id)) {
               $data['status']="updated";
           } else {
               $data['status']="added";
           }
           $data['success']=true;
       }
       else
       {
           $data['success']=false;
       }

       return response()->json($data);
    }
    public function editbatch($id)
    {
        $data=Batch::find($id);
        return response()->json($data);
    }
    public function deletebatch($id)
    {
        Batch::destroy($id);
        $data['success']=true;
        return response()->json($data);
    }
    public function changebatches(Request $request)
    {
        $batch = Batch::find($request->id);
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
    public function subject()
    {
        $data=Subject::all();
        return view('admin.subject',['sublist'=>$data]);
    }

    public function managesubjects(Request $request)
    {
        if (! empty($request->id)) {
            $validator=$request->validate([
               'name'=>'required',
               'image'  =>  'image|mimes:jpeg,png,jpg,gif|max:200'
           ]);
            $subject = Subject::find($request->id);
            $subject->name=$request->name;
            $subject->remarks=$request->remarks;
            $image = $request->file('image');
            $subject->mu_id=session('sessionadmin')['id'];
            $subject->mip_address=$request->ip();
            if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('upload/img/'), $filename);
            $subject['image']= $filename;
          }
       }
       else{
            $validator=$request->validate([
                'name'=>'required|unique:subjects,name',
                'image'  =>  'image|mimes:jpeg,png,jpg,gif|max:200'
           ]);
            $subject=new Subject;
            $subject->name=$request->name;
            $subject->remarks=$request->remarks;
            $image = $request->file('image');
            $subject->mip_address=$request->ip();
            $subject->ip_address=$request->ip();
            $subject->cu_id=session('sessionadmin')['id'];
            $subject->mu_id=session('sessionadmin')['id'];
           if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('upload/img/'), $filename);
            $subject['image']= $filename;
          }
       }

       if($subject->save())
       {
           if (! empty($request->id)) {
               $data['status']="updated";
           } else {
               $data['status']="added";
           }
           $data['success']=true;
       }
       else
       {
           $data['success']=false;
       }

       return response()->json($data);
    }

    public function editsubject($id)
    {
        $data=Subject::find($id);
        return response()->json($data);
    }

    public function deletesubject($id)
    {
        Subject::destroy($id);
        $data['success']=true;
        return response()->json($data);
    }

    public function changesubjects(Request $request)
    {
         $subject = Subject::find($request->id);
         $subject->status=$request->status;
         if($request->status=="0")
         {
           $subject->id=$request->id;
           $subject->status=1;
         }
         else
         {
            $subject->id=$request->id;
            $subject->status=0;
         }
         if($subject->save())
         {
            $data['success']=true;
         }
         else
         {
            $data['success']=false;
         }
        return response()->json($data);
    }

    public function topics()
    {
        $data=Topic::all();
        return view('admin.topics',['topiclist'=>$data]);
    }

    public function managetopics(Request $request)
    {
        if (! empty($request->id)) {
            $validator=$request->validate([
               'name'=>'required',
               'sub_id'=>'required',
               'image'  =>  'image|mimes:jpeg,png,jpg,gif|max:200',
               'file'  =>  'file|mimes:pdf|max:500'
           ]);
            $topics = Topic::find($request->id);
            $topics->sub_id=$request->sub_id;
            $topics->name=$request->name;
            $topics->remarks=$request->remarks;
            $image = $request->file('image');
            $topics->mu_id=session('sessionadmin')['id'];
            $topics->mip_address=$request->ip();
            if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('upload/img/'), $filename);
            $topics['image']= $filename;
          }
          if($request->file('file')){
            $file= $request->file('file');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('upload/img/'), $filename);
            $topics['file']= $filename;
          }
       }
       else{
            $validator=$request->validate([
                'name'=>'required|unique:subjects,name',
                'sub_id'=>'required',
                'image'  =>  'image|mimes:jpeg,png,jpg,gif|max:200',
                'file'  =>  'file|mimes:pdf|max:500'
           ]);
            $topics=new Topic;
            $topics->sub_id=$request->sub_id;
            $topics->name=$request->name;
            $topics->remarks=$request->remarks;
            $image = $request->file('image');
            $topics->mip_address=$request->ip();
            $topics->ip_address=$request->ip();
            $topics->cu_id=session('sessionadmin')['id'];
            $topics->mu_id=session('sessionadmin')['id'];
           if($request->file('image')){
            $file= $request->file('image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('upload/img/'), $filename);
            $topics['image']= $filename;
          }
          if($request->file('file')){
            $file= $request->file('file');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('upload/img/'), $filename);
            $topics['file']= $filename;
          }
       }

       if($topics->save())
       {
           if (! empty($request->id)) {
               $data['status']="updated";
           } else {
               $data['status']="added";
           }
           $data['success']=true;
       }
       else
       {
           $data['success']=false;
       }

       return response()->json($data);
    }

    public function edittopics($id)
    {
        $data=Topic::find($id);
        return response()->json($data);
    }

    public function deletetopics($id)
    {
        Topic::destroy($id);
        $data['success']=true;
        return response()->json($data);
    }

    public function changetopics(Request $request)
    {
        $topics = Topic::find($request->id);
         $topics->status=$request->status;
         if($request->status=="0")
         {
           $topics->id=$request->id;
           $topics->status=1;
         }
         else
         {
            $topics->id=$request->id;
            $topics->status=0;
         }
         if($topics->save())
         {
            $data['success']=true;
         }
         else
         {
            $data['success']=false;
         }
        return response()->json($data);
    }

}
