<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\District;
use App\Models\City;

class Location_master extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function state()
    {
        $data = State::orderBy('id','desc')->get();
        return view('admin.state',['states'=>$data]);
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
       if (! empty($request->id)) {
             $validator=$request->validate([
                'name'=>'required|unique:states,name',
            ]);
             $state = State::find($request->id);
             $state->name=$request->name;
             $state->remarks=$request->remarks;
             $state->mip_address=$request->ip();
             $state->mu_id=session('sessionadmin')['id'];
        }
        else{
             $validator=$request->validate([
                'name'=>'required|unique:states,name',
            ]);
            $state=new State;
            $state->name=$request->name;
            $state->remarks=$request->remarks;
            $state->mip_address=$request->ip();
            $state->ip_address=$request->ip();
            $state->cu_id=session('sessionadmin')['id'];
            $state->mu_id=session('sessionadmin')['id'];
        }
        if($state->save())
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
    public function changestatus(Request $request)
    {
        $state = State::find($request->id);
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
        //
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
        State::destroy($id);
        $data['success']=true;
        return response()->json($data);
    }
    public function district()
    {
        $data = District::orderBy('id','desc')->get();
        return view('admin.district',['district'=>$data]);
    }
    public function managedistrict(Request $request)
    {
        if (! empty($request->id)) {
             $validator=$request->validate([
                'name'=>'required|unique:districts,name',
                'state_id'=>'required'
            ]);
             $district = District::find($request->id);
             $district->state_id=$request->state_id;
             $district->name=$request->name;
             $district->remarks=$request->remarks;
             $district->mip_address=$request->ip();
             $district->mu_id=session('sessionadmin')['id'];
        }
        else{
             $validator=$request->validate([
                'name'=>'required|unique:districts,name',
                'state_id'=>'required'
            ]);
            $district=new District;
            $district->state_id=$request->state_id;
            $district->name=$request->name;
            $district->remarks=$request->remarks;
            $district->mip_address=$request->ip();
            $district->ip_address=$request->ip();
            $district->cu_id=session('sessionadmin')['id'];
            $district->mu_id=session('sessionadmin')['id'];
        }
        if($district->save())
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

    public function changedistrict(Request $request)
    {
         $district = District::find($request->id);
         $district->status=$request->status;
         if($request->status=="0")
         {
           $district->id=$request->id;
           $district->status=1;
         }
         else
         {
            $district->id=$request->id;
             $district->status=0;
         }
         if($district->save())
         {
            $data['success']=true;
         }
         else
         {
            $data['success']=false;
         }
        return response()->json($data);
    }

    public function deletedistrict($id)
    {
        District::destroy($id);
        $data['success']=true;
        return response()->json($data);
    }

    public function changestates(Request $request)
    {
        $state_id=$request->state_id;
        $district=District::where(['state_id'=>$state_id,'status'=>'1'])->get();
        $data='<option value="">Select District</option>';
        foreach($district as $rows){
             $data .='<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
         }
         return response()->json($data);
    }
    public function editstate($id)
    {
        $data=State::find($id);
        return response()->json($data);
    }
    public function city()
    {
        $data=City::orderBY('id','DESC')->get();
        return view('admin.city',['city' =>$data]);
    }
    public function managecity(Request $request)
    {
        if (! empty($request->id)) {
             $validator=$request->validate([
                'name'=>'required|unique:cities,name',
                'state_id'=>'required',
                'dist_id'=>'required'
            ]);
             $city = City::find($request->id);
             $city->state_id=$request->state_id;
             $city->dist_id=$request->dist_id;
             $city->name=$request->name;
             $city->remarks=$request->remarks;
             $city->mip_address=$request->ip();
             $city->mu_id=session('sessionadmin')['id'];
        }
        else{
             $validator=$request->validate([
                'name'=>'required|unique:cities,name',
                'state_id'=>'required',
                'dist_id'=>'required'
            ]);
            $city=new City;
            $city->state_id=$request->state_id;
            $city->name=$request->name;
            $city->dist_id=$request->dist_id;
            $city->remarks=$request->remarks;
            $city->mip_address=$request->ip();
            $city->ip_address=$request->ip();
            $city->cu_id=session('sessionadmin')['id'];
            $city->mu_id=session('sessionadmin')['id'];
        }
        if($city->save())
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

    public function changecitydata(Request $request)
    {
         $city = City::find($request->id);
         $city->status=$request->status;
         if($request->status=="0")
         {
           $city->id=$request->id;
           $city->status=1;
         }
         else
         {
            $city->id=$request->id;
             $city->status=0;
         }
         if($city->save())
         {
            $data['success']=true;
         }
         else
         {
            $data['success']=false;
         }
        return response()->json($data);
    }

    public function deletecity($id)
    {
        City::destroy($id);
        $data['success']=true;
        return response()->json($data);
    }
    public function changesdistricts(Request $request)
    {
        $dist_id=$request->dist_id;
        $city=City::where(['dist_id'=>$dist_id,'status'=>'1'])->get();
        $data='<option value="">Select City</option>';
        foreach($city as $rows){
             $data .='<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
         }
         return response()->json($data);
    }
    public function editcity($id)
    {
        $data=City::find($id);
        return response()->json($data);
    }
    public function editdistrict($id)
    {
        $data=District::find($id);
        return response()->json($data);
    }
}
