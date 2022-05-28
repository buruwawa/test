<?php

namespace App\Http\Controllers;

use App\Models\purchase;
use App\Models\purchaseItem;
use App\Models\purchaseOrder;
use App\Models\stock;
use App\Models\stocking;
use App\Models\store;
use App\Models\subStore;
use App\Models\supplier;
use App\Models\User;
use App\Models\warehouse;
use App\Models\pendingStock;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class stockingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_store = warehouse::where('main_warehouse',1)->first();
        $stockings = subStore::join('stocks','sub_stores.item_id','stocks.id')
        ->join('warehouses','sub_stores.warehouse','warehouses.id')
        ->select('sub_stores.*','stocks.item','stocks.material_code','stocks.price',
        'stocks.selling_price','stocks.descriptions','warehouses.id as wId','warehouses.warehouse')
        ->where('sub_stores.warehouse',$main_store->id)
        ->get();

        $stocks = stock::get();
        $suppliers = supplier::get();
        $warehouses = warehouse::get();
        return view('admin.stocking.stock',compact('stockings','stocks','suppliers','warehouses'));
    }

   public function my_stock()
    {
        $user = User::where('id',auth()->id())->first();
        $permissions = User::join('model_has_permissions','users.id','model_has_permissions.model_id')
        ->join('permissions','model_has_permissions.permission_id','permissions.id')
        ->where('model_has_permissions.model_id',auth()->id())
        ->select('permissions.name as permission_name','model_has_permissions.model_id as model_id','users.*')
        ->first();

        $whareh = warehouse::where('warehouse',$permissions->permission_name)->first();

        if($whareh){
        $wharehouse_id = $whareh->id;

        $stockings = subStore::join('stocks','sub_stores.item_id','stocks.id')
        ->join('warehouses','warehouses.id','sub_stores.warehouse')
        ->select('sub_stores.*','stocks.item','stocks.material_code','stocks.selling_price','stocks.price','stocks.descriptions','warehouses.warehouse as wname','warehouses.id as wID')
        ->where('sub_stores.warehouse', $wharehouse_id)
        ->get();
        $stocks = stock::get();
        $suppliers = supplier::get();
        $warehouses = warehouse::wheremain_warehouse(1)->get();
        $from_wherehouse = warehouse::where('id',$wharehouse_id)->first();
       
        return view('admin.stocking.mystock',compact('stockings','stocks','suppliers','warehouses','permissions','from_wherehouse'));
    }
    else{
        return redirect()->back()->with('error','You do not have any warehouse, please ask permission for the warehouse first');
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

     public function pendingIndex()
    {
     $main_store = warehouse::where('main_warehouse',1)->first();
        
     $pendingStocks = pendingStock::join('stocks','pending_stocks.item_id','stocks.id')
       ->join('warehouses','pending_stocks.to_store','warehouses.warehouse')
       ->select('pending_stocks.*','stocks.item','pending_stocks.id as pending_id','warehouses.id')
       ->where('trans_type','Issued')
         ->get();
       
        $stocks = stock::get();
        $suppliers = supplier::get();
        $warehouses = warehouse::get();
        return view('admin.stocking.pending-stock',compact('pendingStocks','stocks','suppliers','warehouses'));
    }

    public function returnedIndex()
    {
        $user = User::where('id',auth()->id())->first();
        $permissions = User::join('model_has_permissions','users.id','model_has_permissions.model_id')
        ->join('permissions','model_has_permissions.permission_id','permissions.id')
        ->where('model_has_permissions.model_id',auth()->id())
        ->select('permissions.name as permission_name','model_has_permissions.model_id as model_id','users.*')
        ->first();

        $whareh = warehouse::where('warehouse',$permissions->permission_name)->first();

        if($whareh){
        $wharehouse_id = $whareh->id;

        $stockings = subStore::join('stocks','sub_stores.item_id','stocks.id')
        ->join('warehouses','warehouses.id','sub_stores.warehouse')
        ->select('sub_stores.*','stocks.item','stocks.material_code','stocks.selling_price','stocks.price','stocks.descriptions','warehouses.warehouse as wname','warehouses.id as wID')
        ->where('sub_stores.warehouse', $wharehouse_id)
        ->get();

         $pendingStocks = pendingStock::join('stocks','pending_stocks.item_id','stocks.id')
       ->join('warehouses','pending_stocks.to_store','warehouses.warehouse')
       ->select('pending_stocks.*','stocks.item','pending_stocks.id as pending_id','warehouses.id')
       ->where('pending_stocks.trans_type','Returned')
         ->get();

       // dd($pendingStocks);

        $stocks = stock::get();
        $suppliers = supplier::get();
        $warehouses = warehouse::wheremain_warehouse(1)->get();
        $from_wherehouse = warehouse::where('id',$wharehouse_id)->first();
       
        return view('admin.stocking.returned-stock',compact('stockings','stocks','suppliers','warehouses','permissions','from_wherehouse','pendingStocks'));
    }
    else{
        return redirect()->back()->with('error','You do not have any warehouse, please ask permission for the warehouse first');
    }

}


  public function pendingStock()
    {
$status="Issued";
if(request('return_stock'))
{
    $status="Returned";
}

    $pin=rand(111111,999999);
     $warehouse = warehouse::where('id',request('to'))->first();
      
       $pendingStock = pendingStock::UpdateOrCreate([            
            'item_id'=>request('item_id'),
            'trans_no'=>$pin,
            'from_store'=>request('from'),
            'Qty_issued'=>request('qty'),
            'to_store'=> $warehouse->warehouse,
            'trans_type'=>$status,
            'user_id'=>auth()->id()
        ]);

       return redirect()->back()->with('success','Stock issued successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        if(request('receive')){   
//  create purchase order
        $purchase_order = purchaseOrder::create([
            'supplier_id'=>request('from'),
            'warehouse_id'=>request('to'),
            'discount'=>0,
            'amount'=>0,
            'paid'=>0,
            'balance'=>0,
            'status'=>'Free_stock',
            'payment'=>'Offer',
            'user_id'=>auth()->id()
        ]);
// Create order for the purchased items
        $purchaseditem = purchaseItem::create([
                'order_id'=> $purchase_order->id,
                'item_id'=>request('item_id'),
                'buying_price'=>0,
                'qty'=>request('qty'),
            ]);
       $main_store = warehouse::where('main_warehouse',1)->first();
       $current_stock =  subStore::where('item_id',request('item_id'))->where('warehouse',$main_store->id)->first();

       if($current_stock){
        $currentqty = $current_stock->current_qty;
         $store = subStore::where('item_id',request('item_id'))->where('warehouse',$main_store->id)->update([
            'current_qty'=>$currentqty + request('qty')
        ]);
        return redirect()->back()->with('success','The stock is added successfuly');
    }
    else{
        $store = subStore::create([
            'warehouse'=> $main_store->id,
            'warehouse_name'=>$main_store->warehouse,
            'item_id'=>request('item_id'),
            'current_qty'=>request('qty')
        ]);
        return redirect()->back()->with('success','The stock is added successfuly');
    }

    }
    elseif(request('issue')){
        
        $main_store = warehouse::where('main_warehouse',1)->first();
      
        $currentstock = subStore::where('item_id',request('item_id'))->where('warehouse',$main_store->id)->latest()->first();
      
        if($currentstock->current_qty >= request('qty')){
        $substore = subStore::where('item_id',request('item_id'))->where('warehouse',request('
            '))->first();
        if($substore){
            $current_stock = $substore->current_qty;
        }
        else{
            $current_stock = 0;
        }
 
    // Update pending_stock
      $UpdatePendingStock = pendingStock::where('id',request('pending_id'))
             // ->where('tour_addon','Programs')
             ->update([
            'Qty_issued'=>request('pending_qty')-request('qty'),
            'Qty_received'=>request('qty'),
             'trans_type'=>'Received'
        ]);

// creating stock movement records
        $issuing_stock = - request('qty');
        $stockings = stocking::create([
            'item_id'=>request('item_id'),
            'qty'=>$issuing_stock,
            'current_qty'=>$current_stock + request('qty'),
            'from'=>request('from'),
            'to'=>request('to'),
            'status'=>'Issue',
            'user_id'=>auth()->id()
        ]);
// deducting stock from main warehouse
           $mainstore =  subStore::where('item_id',request('item_id'))->where('warehouse',$main_store->id)->first();
           $main_current_qty =  $mainstore->current_qty;

            $store = subStore::where('item_id',request('item_id'))->where('warehouse',$main_store->id)->update([
                'current_qty'=>$main_current_qty + $issuing_stock
            ]);

        // for sub store
        $subcurrentstock = subStore::where('item_id',request('item_id'))->where('warehouse',request('to'))->first();
        $receive_stock = request('qty');
        $warehous = warehouse::where('id',request('to'))->first();
        if(subStore::where('item_id',request('item_id'))->where('warehouse',request('to'))->exists()){
            $substore_stock = $subcurrentstock->current_qty;
            $store = subStore::where('id',$subcurrentstock->id)->update([
                'current_qty'=>$substore_stock + $receive_stock
            ]);
            
        }
        else{
             
             $store = subStore::create([
            'warehouse'=>request('to'),
            'warehouse_name'=>$main_store->warehouse,
            'item_id'=>request('item_id'),
            'current_qty'=>request('qty')
        ]);
        }

        }
        else{
            return redirect()->back()->with('error','You have insuficient stock');
        }

    }
    // Returning stocks
    elseif(request('return_stock')){

        $main_store = warehouse::where('main_warehouse',1)->first();
      
        // $warehouse_id = warehouse::where('warehouse_name',request('from'))
        // ->where('item_id',request('item_id'))
        
   $warehouse_id  = subStore::where('warehouse_name',request('from'))
        ->where('item_id',request('item_id'))
        ->first();

    $return_stock  = subStore::where('warehouse',$warehouse_id->warehouse)
        ->where('item_id',request('item_id'))
        ->first();

        $currentstock = subStore::where('item_id',request('item_id'))->where('warehouse',$main_store->id)->latest()->first();
     
        if($return_stock->current_qty >= request('qty')){
            // reduce sub store
        $substore = subStore::where('warehouse',$warehouse_id->warehouse)
        ->where('item_id',request('item_id'))->update([
            'current_qty'=> $return_stock->current_qty - request('qty'),
        ]);
         // add to main store
        $store_stock = subStore::where('item_id',request('item_id'))->where('warehouse',$main_store->id)->first();
        $store = subStore::where('item_id',request('item_id'))->where('warehouse',$main_store->id)->update([
            'current_qty'=> $store_stock->current_qty + request('qty'),
        ]);

// dd(request('qty'));
    // Update pending_stock
      $UpdatePendingStock = pendingStock::where('id',request('pending_id'))
             // ->where('tour_addon','Programs')
             ->update([
            'Qty_issued'=>request('pending_qty')-request('qty'),
            'Qty_received'=>request('qty'),
             'trans_type'=>'Received'
        ]);

        // Create stocking history
        $stockings = stocking::create([
            'item_id'=>request('item_id'),
            'qty'=>request('qty'),
            'current_qty'=>$return_stock->current_qty - request('qty'),
            'from'=>$warehouse_id->warehouse,
            'to'=>$store_stock->id,
            'status'=>'Returned',
            'user_id'=>auth()->id()
        ]);
    }
    return redirect()->back()->with('success','Stocks is returned successfully');
    }
        return redirect()->back()->with('success','Stocks is received successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
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
       $toupdate = pendingStock::where('id',$id)->update([
        
            'trans_type'=>'Cancelled',
               'user_id'=>auth()->id(),
               'updated_at'=>Now(),
              ]);  
       return redirect()->route('pending-stock')->with('success','Ops The Item was Cancelled');
                   
    }
}
