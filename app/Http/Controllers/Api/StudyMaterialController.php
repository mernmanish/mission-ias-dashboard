<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudyMaterial;
use App\Models\DownloadStudyMaterial;
use Validator;
use Illuminate\Support\Facades\Log;

class StudyMaterialController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 404;

    public function materialList($id)
    {
        // $userID = Auth::user()->id;
        if($id==0)
        {
          $data = StudyMaterial::where('status','1')->get();
        }
        else{
            $data = StudyMaterial::where('id',$id)->where('status','1')->get();
        }
        $response = [
            'status'=> 'success',
            'data' => $data
        ];
        return response()->json($response,200);
    }

    public function downloadMaterial(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'material_id'=>'required'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),202);
        }
        $checkMaterial = DownloadStudyMaterial::where(['user_id'=> Auth::user()->id,'material_id'=>$request->material_id])->get();
        if($checkMaterial->count() > 0)
        {
            $response = [
                'status' => 'success',
                'message' => 'Study Material Already Downloaded'
            ];
            return response()->json($response,302);
        }
        else{

            $data = [
                'user_id' => Auth::user()->id,
                'material_id' => $request->material_id,
                'ip_address' => request()->ip()
            ];

            $material = DownloadStudyMaterial::create($data);
            $response = [
                'status'=> 'success',
                'data' => $material
            ];
            return response()->json($response,201);
        }

    }
    public function deleteMaterial($id)
    {
        DownloadStudyMaterial::destroy($id);
        $response = [
            'status'=> 'success',
            'message' => 'Study Material Deleted Successfully'
        ];
        return response()->json($response,200);
    }

    public function materialDownloadHistory()
    {
        try{
            $data = DownloadStudyMaterial::join('study_materials', 'study_materials.id', '=', 'download_study_materials.material_id')
            ->select('study_materials.course_id','study_materials.pdf_title','study_materials.writer_name','study_materials.pdf_file','study_materials.image_link')
            ->where('download_study_materials.user_id',Auth::user()->id)
            ->get();
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
