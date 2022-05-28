<?php

namespace App\Http\Controllers;

use App\Models\stock;
use App\Models\stocking;
use App\Models\subStore;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class storeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $substores = subStore::join('stocks','sub_stores.item_id','stocks.id')
        ->select(['sub_stores.*','stocks.*',
        DB::raw('stocks.item as items'),
        DB::raw('SUM(sub_stores.current_qty) as total')
        ])
        ->groupby('sub_stores.item_id')
        ->groupby('sub_stores.warehouse_name')
        ->get();

        $total = subStore::join('stocks','sub_stores.item_id','stocks.id')
        ->select(['sub_stores.*','stocks.*',
        DB::raw('SUM(sub_stores.current_qty) as total')
        ])
        ->groupby('sub_stores.item_id')
        ->get();

        $report=[];
        $substores->each(function($item) use (&$report){
            $report[$item->items][$item->warehouse_name] = [
                'items'=>$item->items,
                'current_qty'=>$item->current_qty,

            ];
        });

        $thereport  = $substores->pluck('warehouse_name')->sortby('sub_stores.warehouse')
        ->unique();
        return view('admin.stores.stores',compact('thereport','report','total'));
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
    public function show($id,$item)
    {
        //
        $store = warehouse::where('warehouse',$id)->first();
        $store_id = $store->id;
        $item = stock::where('item',request('item'))->first();
        $item_id = $item->id;

        if( $store->main_warehouse == 1){
        $main_warehouse_1 =  stocking::
        join('users','users.id','stockings.user_id')
        ->select('stockings.*','users.name')
        ->where('stockings.item_id',$item_id)
        ->where('stockings.from', $store_id)
        ->where('stockings.status', 'Issue');

        $main_warehouse_2 =  stocking::
        join('users','users.id','stockings.user_id')
        ->select('stockings.*','users.name')
        ->where('stockings.item_id',$item_id)
        ->where('stockings.to', $store_id)
        ->where('stockings.status', 'Purchsed');

        $main_warehouse_3 =  stocking::
        join('users','users.id','stockings.user_id')
        ->select('stockings.*','users.name')
        ->where('stockings.item_id',$item_id)
        ->where('stockings.to', $store_id)
        ->where('stockings.status', 'Returned');
        }
        else{
            $main_warehouse_1 =  stocking::
            join('users','users.id','stockings.user_id')
            ->select('stockings.*','users.name')
            ->where('stockings.item_id',$item_id)
            ->where('stockings.from', $store_id)
            ->where('stockings.status', 'no_status');

            $main_warehouse_2 =  stocking::
            join('users','users.id','stockings.user_id')
            ->select('stockings.*','users.name')
            ->where('stockings.item_id',$item_id)
            ->where('stockings.to', $store_id)
            ->where('stockings.status', 'no_status');

            $main_warehouse_3 =  stocking::
            join('users','users.id','stockings.user_id')
            ->select('stockings.*','users.name')
            ->where('stockings.item_id',$item_id)
            ->where('stockings.to', $store_id)
            ->where('stockings.status', 'no_status');
        }

        $first = stocking::
        join('users','users.id','stockings.user_id')
        ->select('stockings.*','users.name')
        ->where('stockings.item_id',$item_id)
        ->where('stockings.to', $store_id)
        ->where('stockings.status', 'Issue');

        $second = stocking::
        join('users','users.id','stockings.user_id')
        ->select('stockings.*','users.name')
        ->where('stockings.item_id',$item_id)
        ->where('stockings.from', $store_id)
        ->where('stockings.status', 'Returned');

        $third = stocking::
        join('users','users.id','stockings.user_id')
        ->select('stockings.*','users.name')
        ->where('stockings.item_id',$item_id)
        ->where('stockings.to', $store_id)
        ->where('stockings.status', 'Returned Sale');

        $show_item = stocking::
        join('users','users.id','stockings.user_id')
        ->select('stockings.*','users.name')
        ->where('stockings.item_id',$item_id)
        ->where('stockings.from', $store_id)
        ->where('stockings.status', 'Sold')
        ->union($first)
        ->union($second)
        ->union($third)
        ->union($main_warehouse_1)
        ->union($main_warehouse_2)
        ->union($main_warehouse_3)
        ->orderby('id', 'DESC')->get();

        return view('admin.stores.show_store',compact('show_item'));
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
