<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\BookOrder;
use Validator;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 404;

    public function bookList($id)
    {
        // $userID = Auth::user()->id;
        try{
            if($id==0)
            {
            $data = Book::where('status','1')->get();
            }
            else{
                $data = Book::where('id',$id)->where('status','1')->get();
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

    public function bookOrder(Request $request)
    {
        try{
        $validator=Validator::make($request->all(),
        [
            'book_id'=>'required',
            'full_address' => 'required',
            'land_mark' => 'required',
            'pin_code' => 'required',
            'state' => 'required',
            'city' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'payment_mode' => 'required'
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors(),202);
        }
        $data = [
            'user_id' => Auth::user()->id,
            'book_id' => $request->book_id,
            'full_address' => $request->full_address,
            'land_mark' => $request->land_mark,
            'pin_code' => $request->pin_code,
            'state' => $request->state,
            'city' => $request->city,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'payment_mode' => $request->payment_mode
        ];

        $order = BookOrder::create($data);
        $response = [
            'status'=> 'success',
            'data' => $order
        ];
        return response()->json($response,201);
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function bookOrderHistory($id)
    {
        try{
            $data = BookOrder::join('books', 'books.id', '=', 'book_orders.book_id')
            ->select('book_orders.*', 'books.book_title','books.book_price','books.book_sale_price','books.image_link')
            ->where('book_orders.user_id',Auth::user()->id)
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

    // public function downloadMaterial(Request $request)
    // {
    //     $validator=Validator::make($request->all(),[
    //         'material_id'=>'required'
    //     ]);

    //     if($validator->fails())
    //     {
    //         return response()->json($validator->errors(),202);
    //     }
    //     $checkMaterial = DownloadStudyMaterial::where(['user_id'=> Auth::user()->id,'material_id'=>$request->material_id])->get();
    //     if($checkMaterial->count() > 0)
    //     {
    //         $response = [
    //             'status' => 'success',
    //             'message' => 'Study Material Already Downloaded'
    //         ];
    //         return response()->json($response,302);
    //     }
    //     else{

    //         $data = [
    //             'user_id' => Auth::user()->id,
    //             'material_id' => $request->material_id,
    //             'ip_address' => request()->ip()
    //         ];

    //         $material = DownloadStudyMaterial::create($data);
    //         $response = [
    //             'status'=> 'success',
    //             'data' => $material
    //         ];
    //         return response()->json($response,201);
    //     }

    // }
    // public function deleteMaterial($id)
    // {
    //     DownloadStudyMaterial::destroy($id);
    //     $response = [
    //         'status'=> 'success',
    //         'message' => 'Study Material Deleted Successfully'
    //     ];
    //     return response()->json($response,200);
    // }

    // public function materialDownloadHistory()
    // {
    //     try{
    //         $data = DownloadStudyMaterial::join('study_materials', 'study_materials.id', '=', 'download_study_materials.material_id')
    //         ->select('study_materials.course_id','study_materials.pdf_title','study_materials.writer_name','study_materials.pdf_file','study_materials.image_link')
    //         ->where('download_study_materials.user_id',Auth::user()->id)
    //         ->get();
    //         $response = [
    //             'status'=> 'success',
    //             'data' => $data
    //         ];
    //         return response()->json($response,200);
    //     }
    //     catch(\Exception $e)
    //     {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }





}
