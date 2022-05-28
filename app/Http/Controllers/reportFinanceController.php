<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\assetValue;
use App\Models\cashIn;
use App\Models\customer;
use App\Models\customerWallet;
use App\Models\direct_expenses;
use App\Models\liablityValue;
use App\Models\order;
use App\Models\orderItem;
use App\Models\purchase;
use App\Models\purchaseOrder;
use App\Models\sale;
use App\Models\stock;
use App\Models\stocking;
use App\Models\store;
use App\Models\subStore;
use App\Models\supplier;
use App\Models\supplierWallet;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reportFinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
$credit_customer = customer::select(DB::raw('SUM(customers.to) as total_credit'))->first();
$advance_supplier = supplierWallet::select(DB::raw('SUM(supplier_wallets.balance) as total_supplier_advance'))->first();
$supplier_credits = supplier::select(DB::raw('SUM(suppliers.to) as total_supplier_credits'))->first();

// return Carbon::now()->startOfMonth()->submonth()->toDateString();
$endofmonth=  Carbon::now()->endOfMonth()->submonth()->toDateString();
$last_month_data = assetValue::wheredate('created_at',$endofmonth)
->first();
// $cash_previous
// $credit_previous
// $advance_supplier_previous
// $stock_value_previous

 $cash_previous = cashIn::select('cash_ins.amount_to')->
 wherebetween('created_at',[Carbon::now()->startOfMonth()->submonth()->toDateString(),Carbon::now()->endOfMonth()->submonth()->toDateString()])
 ->latest()->first();

$credit_previous = customer::select(DB::raw('SUM(customers.to) as total_credit_previous'))
 ->wherebetween('created_at',[
     Carbon::now()->startOfMonth()->submonth()->toDateString(),
    Carbon::now()->endOfMonth()->submonth()->toDateString()])
 ->first();

 $advance_supplier_previous = supplierWallet::select(DB::raw('SUM(supplier_wallets.balance) as total_previous_advance'))
 ->wherebetween('created_at',[Carbon::now()->startOfMonth()->submonth()->toDateString(),Carbon::now()->endOfMonth()->submonth()->toDateString()])
 ->first();

$expenses = direct_expenses::select(DB::raw('SUM(direct_expenses.amount) as total_expenses'))
->where('status','Pending')
->wherebetween('created_at',[Carbon::now()->startOfMonth()->toDateString(),Carbon::now()->endOfMonth()->toDateString()])
->first();

$assets = assetValue::
        whereBetween('created_at',
        [Carbon::now()->startOfMonth(),
        Carbon::now()->endOfMonth()])
        ->latest()
        ->first();
$liabilities = liablityValue::
        whereBetween('created_at',
        [Carbon::now()->startOfMonth(),
        Carbon::now()->endOfMonth()])
        ->latest()
        ->first();

$customer_wallet = customerWallet::select(DB::raw('SUM(customer_wallets.balance) as total_wallet'))->first();
$stock_value = subStore::join('stocks','sub_stores.item_id','stocks.id')
                ->select(DB::raw('SUM(sub_stores.current_qty*stocks.selling_price)total_value'))
                ->first();

$stock_cost = subStore::join('stocks','sub_stores.item_id','stocks.id')
                ->select(DB::raw('SUM(sub_stores.current_qty*stocks.price)total_cost'))
                ->first();
 $customers = customer::get();
 $salespeople = User::get();


 return view('admin.reports.finance.finance',compact('assets','liabilities','sales','customers','salespeople','totals','total_customers','last_month_data',
        'cash_in_hand','cash_previous','credit_customer','advance_supplier','supplier_credits',
        'credit_previous','advance_supplier_previous',
        'stock_value','expenses','customer_wallet','stock_cost'));

    }
/**
 * filter finance
 */

 public function filterfinance(){
        //
        $start_d = substr(request('date'),0,10);
        $start_date = Carbon::parse($start_d)->format('Y-m-d').' 00:00:00';
        $end_d = substr(request('date'),-10);
        $end_date = Carbon::parse($end_d)->format('Y-m-d').' 23:59:00';

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
 $cash_previous = cashIn::
 select('cash_ins.*', DB::raw('SUM(amount_received) as total_revenue'))
 ->wherebetween('created_at',[Carbon::today(),Carbon::now()->month()])
 ->first();

 $customers = customer::get();
 $salespeople = User::get();

 $cash_in_hand = account::where('main_account',1)->first();
$credit_customer = customer::select(DB::raw('SUM(customers.to) as total_credit'))->first();
$advance_supplier = supplierWallet::select(DB::raw('SUM(supplier_wallets.balance) as total_supplier_advance'))->first();
$supplier_credits = supplier::select(DB::raw('SUM(suppliers.to) as total_supplier_credits'))->first();
$stock_value = subStore::join('stocks','sub_stores.item_id','stocks.id')
                ->select(DB::raw('SUM(sub_stores.current_qty*stocks.selling_price)total_value'))
                ->first();
$customer_wallet = customerWallet::select(DB::raw('SUM(customer_wallets.balance) as total_wallet'))->first();
$expenses = direct_expenses::select(DB::raw('SUM(direct_expenses.amount) as total_expenses'))
        ->where('status','Pending')
        ->wherebetween('created_at',[Carbon::now()->startOfMonth()->toDateString(),Carbon::now()->endOfMonth()->toDateString()])
        ->first();
$stock_cost = subStore::join('stocks','sub_stores.item_id','stocks.id')
                ->select(DB::raw('SUM(sub_stores.current_qty*stocks.price)total_cost'))
                ->first();

 return view('admin.reports.finance.finance',compact(
     'cash_in_hand','credit_customer','advance_supplier','supplier_credits','stock_value','customer_wallet','expenses','stock_cost','last_month_data',
     'sales','customers','salespeople','totals','total_customers'
        ,'cash_in_hand','cash_previous'));
 }
 /**
  * Purchased report
  */
 public function purchaseReport(){
           $purchases = purchaseOrder::
            join('purchase_items','purchase_items.order_id','purchase_orders.id')
            ->join('stocks','stocks.id','purchase_items.item_id')
            ->select('purchase_items.qty','stocks.id as stock_id','stocks.item','purchase_orders.payment',
            DB::raw('SUM(purchase_items.qty) as total_qty'),
            )
            ->where('purchase_orders.status','!=','Pending')
            ->groupby('purchase_items.item_id')
            ->get();

            $solds = orderItem::join('orders','orders.id','order_items.order_id')
            ->join('stocks','stocks.id','order_items.item_id')
            ->select(DB::raw('SUM(order_items.qty) as sold_qty'),
            'stocks.item','stocks.id as stock_id','orders.status')
            ->groupby('order_items.item_id')
            ->where('orders.status','Sold')
            ->get();


            $substores = subStore::join('stocks','sub_stores.item_id','stocks.id')
            ->select(DB::raw('SUM(sub_stores.current_qty) as current_qty'),
            'stocks.item','stocks.id as stock_id')
            ->groupby('sub_stores.item_id')->get();


            return view('admin.reports.purchase.puchase-report',compact('purchases','substores','solds'));
         }
/**
  * Purchased report filter
  */
  public function purchaseFilter(){
    $start_d = substr(request('date'),0,10);
    $start_date = Carbon::parse($start_d)->format('Y-m-d').' 00:00:00';
    $end_d = substr(request('date'),-10);
    $end_date = Carbon::parse($end_d)->format('Y-m-d').' 23:59:00';


       $purchases = purchaseOrder::
       join('purchase_items','purchase_items.order_id','purchase_orders.id')
       ->join('stocks','stocks.id','purchase_items.item_id')
       ->select('purchase_items.qty','stocks.id as stock_id','stocks.item','purchase_orders.payment',
       DB::raw('SUM(purchase_items.qty) as total_qty'),
       )
       ->where('purchase_orders.status','!=','Pending')
       ->groupby('purchase_items.item_id')
       ->wherebetween('purchase_orders.updated_at',[$start_date,$end_date])
       ->get();

       $solds = orderItem::join('orders','orders.id','order_items.order_id')
       ->join('stocks','stocks.id','order_items.item_id')
       ->select(DB::raw('SUM(order_items.qty) as sold_qty'),
       'stocks.item','orders.status','stocks.id as stock_id',)
       ->groupby('order_items.item_id')
       ->where('orders.status','Sold')
       ->wherebetween('orders.updated_at',[$start_date,$end_date])
       ->get();


       $substores = subStore::join('stocks','sub_stores.item_id','stocks.id')
       ->select(DB::raw('SUM(sub_stores.current_qty) as current_qty'), 'stocks.item','stocks.id as stock_id')
       ->groupby('sub_stores.item_id')
       ->get();

       return view('admin.reports.purchase.puchase-report',compact('purchases','substores','solds'));
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
        $purchases = purchaseOrder::
       join('purchase_items','purchase_items.order_id','purchase_orders.id')
       ->join('stocks','stocks.id','purchase_items.item_id')
       ->select('purchase_items.qty','stocks.item','purchase_orders.payment','purchase_items.created_at'
       )
       ->where('purchase_orders.status','!=','Pending')
       ->where('purchase_items.item_id',$id)
       ->get();

       $purchases_sum = purchaseOrder::
       join('purchase_items','purchase_items.order_id','purchase_orders.id')
       ->join('stocks','stocks.id','purchase_items.item_id')
       ->select('purchase_items.qty','stocks.item','purchase_orders.*',
       DB::raw('SUM(purchase_items.qty) as total_qty'),
       )
       ->where('purchase_orders.status','!=','Pending')
       ->where('purchase_items.item_id',$id)
       ->first();
       return view('admin.reports.purchase.show-purchase-report',compact('purchases','purchases_sum'));
    }
 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sold($id)
    {
        $purchases = order::join('order_items','order_items.order_id','orders.id')
        ->join('stocks','order_items.item_id','stocks.id')
        ->join('users','users.id','orders.user_id')
        ->select('order_items.qty','stocks.item','users.name as payment','order_items.created_at')
        ->where('order_items.item_id',$id)
        ->where('orders.status','Sold')
       ->get();

       $purchases_sum = order::join('order_items','order_items.order_id','orders.id')
       ->join('stocks','order_items.item_id','stocks.id')
       ->select('order_items.qty','stocks.item',
       DB::raw('SUM(order_items.qty) as total_qty'))
       ->where('order_items.item_id',$id)
       ->where('orders.status','Sold')
       ->first();
       return view('admin.reports.purchase.show-purchase-report',compact('purchases','purchases_sum'));
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function instock($id)
    {
        $purchases = subStore::join('stocks','stocks.id','sub_stores.item_id')
        ->join('warehouses','sub_stores.warehouse','warehouses.id')
        ->select('sub_stores.current_qty as qty','stocks.item','warehouses.warehouse as payment','sub_stores.updated_at as created_at')
        ->where('sub_stores.item_id',$id)
        ->get();

       $purchases_sum = subStore::join('stocks','stocks.id','sub_stores.item_id')
       ->select(
       DB::raw('SUM(sub_stores.current_qty) as total_qty'))
       ->where('sub_stores.item_id',$id)
       ->first();
       return view('admin.reports.purchase.show-purchase-report',compact('purchases','purchases_sum'));
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
