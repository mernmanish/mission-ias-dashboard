<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.notification');
    }

    public function sendNotification(Request $request)
    {
        // dd($request->all());
        $data = [];
        $data ['message'] = $request->message;
        $data ['description'] = 'please everyone join Classes';

        $tokens = [];
        $tokens [] = 'eIT-M1iIRlacuoK-98QobX:APA91bFr336omvHvjqM4ovT0NvORpZlk0gf7o-sWQ-mEO6-5S2J-4VVhZnRlBe9OFkAeu6nYBtW3rSnIz9W0GB1HL0FomSiFu-BrJQTJiIdNUtEwQGgf-a86gOD2jRilIUXLyVn5yyOO';
        $response = $this->sendFirebasePush($tokens,$data);
    }

    public function sendFirebasePush($tokens,$data)
    {
        //dd($data);
        $serverKey = 'AAAAppqxtyA:APA91bESvm1Aor7yo2-guZ2z8O44UWF28QGvr1i853BtHFex2ef11vfb1l8Vx2Bh6iQ1uIPFvlciYtbHBezE_IR1FMxFrGxbO90227XHBJUFH-qO1noEIhrCSe1rgDyrUaqMfuAiFwX-';
        $msg = array(
            'message'=>$data['message'],
            'description' => $data['description']
        );
        $notifyData = [
            "body" => $data['message'],
            "title" => 'Mission Classes'
        ];

        $registrationIds = $tokens;
        if(count($tokens) > 1)
        {
            $fields = array(
                'registration_ids' => $registrationIds,
                'notification' => $notifyData,
                'data' => $msg,
                'priority' => 'high'
            );
        }
        else{
            $fields = array(
                'to' => $registrationIds[0],
                'notification' => $notifyData,
                'data' => $msg,
                'priority' => 'high'
            );
        }
        $headers [] = 'Content-Type: application/json';
        $headers [] = 'Authorization: key='.$serverKey;
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        // curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        if ($result === FALSE)
        {
            die('FCM Send Error: ' . curl_error($ch));
            dd('lll');
        }
        curl_close( $ch );
        dd($result);
        return $result;
        return redirect()->back()->with('message', 'Notification send Successfully');

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
}
