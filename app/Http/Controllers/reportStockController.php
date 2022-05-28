<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\orderItem;
use App\Models\stock;
use App\Models\User;
use App\Models\warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reportStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sales = stock::join('sub_stores','stocks.id','sub_stores.item_id')
        ->select('sub_stores.*','stocks.*',
        DB::raw('SUM(sub_stores.current_qty) as store_total'))
        ->groupby('sub_stores.item_id')
        ->get();



        $main_warehouse = warehouse::where('main_warehouse',1)->first();

        $stock_alert = stock::join('sub_stores','stocks.id','sub_stores.item_id')
        ->where('sub_stores.warehouse',$main_warehouse->id)
        ->orderby('sub_stores.current_qty','Asc')
        ->get();

        $fast_moving_stock = orderItem::join('stocks','stocks.id','order_items.item_id')
        ->join('orders','order_items.order_id','orders.id')
        ->select('stocks.item','order_items.qty',
            DB::raw('SUM(order_items.qty) as total_stock')
        )
        ->groupby('order_items.item_id')
        ->where('orders.status','Sold')
        ->wherebetween('order_items.created_at',
        [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])
        ->orderby('order_items.qty','Desc')
        ->limit(10)
       ->get();

       $fast_moving_rate= orderItem::join('stocks','stocks.id','order_items.item_id')
       ->join('orders','order_items.order_id','orders.id')
       ->select(DB::raw('SUM(order_items.qty) as total_qty'))
       ->where('orders.status','Sold')
       ->wherebetween('order_items.created_at',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])
       ->orderby('total_qty','Desc')
      ->first();

        $customers = customer::get();
        $salespeople = User::get();


        return view('admin.reports.stocks.index',compact('sales','customers','salespeople','stock_alert','fast_moving_stock','fast_moving_rate'));

    }

    public function stock_alert()
    {
        //
        $sales = stock::join('sub_stores','stocks.id','sub_stores.item_id')
        ->select('sub_stores.*','stocks.*',
        DB::raw('SUM(sub_stores.current_qty) as store_total'))
        ->groupby('sub_stores.item_id')
        ->get();



        $main_warehouse = warehouse::where('main_warehouse',1)->first();

        $stock_alert = stock::join('sub_stores','stocks.id','sub_stores.item_id')
        ->where('sub_stores.warehouse',$main_warehouse->id)
        ->orderby('sub_stores.current_qty','Asc')
        ->get();

        $fast_moving_stock = orderItem::join('stocks','stocks.id','order_items.item_id')
        ->join('orders','order_items.order_id','orders.id')
        ->select('stocks.item','order_items.qty',
            DB::raw('SUM(order_items.qty) as total_stock')
        )
        ->groupby('order_items.item_id')
        ->where('orders.status','Sold')
        ->wherebetween('order_items.created_at',
        [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])
        ->orderby('order_items.qty','Desc')
        ->limit(10)
       ->get();

       $fast_moving_rate= orderItem::join('stocks','stocks.id','order_items.item_id')
       ->join('orders','order_items.order_id','orders.id')
       ->select(DB::raw('SUM(order_items.qty) as total_qty'))
       ->where('orders.status','Sold')
       ->wherebetween('order_items.created_at',[Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])
       ->orderby('total_qty','Desc')
      ->first();

        $customers = customer::get();
        $salespeople = User::get();


        return view('admin.reports.stocks.stock-alert',compact('sales','customers','salespeople','stock_alert','fast_moving_stock','fast_moving_rate'));

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
