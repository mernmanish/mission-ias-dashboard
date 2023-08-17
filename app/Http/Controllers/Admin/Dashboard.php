<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPayment;
use App\Models\AssignCourse;
use DB;
use Carbon\Carbon;

class Dashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::select(DB::raw('COUNT(*) as count'))->whereYear('created_at',date('Y'))->groupBy(DB::raw("month(created_at)"))->pluck('count');
        $months=User::select(DB::raw("month(created_at) as month"))->whereYear('created_at',date('Y'))->groupBy(DB::raw("month(created_at)"))->pluck('month');
        $datas=array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index =>$month)
        {
            $datas[$month-1]=$users[$index];
        }
        $currentDate = Carbon::now();
        $currentMonth = Carbon::now()->startOfMonth();

        $weekly_users = User::whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get()->count();
        $weekly_fee = UserPayment::whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('payment_status','paid')->sum('amount');
        $weekly_assign = AssignCourse::whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get()->count();
        $today_users = User::whereDate('created_at',[Carbon::today()])->get()->count();
        $today_fee = UserPayment::whereDate('created_at',[Carbon::today()])->where('payment_status','paid')->sum('amount');
        $today_assign = AssignCourse::whereDate('created_at',[Carbon::today()])->get()->count();
        $monthly_users = User::whereDate('created_at', '>=', $currentMonth)->get()->count();
        $monthly_fee = UserPayment::whereDate('created_at','>=',$currentMonth)->where('payment_status','paid')->sum('amount');
        $monthly_assign = AssignCourse::whereDate('created_at', '>=', $currentMonth)->get()->count();
        $total_fee = UserPayment::where('payment_status','paid')->sum('amount');
        return view('admin.dashboard',compact('datas','today_users','weekly_users','weekly_assign','today_assign','monthly_users','monthly_assign','today_fee','weekly_fee','monthly_fee','total_fee'));
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
