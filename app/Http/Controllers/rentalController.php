<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\cashIn;
use App\Models\customer;
use App\Models\customerAccountSummary;
use App\Models\customerWallet;
use App\Models\customerWalletSummury;
use App\Models\order;
use App\Models\orderItem;
use App\Models\payment;
use App\Models\rentalItem;
use App\Models\rentalOrder;
use App\Models\rentalOrderItem;
use App\Models\sale;
use App\Models\stock;
use App\Models\stocking;
use App\Models\subStore;
use App\Models\User;
use App\Models\warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class rentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customers = customer::get();
        $orders = rentalOrder::join('customers','rental_orders.customer_id','customers.id')
        ->select('rental_orders.id','customers.customer_name')
        ->where('rental_orders.status','Pending')
        ->where('rental_orders.user_id',auth()->id())
        ->get();
        return view('admin.rental.rental',compact('customers','orders'));
    }


/**
 * View the rental items
 */
    public function rental_items(){
        $stocks = stock::get();
        $rent_items = rentalItem::get();
        return view('admin.rental.items',compact('stocks','rent_items'));
    }
/**
 * Rent item store
 */
public function addRentItem(Request $request){
     $stocked = stock::where('id',request('item_id'))->first();
     if(rentalItem::where('item_id',$stocked->id)->exists()){
        return redirect()->back()->with('error','This item already exists');
     }
     else{
       $additem = rentalItem::create([
        'item_id'=>$stocked->id,
        'item'=>$stocked->item,
        'unit'=>$stocked->unit,
        'material_code'=>$stocked->material_code,
        'fee'=>request('fee'),
        'descriptions'=>$stocked->descriptions,
        'user_id'=>auth()->id()
       ]);

        return redirect()->back()->with('success','Item added successfuly');

    }
}

    /**
     * Create and store data
     */
public function createOrder(Request $request){
 // Create Customer order
 if(request('customer_id')){
    if(rentalOrder::where('customer_id',request('customer_id'))->where('status','Pending')->where('user_id',auth()->id())->exists()){
        $order = rentalOrder::where('customer_id',request('customer_id'))
        ->where('user_id',auth()->id())
        ->where('status','Pending')
        ->first();
        return redirect()->route('stock-rent.show',$order->id);
    }
    else{

// find warehouse using permission

// create order
$newOrder = rentalOrder::create([
    'customer_id'=>request('customer_id'),
    'status'=>'Pending',
    'user_id'=>auth()->id()
    ]);
    return redirect()->route('stock-rent.show',$newOrder->id);

}
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
         // Create Customer order
         if(request('customer_id')){
            if(order::where('customer_id',request('customer_id'))->where('status','Pending')->where('user_id',auth()->id())->exists()){
                $order = order::where('customer_id',request('customer_id'))
                ->where('user_id',auth()->id())
                ->where('status','Pending')
                ->first();
                return redirect()->route('pos.show',$order->id);
            }
            else{

        // find warehouse using permission
        $user = User::where('id',auth()->id())->first();
      $permissions = User::join('model_has_permissions','users.id','model_has_permissions.model_id')
        ->join('permissions','model_has_permissions.permission_id','permissions.id')
        ->select('permissions.name as permission_name','model_has_permissions.model_id as model_id','users.*')
        ->where('model_has_permissions.model_id',auth()->id())->limit(1)
        ->pluck('permissions.permission_name');
     $whareh = warehouse::where('warehouse',$permissions)->first();
        if($whareh){
        $wareshouse_id = $whareh->id;

        // create order
        $newOrder = order::create([
            'customer_id'=>request('customer_id'),
            'status'=>'Pending',
            'warehouse_id'=>$wareshouse_id,
            'user_id'=>auth()->id()
            ]);
            return redirect()->route('pos.show',$newOrder->id);
        }
        else{
            return redirect()->back()->with('error','You do not have any warehouse permission, kindly contact your supervisor');
        }
        }
    }
    // Collect Order
        if(request('item_id')){
             $fee = rentalItem::where('item_id',request('item_id'))->first();
            $newitemorder = rentalOrderItem::create([
            'order_id'=>request('id'),
            'item_id'=>request('item_id'),
            'fee'=>$fee->fee,
            'user_id'=>auth()->id()
            ]);
            return redirect()->back();
        }
        // sell
        if(request('shop_now')){
            $passedMinutes = Carbon::now()->addMinutes(-5);
            $acc_id = account::where('main_account',1)->first();
            if($acc_id){
                // check for duplicate
              $ordered = order::where('id',request('order_id'))->first();
              $stockings = stocking::latest()->first();
              if(sale::where('order_id',$ordered->id)->where('customer_id',$ordered->customer_id)->where('user_id',auth()->id())->exists()){
                return redirect()->route('pos.index')->with('error','This sales seems to be a duplicate, please review your orders and try again');
              }
              else{
                $duplicate_order = order::where('user_id',auth()->id())->where('id',request('order_id'))->where('status','Sold')->first();
                if($duplicate_order){
                 return redirect()->route('pos.index')->with('error','The sale performed is a duplicate');
                }
                else{
            // Create sale record
            $ordered = order::where('id',request('order_id'))->first();
            if($ordered){
                if(request('wallet')){
                    $wallet = request('wallet');
                }else{
                    $wallet = 0;
                }
                if(request('status')=="Installment"){
                    $paid = request('installment') + $wallet;
                    $balance = request('amount') - $paid;

                }
                elseif(request('status')=="Credit"){
                    $paid = 0;
                    $balance = request('amount');

                }
                elseif(request('status')=="Cash"){
                    $paid = request('amount');
                    $balance = 0;
                }
                elseif(request('status')=="Pay via E-wallet"){
                    $paid = request('amount');
                    $balance = 0;
                }
           $sell = sale::create([
                'order_id'=>$ordered->id,
                'customer_id'=>$ordered->customer_id,
                'discount'=>$ordered->discount,
                'vat'=>request('vat'),
                'amount'=>request('amount'),
                'paid'=>$paid,
                'wallet'=>$wallet,
                'balance'=>$balance,
                'status'=>request('status'),
                'user_id'=>auth()->id(),
            ]);



            //   start order item
            $the_stocked = orderItem::
            join('sub_stores','sub_stores.item_id','order_items.item_id')
            ->join('orders','order_items.order_id','orders.id')
            ->select('sub_stores.current_qty as currentqty','orders.warehouse_id','orders.customer_id',
            'order_items.qty','order_items.item_id')
            ->where('order_items.order_id',$ordered->id)
            ->where('sub_stores.warehouse',$ordered->warehouse_id)
            ->get();


           foreach($the_stocked as $order){
              $store_sub = subStore::
             where('item_id',$order->item_id)
             ->where('warehouse',$order->warehouse_id)
             ->first();

            $store_sub_total=$store_sub->current_qty;
            $qty = -$order->qty;
             $store_sub->current_qty.' - '.$order->qty;
            if($store_sub->current_qty >= $order->qty){
                 $stocking = stocking::create([
                'item_id'=>$order->item_id,
                'qty'=>$order->qty,
                'current_qty'=>$store_sub_total + $qty,
                'from'=>$order->warehouse_id,
                'to'=>$order->customer_id,
                'status'=>'Sold',
                'user_id'=>auth()->id()
               ]);
               // Add stock to  sub store
                $store = subStore::where('item_id',$order->item_id)->where('warehouse',$order->warehouse_id)->update([
                    'current_qty'=>$store_sub_total + $qty
                ]);
            }
            else{
                return redirect()->back()->with('error','No enough stock for stock_id '.$store_sub->item_id.' to sale, review your order and try again');
            }
           }
            // Add record to payment table
            $payment = payment::create(
                [
                    'sale_id'=>$sell->id,
                    'account_id'=> $acc_id->id,
                    'amount'=>request('amount'),
                    'paid'=>$paid,
                    'wallet'=>$wallet,
                    'balance'=>$balance,
                    'receipt'=>'Sale',
                    'status'=>'Sale',
                    'user_id'=>auth()->id()
                ]);
                // Check if payment is from wallet, if is true skip adding more money to main account as amount already added
                if(request('status')!="Pay via E-wallet"){
                    //Create Cashin record,
                $cashin = cashIn::create(
                    [
                        'account_id'=>$acc_id->id,
                        'amount_received'=>$paid,
                        'amount_to'=> $acc_id->total + $paid - $wallet,
                        'cash_category'=>'Sale',
                        'cash_descriptions'=>request('status'),
                        'user_id'=>auth()->id(),
                    ]
                    );
            // Deduct amount from e-wallet
            $e_wallet  = customerWallet::where('customer_id',$ordered->customer_id)->first();
            $customer_wallet = customerWallet::where('customer_id',$ordered->customer_id)->update([
                'amount'=>- $wallet,
                'balance'=>$e_wallet->balance - $wallet,
                ]);
               // Create records for e-wallet transactions
               $wallet_report = customerWalletSummury::create([
                'customer_id'=>$ordered->customer_id,
                'wallet_id'=> $e_wallet->id,
                'order_id'=> $ordered->id,
                'wallet_amount'=>- $wallet,
                'wallet_balance'=>$e_wallet->balance - $wallet,
                'status'=>'Pay via E-Wallet',
                'user_id'=>auth()->id()
            ]);
                    // Add payment to main account
            $account = account::wheremain_account(1)->first();
            $accounts = $account->update([
                'total'=>$account->total + $paid - $wallet
            ]);
        // Add amount to customer account
        if(request('status')!="Cash" || request('status')!="Pay via E-wallet"){
        $customer_account = customer::where('id',$ordered->customer_id)->first();
        $current_balance = $customer_account->to;
        if($customer_account){
        $updatenow = customer::where('id',$ordered->customer_id)->update([
            'from'=> $current_balance,
            'to'=> $current_balance - $balance
        ]);
    }
        // Customer account records
            $customeraccount = customerAccountSummary::create(
                [
                    'customer_id'=>$ordered->customer_id,
                    'sale_id'=>$sell->id,
                    'from'=>$current_balance,
                    'to'=>$current_balance - $balance,
                    'status'=>request('status'),
                    'user_id'=>auth()->id()
                ]);
        }
    }
        if(request('status')=="Pay via E-wallet"){
            // Here we wont add new cash because this amount already collected and added to the main account
            $cashin = cashIn::create(
                [
                    'account_id'=>$acc_id->id,
                    'amount_received'=>$paid - $wallet,
                    'amount_to'=> $acc_id->total,
                    'cash_category'=>'Sale',
                    'cash_descriptions'=>request('status'),
                    'user_id'=>auth()->id(),
                ]);
                // Customer account records
                $customer_account = customer::where('id',$ordered->customer_id)->first();
                $current_balance = $customer_account->to;
                $customeraccount = customerAccountSummary::create(
                    [
                        'customer_id'=>$ordered->customer_id,
                        'from'=>  $current_balance,
                        'sale_id'=>  $sell->id,
                        'to'=>   $current_balance,
                        'status'=>request('status'),
                        'user_id'=>auth()->id()
                    ]);
                    // Deduct amount from e-wallet
                    $e_wallet  = customerWallet::where('customer_id',$ordered->customer_id)->first();
                    $customer_wallet = customerWallet::where('customer_id',$ordered->customer_id)->update([
                        'amount'=>- $paid,
                        'balance'=>$e_wallet->balance - $paid,
                        ]);

                    // Create records for e-wallet transactions
                    $wallet_report = customerWalletSummury::create([
                        'customer_id'=>$ordered->customer_id,
                        'wallet_id'=> $e_wallet->id,
                        'order_id'=> $ordered->id,
                        'wallet_amount'=>- $paid,
                        'wallet_balance'=>$e_wallet->balance - $paid,
                        'status'=>'Pay via E-Wallet',
                        'user_id'=>auth()->id()
                    ]);
            }

            // Update order status
            $update_order_status = order::where('id',request('order_id'))->update([
                'status'=>'Sold'
            ]);


    }
        else{
            return redirect()->back()->with('error','This order not exist');
        }
    }
}
            }
    // end if if($acc_id)
    else{
        return redirect()->back()->with('error','Main account not exist or is off');
    }
        }
        return redirect()->route('pos.index')->with('success','Sale done successfully');
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
        $orders = rentalOrder::where('id',$id)
        ->where('status','Pending')
        ->where('user_id',auth()->id())
        ->first();

        $orderings = rentalOrder::join('customers','rental_orders.customer_id','customers.id')
        ->select('rental_orders.id','customers.customer_name')
        ->where('rental_orders.status','Pending')
        ->where('rental_orders.user_id',auth()->id())
        ->get();

        if(!empty($orders)){
        $customers = customer::join('rental_orders','rental_orders.customer_id','customers.id')
        ->where('rental_orders.status','Pending')
        ->where('customers.id',$orders->customer_id)
        ->first();
        $wallet = customerWallet::where('customer_id', $orders->customer_id)->first();
        if($wallet){
            $ewallete = $wallet->balance;
        }
        else{
            $ewallete = 0;
        }
        $items = rentalItem::get();

        $order_items = rentalOrderItem::join('stocks','rental_order_items.item_id','stocks.id')
        ->select('rental_order_items.*','stocks.item')
        ->where('rental_order_items.order_id',$id)
        // ->where('sub_stores.warehouse',$wharehouse_id)
        ->get();

        $pos = rentalOrderItem::join('rental_orders','rental_order_items.order_id','rental_orders.id')
        // ->select('*',
        // DB::raw("sum(rental_order_items.qty) as order_qty"),
        // DB::raw("SUM(rental_order_items.selling_price ) as subtotal"),
        // DB::raw("SUM(rental_order_items.fee as total_fee")
        // )
        ->where('rental_order_items.order_id',$id)
        ->where('rental_orders.status','Pending')
        ->get();


        return view('admin.rental.show',compact('customers','items','orders','orderings','id','order_items','pos','ewallete'));

}
    else{
        return redirect()->route('pos.index')->with('error','No such order');
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
