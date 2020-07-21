<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Order;
use App\Chef;
class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders= DB::table('orders')->get();
        $order_count = count($orders);
        $total =  DB::table('orders')->sum('total_price');
        $now = new \DateTime('now');
        $month = $now->format('m');
        $year = $now->format('Y');
        $sales = DB::table('orders')->whereYear('created_at', '=', $year)
              ->whereMonth('created_at', '=', $month)
              ->get();
        $sales_count = count($sales);
        $sales_month = DB::table('orders')->whereYear('created_at', '=', $year)
              ->whereMonth('created_at', '=', $month)->sum('total_price');
        $order = DB::table('orders')
        ->join('chefs', 'chefs.id', '=', 'orders.chef_id')
        ->join('users','users.id','=','orders.user_id')
        ->select('orders.*', 'chefs.business_name','chefs.business_email','users.email','users.first_name')->take(2)->get();
        
        return view('index', compact('order_count','total','sales_count','sales_month','order'));
    }

     public function chefreport(Request $request)
    {
        $report = DB::table('report_chefs')
        ->join('chefs', 'chefs.id', '=', 'report_chefs.chef_id')
        ->join('users','users.id','=','report_chefs.user_id')
        ->select('report_chefs.*', 'chefs.business_name','chefs.business_email','chefs.isBlocked','chefs.id','users.email','users.first_name')
        ->get();
         $id = $request->input('id');
        $status=Chef::findOrFail($id);
        if($status->isBlocked==true)
            $status->isBlocked = false;
        else
            $status->isBlocked = true;
        $status->save();
        return redirect('/chef/reports');
    }
   
    public function chefreports()
    {
        $report = DB::table('report_chefs')
        ->join('chefs', 'chefs.id', '=', 'report_chefs.chef_id')
        ->join('users','users.id','=','report_chefs.user_id')
        ->select('report_chefs.*', 'chefs.business_name','chefs.business_email','chefs.isBlocked','chefs.id','users.email','users.first_name')
        ->paginate(20);
      
        return view('chefreport', compact('report'));
    }
   
     public function getsales()
    {
        $order = DB::table('orders')
        ->join('chefs', 'chefs.id', '=', 'orders.chef_id')
        ->join('users','users.id','=','orders.user_id')
        ->select('orders.*', 'chefs.business_name','chefs.business_email','users.email','users.first_name')->get();
        
        return view('sales', compact('order'));
    }
    
     public function getchefs()
    {
        $report = DB::table('chefs')
        ->paginate(20);
        
        return view('allchefs', compact('report'));
    }
    public function getchef(Request $request)
    {
         $id = $request->input('id');
        $status=Chef::findOrFail($id);
        if($status->isBlocked==true)
            $status->isBlocked = false;
        else
            $status->isBlocked = true;
        $status->save();
        return redirect('/allchefs');
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
