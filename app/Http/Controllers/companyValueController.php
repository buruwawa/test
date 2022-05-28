<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\assetValue;
use App\Models\cashIn;
use App\Models\customer;
use App\Models\customerWallet;
use App\Models\direct_expenses;
use App\Models\liablityValue;
use App\Models\sale;
use App\Models\subStore;
use App\Models\supplier;
use App\Models\supplierWallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class companyValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 $sales = sale::join('customers','customers.id','sales.customer_id')
 ->join('users','sales.user_id','users.id')
 ->select('sales.*','customers.customer_name','users.name','customers.id as cid')
 ->get();

 $totals = sale::rightjoin('customers','customers.id','sales.customer_id')
 ->select(['sales.*','customers.customer_name',
 DB::raw('COUNT(customers.customer_name) as total_customers'),
 DB::raw('SUM(sales.amount) as total_revenue'),
 DB::raw('SUM(sales.paid) as total_cash'),
 DB::raw('SUM(sales.balance) as total_credit')
 ])->first();
 $total_customers = customer::select(['*',
 DB::raw('COUNT(customer_name) as total_customers')
 ])->first();


 $cash_in_hand = account::where('main_account',1)->first();
 $cash_previous = cashIn::select('cash_ins.amount_to')->
 wherebetween('created_at',[Carbon::now()->startOfMonth()->submonth()->toDateString(),Carbon::now()->endOfMonth()->submonth()->toDateString()])
 ->latest()->first();
 $credit_customer = customer::select(DB::raw('SUM(customers.to) as total_credit'))->first();
 $credit_previous = customer::select(DB::raw('SUM(customers.to) as total_credit_previous'))
 ->wherebetween('created_at',[Carbon::now()->startOfMonth()->submonth()->toDateString(),Carbon::now()->endOfMonth()->submonth()->toDateString()])
 ->first();
 $advance_supplier = supplierWallet::select(DB::raw('SUM(supplier_wallets.balance) as total_supplier_advance'))->first();
 $advance_supplier_previous = supplierWallet::select(DB::raw('SUM(supplier_wallets.balance) as total_previous_advance'))
 ->wherebetween('created_at',[Carbon::now()->startOfMonth()->submonth()->toDateString(),Carbon::now()->endOfMonth()->submonth()->toDateString()])
 ->first();
$supplier_credits = supplier::select(DB::raw('SUM(suppliers.to) as total_supplier_credits'))->first();
$expenses = direct_expenses::select(DB::raw('SUM(direct_expenses.amount) as total_expenses'))
->where('status','Pending')
->wherebetween('created_at',[Carbon::now()->startOfMonth()->toDateString(),Carbon::now()->endOfMonth()->toDateString()])
->first();
$customer_wallet = customerWallet::select(DB::raw('SUM(customer_wallets.balance) as total_wallet'))->first();
$stock_value = subStore::join('stocks','sub_stores.item_id','stocks.id')
                ->select(DB::raw('SUM(sub_stores.current_qty*stocks.selling_price)total_value'))
                ->first();
$stock_cost = subStore::join('stocks','sub_stores.item_id','stocks.id')
                ->select(DB::raw('SUM(sub_stores.current_qty*stocks.price)total_cost'))
                ->first();


        $data = assetValue::create([
            'cash_in_hand'=>$cash_in_hand->total,
            'credit_customer'=>-$credit_customer->total_credit,
            'advance_paid_to_supplier'=>$advance_supplier->total_supplier_advance,
            'stock_value'=>$stock_value->total_value
                ]);

        $liability = liablityValue::create([
            'payable_supplier'=>-$supplier_credits->total_supplier_credits,
            'expenses'=>-$expenses->total_expenses,
            'advance_paid_by_customer'=>$customer_wallet->total_wallet
                ]);

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
