<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Event;
use App\Models\News;
use Razorpay\Api\Api;
use App\Models\OnlinePayment;
use Session;
use Exception;
use DB;
use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

class WebHomeController extends Controller
{

    public function index()
    {
        $course = DB::table('courses')->where('status','1')->orderBy('id','desc')->limit(6)->get();
        $event = Event::where('status','1')->orderBy('id','desc')->limit(4)->get();
        $news = News::where('status','1')->orderBy('id','desc')->limit(3)->get();
        return view('frontend.index');
    }

    public function payNow()
    {
        return view('frontend.pay-now');
    }
    public function sendPayment(Request $request)
    {
        $this->validator($request->all())->validate();
        $name = $request->name;
        $mobile = $request->mobile;
        $email = $request->email;
        $amount = $request->amount;
        $message = $request->message;
        $OnlinePayment = OnlinePayment::create([
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email,
            'amount' => $amount,
            'message' => $message,
        ]);
        return view('frontend.make-payment',['id'=>$OnlinePayment->id,'name'=>$name,'mobile'=>$mobile,'email'=>$email,'amount'=>$amount,'message'=>$message]);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'amount' => 'required|numeric',
            'message' => 'required|string|max:255'
        ]);
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $id=$request->id;
        $api = new Api("rzp_live_GIpXa3Six1kD8e", "2bRrqqRIIYmXvvx79LXc53hk");
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                $payment_id = $response->id;
                $pData = [
                    'payment_id' => $payment_id,
                    'payment_status' => 'Paid'
                ];
                OnlinePayment::where('id',$id)->update($pData);
            } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect('pay-now')->with('error','Payment Failed.');
            }
        }

        Session::put('success', 'Payment successful');
        return redirect('pay-now')->with('message','Fee Paid Successfully.');
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
