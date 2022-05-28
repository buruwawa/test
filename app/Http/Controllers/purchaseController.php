<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\cashIn;
use App\Models\purchase;
use App\Models\purchaseItem;
use App\Models\purchaseOrder;
use App\Models\stock;
use App\Models\stocking;
use App\Models\store;
use App\Models\subStore;
use App\Models\supplier;
use App\Models\supplierAccountSummary;
use App\Models\User;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class purchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = supplier::get();
        $warehouses = warehouse::wheremain_warehouse(1)->get();
        return view('admin.stocking.stock-purchase', compact('suppliers','warehouses'));
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
//dd('dddd');
         // Supplier order
         if(request('supplier_id')){
             // check if the order is exists
            if(purchaseOrder::where('supplier_id',request('supplier_id'))
            ->where('status','Pending')
            ->where('user_id',auth()->id())
            ->exists()){
                $order = purchaseOrder::where('supplier_id',request('supplier_id'))
                ->where('user_id',auth()->id())
                ->where('status','Pending')
                ->first();
                return redirect()->route('stock-purchase.show',$order->id);
            }
            else{
                $wareshouse_id = request('warehouse_id');
        // then create order
        $newOrder = purchaseOrder::create([
            'supplier_id'=>request('supplier_id'),
            'status'=>'Pending',
            'warehouse_id'=>$wareshouse_id,
            'user_id'=>auth()->id()
            ]);
            return redirect()->route('stock-purchase.show',$newOrder->id);
        }
    }
        // Collect items to purchase
        if(request('item_id')){

            $order_id = purchaseOrder::where('id',request('id'))->first();
            //check if item already exists
            if(purchaseItem::where('order_id',request('id'))->where('item_id',request('item_id'))->exists()){
                return redirect()->back()->with('error','This product already added');
            }
            else{

            $buying_price = stock::where('id',request('item_id'))->first();
            $newitemorder = purchaseItem::create([
            'order_id'=>request('id'),
            'item_id'=>request('item_id'),
             'width'=>request('width'),
              'height'=>request('height'),
            'qty'=>1,
            'user_id'=>auth()->id()
            ]);
            return redirect()->back()->with('success','Item added to the order list');
        }
        return redirect()->back()->with('success','Item added to the order list');

        }

        // Create purchase record
        if(request('purchase_now')){

            // update purchase order table
            $minimum = account::where('main_account',1)->first();
            $min = $minimum->total;

        $purchaseOrder = purchaseOrder::where('id',request('order_id'))->first();
        if($purchaseOrder){

            if(request('status') == 'Installment'){
               $validator =  $request->validate([
                    'installment'=>"lte:$min"
                    ]);
                $paid = request('installment');
                $balance = request('amount') -  $paid;
            }
            if(request('status') == "Cash"){
                $validator = $request->validate([
                    'amount'=>"lte:$min"
                    ]);
                $paid = $request->input('amount');
                $balance =0;

            }
            if(request('status') == "Credit"){
                $paid = 0;
                $balance = request('amount');
            }

            $purchaseOrd= purchaseOrder::where('id',request('order_id'))->update([
                'discount'=>0,
                'amount'=>request('amount'),
                'paid'=>$paid,
                'balance'=>$balance,
                'status'=>request('status'),
                'payment'=>'Purchased'
            ]);
             // deduct amount from main account
             $account = account::where('main_account',1)->first();
             $cashin = cashIn::create([
                'account_id'=>$account->id,
                'amount_received'=>-$paid,
                'amount_to'=>$account->total - $paid,
                'cash_category'=>'Purchases',
                'cash_descriptions'=>'Purchase Payments',
                'user_id'=>auth()->id(),
             ]);
             $accounts = account::where('main_account',1)->update([
                 'total'=>$account->total - $paid
             ]);
              // Add advanced payment to supplier account
            $supplier = supplier::where('id',$purchaseOrder->supplier_id)->first();

            $from = $supplier->to;
            $to = $from - $balance;
            $supplied = supplier::where('id',$purchaseOrder->supplier_id)->update(
                [
                    'from'=>$from,
                    'to'=>$to
                ]);
            // create suppliers account records
            $payment = supplierAccountSummary::create(
                [
                    'supplier_id'=> $supplier->id,
                    'from'=>$from,
                    'to'=>$to,
                    'status'=>'Purchase',
                    'user_id'=>auth()->id()
                ]);

            // add items to main store
            $warehouse = request('warehouse_id');
            $main_store = warehouse::where('main_warehouse',1)->first();
            $stores = purchaseItem::where('order_id',request('order_id'))->get();
            foreach($stores as $store){
                if(subStore::where('item_id',$store->item_id)->where('warehouse',$main_store->id)->exists()){
                $current_stock = subStore::where('item_id',$store->item_id)->where('warehouse',$main_store->id)->first();
                // Add record to stocking
                $stocking = stocking::create([
                    'item_id'=>$store->item_id,
                    'qty'=>$store->qty,
                    'current_qty'=>$current_stock->current_qty + $store->qty,
                    'from'=>$purchaseOrder->supplier_id,
                    'to'=> $warehouse,
                    'status'=>'Purchsed',
                    'user_id'=>auth()->id()
                   ]);
                   // Add stock to  store
                $updated = subStore::where('item_id',$store->item_id)->where('warehouse',$main_store->id)->update([
                    'current_qty'=> $current_stock->current_qty + $store->qty,
                    'warehouse'=>$warehouse
                ]);
            }
            else{
                $create = subStore::create([
                    'warehouse'=>$warehouse,
                    'warehouse_name'=>$main_store->warehouse,
                    'item_id'=>$store->item_id,
                    'current_qty'=>$store->qty
                ]);
                // Add record to stocking
                $stocking = stocking::create([
                    'item_id'=>$store->item_id,
                    'qty'=>$store->qty,
                    'current_qty'=>$store->qty,
                    'from'=>$purchaseOrder->supplier_id,
                    'to'=> $warehouse,
                    'status'=>'Purchsed',
                    'user_id'=>auth()->id()
                    ]);
            }
        }
             return redirect()->back()->with('success','supplier created successfuly');


}
    }
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
        // dd('wawa');
        $orders = purchaseOrder::where('id',$id)
        ->where('status','Pending')
        ->where('user_id',auth()->id())
        ->first();
        if($orders){
        $suppliers = supplier::join('purchase_orders','purchase_orders.supplier_id','suppliers.id')
        ->where('purchase_orders.status','Pending')
        ->where('purchase_orders.id',$id)
        ->first();
        $items = stock::get();
        $main_store = warehouse::where('main_warehouse',1)->first();
        $order_items = purchaseItem::join('stocks','purchase_items.item_id','stocks.id')
        ->select('purchase_items.*','stocks.item','stocks.price')
        ->where('purchase_items.order_id',$id)
        ->get();

        $pos = purchaseItem::join('purchase_orders','purchase_items.order_id','purchase_orders.id')
        ->join('stocks','purchase_items.item_id','stocks.id')
        ->select('*',
        DB::raw("sum(purchase_items.qty) as order_qty"),
        DB::raw("SUM(stocks.price * purchase_items.qty) as subtotal"),
        DB::raw("SUM(stocks.price * purchase_items.qty * stocks.vat) as vat")
        )
        ->where('purchase_items.order_id',$id)
        ->where('purchase_orders.status','Pending')
        ->get();

        return view('admin.stocking.show-purchase',compact('orders','id','suppliers','items','order_items','pos'));
    }
    else{
        return redirect()->route('stock-purchase.index')->with('success','Purchase created successfully');
    }
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
//dd('dd');
        if(request('draft')){
            $oders = purchaseItem::where('order_id',$id)->first();
            $item_id = request('item_id');
             $qty = request('qty');
              $width = request('width');
               $height = request('height');
                $buying_price = request('buying_price');
                   $cost = request('cost');
                //dd($buying_price);

             for ($i=0; $i < count($item_id); $i++) {
                $update = purchaseItem::where('id',$item_id[$i])->update([
                    'width'=>$width[$i],
                    'height'=>$height[$i],
                    'qty'=>$qty[$i],
                    'buying_price'=>$buying_price[$i],
                     'cost'=>$cost[$i],
                     //'cost'=>'buying_price' *2,
                    // 'selling_price'=>request('selling_price')
                ]);
             }
             return redirect()->back()->with('success','Items qty added successfuly');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(request('delete')){
        $to_delete = purchaseItem::where('id',request('order_id'))->first();
        if($to_delete){
            $to_delete->delete();
            return redirect()->back()->with('success','Deleted successfully');
        }
        else{
            return redirect()->back()->with('error','No items to delete');
        }
    }


    }
}
