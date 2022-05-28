<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\order;
use App\Models\orderItem;
use App\Models\sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class salesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //
        $users = User::where('id',auth()->id())->first();

    if($users->hasRole('Sales')){
    $sales = sale::join('customers','customers.id','sales.customer_id')
    ->join('users','sales.user_id','users.id')
    ->select('sales.*','customers.customer_name','users.name','customers.id as cid')
    ->where('sales.status','!=','Deleted')
    ->where('sales.user_id',auth()->id())
    ->get();

    $totals = sale::rightjoin('customers','customers.id','sales.customer_id')
    ->select(['sales.*','customers.customer_name',
    DB::raw('COUNT(customers.customer_name) as total_customers'),
    DB::raw('SUM(sales.amount) as total_revenue'),
    DB::raw('SUM(sales.paid) as total_cash'),
    DB::raw('SUM(sales.balance) as total_credit')
    ])
    ->where('sales.status','!=','Deleted')
    ->where('sales.user_id',auth()->id())
    ->first();
    $total_customers = customer::select(['*',
    DB::raw('COUNT(customer_name) as total_customers')
    ])->first();

    $customers = customer::get();
    $salespeople = User::get();

    return view('admin.sales.sale',compact('sales','customers','salespeople','totals','total_customers'));
    }

    if($users->hasRole('Store|Admin|Account')){
        $sales = sale::join('customers','customers.id','sales.customer_id')
        ->join('users','sales.user_id','users.id')
        ->select('sales.*','customers.customer_name','users.name','customers.id as cid')
        ->where('sales.status','!=','Deleted')
        ->get();

        $totals = sale::rightjoin('customers','customers.id','sales.customer_id')
        ->select(['sales.*','customers.customer_name',
        DB::raw('COUNT(customers.customer_name) as total_customers'),
        DB::raw('SUM(sales.amount) as total_revenue'),
        DB::raw('SUM(sales.paid) as total_cash'),
        DB::raw('SUM(sales.balance) as total_credit')
        ])
        ->where('sales.status','!=','Deleted')
        ->first();
        $total_customers = customer::select(['*',
        DB::raw('COUNT(customer_name) as total_customers')
        ])->first();

        $customers = customer::get();
        $salespeople = User::get();

        return view('admin.sales.sale',compact('sales','customers','salespeople','totals','total_customers'));
        }

    }
    public function order(){
        $sales = order::join('customers','customers.id','orders.customer_id')
        ->join('users','orders.user_id','users.id')
        ->select('orders.*','customers.customer_name','users.name')
        ->where('orders.status','Pending')
        ->get();
        return view('admin.sales.order',compact('sales'));
    }

    /**
     * Outstanding balances
     */
    public function outstanding(){
        $users = User::where('id',auth()->id())->first();
        if($users->hasRole('Sales')){
        $sales_total =sale::join('customers','sales.customer_id','customers.id')
        ->select(
        DB::raw('SUM(sales.amount) as totalamount'),
        DB::raw('SUM(sales.paid) as totalpaid'),
        DB::raw('SUM(sales.balance) as totalbalance'))
        ->where('sales.balance','>',0)
        ->where('sales.user_id',auth()->id())
        ->where(function ($query) {
            $query->where('sales.status', 'Credit')
                  ->orwhere('sales.status', 'Installment'); })
                  ->first();

        $outstandings = sale::join('customers','sales.customer_id','customers.id')
            ->leftjoin('customer_wallets','customer_wallets.customer_id','customers.id')
            ->select('sales.*','customers.customer_name','customers.id as cid','customer_wallets.balance as wallet_balance')
            ->where('sales.user_id',auth()->id())
            ->where(function ($query) {
                $query->where('sales.status', 'Credit')
                      ->orwhere('sales.status', 'Installment'); })->get();
    return view('admin.sales.outstandings',compact('outstandings','sales_total'));
            }

            if($users->hasRole('Admin|Account')){
                $sales_total =sale::join('customers','sales.customer_id','customers.id')
                ->select(
                DB::raw('SUM(sales.amount) as totalamount'),
                DB::raw('SUM(sales.paid) as totalpaid'),
                DB::raw('SUM(sales.balance) as totalbalance'))
                ->where('sales.balance','>',0)
                ->where(function ($query) {
                    $query->where('sales.status', 'Credit')
                          ->orwhere('sales.status', 'Installment'); })
                          ->first();

                $outstandings = sale::join('customers','sales.customer_id','customers.id')
                    ->leftjoin('customer_wallets','customer_wallets.customer_id','customers.id')
                    ->select('sales.*','customers.customer_name','customers.id as cid','customer_wallets.balance as wallet_balance')
                    ->where(function ($query) {
                        $query->where('sales.status', 'Credit')
                              ->orwhere('sales.status', 'Installment'); })->get();
            return view('admin.sales.outstandings',compact('outstandings','sales_total'));
                    }

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
    $order = order::where('id',$id)->get();
    $delete = orderItem::where('order_id',$id)->first();
if($delete || $order){
    $delete = orderItem::where('order_id',$id)->delete();
    $delete_order = order::where('id',$id)->delete();
    return redirect()->back()->with('success','Order deleted successfuly');
}
else{
    return redirect()->back()->with('error','Order can not be deleted, is not existing');
}
    }
}
