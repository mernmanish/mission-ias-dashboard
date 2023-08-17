<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use GuzzleHttp\Client;
// use Auth;

use App\Models\User;
use App\Models\Course;
use Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public $successStatus = 200;
    public $failStatus = 404;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function login(Request $request)
    {
        
        //print_r($request->all());
        $mobile = trim($request->mobile);
        $newPassword = trim($request->password);
        $password = md5($newPassword);
        $user = User::where(['mobile' => $mobile, 'password'=> $password])->first();
        // print_r($user);
        if (! empty($user)) {
            $responseArray = [];
            $responseArray['token'] = $user->createToken('MyApp')->accessToken;
            $responseArray['data'] = $user;
            User::where('id',$user->id)->update([
                'is_login' =>'yes'
            ]);
            return response()->json($responseArray,200);
        }
        else{
            return response()->json(['error' => 'Unauthenticated'],203);
        }
    }

    public function registration(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required|string|min:2|max:100',
            'email'=>'required|string|max:100|email',
            'mobile'=>'required|string|min:2|max:100|unique:users',
            'password'=>'required|string|min:6'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),202);
        }
        // $input = $request->all();
        $password = md5($request->password);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $password,
            'city' => $request->city,
            'join_date' => date('Y-m-d')
        ]);
        $responseArray = [];
        $responseArray['token'] = $user->createToken('MyApp')->accessToken;
        $responseArray['data'] = $user;
        return response()->json($responseArray,200);
    }

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
        //
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
        //
    }

    public function sendOTP(Request $request)
    {
       //
    }
    public function changePassword(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email'=>'required|string|max:100|email',
            'password'=>'required|min:8|confirmed'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),202);
        }
        try{
            $exitUser = User::where('email',$request->email)->latest()->first();
            if($exitUser)
            {
                $data = [
                    'password' => md5($request->password),
                ];
                $user = User::where('email',$request->email)->update($data);
                if($user)
                {
                    $response = [
                        'status'=> 'success',
                        'message' =>'password change successfully'
                    ];
                    return response()->json($response,200);
                }
            }
            else{
                $response = [
                    'status'=> 'false',
                    'message' => 'Email Id not found'
                ];
                return response()->json($response,404);
            }
        }
        catch(\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
