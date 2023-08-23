<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\State;
use App\Models\District;
use Illuminate\Support\Facades\Hash;
/*use Illuminate\Auth\Middleware\TestSession;*/
class Auth extends Controller
{
    /*public function __construct()
    {
        $this->middleware('TestSession');
    }*/
    public function index()
    {

        return view('admin.login');
    }
    public function admin_registration()
    {
        $data = Admin::all();

        return view('admin.admin-registration',['admins'=>$data]);
    }
    // public function add_admin()
    // {
    //     return view('admin.add-admin');
    // }
    public function manageadminlogin(Request $request)
    {
       $loginname=$request['loginname'];
       $loginpassword=$request['loginpassword'];

       $adms = Admin::where(['mobile' => $loginname, 'status'=>'1'])->first();
       //dd($adms);
       if (! empty($adms)) {
           if (Hash::check($loginpassword, $adms->password) == $adms->password) {
            session(['sessionadmin' => $adms]);
              $data['success']=true;
           }
           else {
               $data['success']=false;
           }
       }
       // echo json_encode($data);
       return response()->json($data);
    }
    public function logout(Request $request)
    {
       // $request->session()->forget('sessionadmin');
        $request->session()->flush();
        /*Session::flush();*/
        return view('admin.login');

    }

    public function create()
    {

       return view('admin.add-admin');
    }


    public function store(Request $request)
    {
        if (! empty($request->aid)) {

            $admin = Admin::find($request->aid);
             $admin->name=$request->name;
             $admin->mobile=$request->mobile;
             $admin->gender=$request->gender;
             $admin->email=$request->email;
             $admin->pin_code=$request->pin_code;
             $admin->user_type = $request->user_type;
             $admin->full_address=$request->full_address;
             $admin->mu_id=session('sessionadmin')['id'];

            if ($request->hasfile('image'))
             {
                 $path = $request->file('image')->store('public/img');
                 $admin->image = $path;
             }
        }
        else{
           $admin=new Admin;
            $admin->name=$request->name;
            $admin->mobile=$request->mobile;
            $admin->gender=$request->gender;
            $admin->email=$request->email;
            $admin->pin_code=$request->pin_code;
            $admin->full_address=$request->full_address;
            $admin->user_type = $request->user_type;
            $admin->password=Hash::make($request->con_password);
            $admin->cu_id=session('sessionadmin')['id'];
            $admin->mu_id=session('sessionadmin')['id'];

           if ($request->hasfile('image'))
            {
                $path = $request->file('image')->store('public/img');
                $admin->image = $path;
            }
        }

        if($admin->save())
        {
            if (! empty($request->aid)) {
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
    public function edit(Admin $id)
    {
        return view('admin.add-admin', ['row' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::destroy($id);
        $data['success']=true;
        return response()->json($data);
    }
    public function changeadmindata(Request $request)
    {
        $state = Admin::find($request->id);
         $state->status=$request->status;
         if($request->status=="0")
         {
           $state->id=$request->id;
           $state->status=1;
         }
         else
         {
            $state->id=$request->id;
             $state->status=0;
         }
         if($state->save())
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
