<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::orderBy('id','desc')->get();
        return view('admin.book.all-book',['book' => $book]);
    }

    public function addBook()
    {
        return view('admin.book.add-book');
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
            'book_title' => $request->book_title,
            'book_price' => $request->book_price,
            'book_sale_price' => $request->book_sale_price,
            'book_link' => $request->book_link,
            'description' =>  $request->description,
        ];

        if ($request->hasFile('image_link')) {
            $file = $request->file('image_link')->move('book', $request->file('image_link')->getClientOriginalName());
            $data['image_link'] = $file->getPathname();
        }
        if ($request->hasFile('book_pdf')) {
            $file = $request->file('book_pdf')->move('book', $request->file('book_pdf')->getClientOriginalName());
            $data['book_pdf'] = $file->getPathname();
        }
        if($request->id=="")
        {
            $video = Book::create($data);
            return redirect('all-books')->with('message','Book created successfully.');
        }
        else
        {
            $video = Book::where('id',$request->id)->update($data);
            return redirect('all-books')->with('message','Book Updated successfully.');
        }
    }

    protected function validator(array $data)
    {
        // error_log('$data[number is : ' . $data['number']);
        //  $messages = "Please Fill Details";
        return Validator::make($data, [
            'book_title' => 'required',
            'book_price' => 'required',
            'book_sale_price' => 'required',
            'book_link' => 'required',
            'image_link' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:1024'],
            'book_pdf' => ['file', 'mimes:pdf', 'max:10240'],
            'description' => 'required',
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
        $book = Book::find($id);
        return view('admin.book.edit',['book'=> $book]);
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
        $batch = Book::find($request->id);
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
    public function destroy($id)
    {
        Book::find($id)->delete();
        return redirect('all-books')->with('message', 'Book deleted successfully.');
    }
}
