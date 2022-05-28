<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\cashIn;
use App\Models\customer;
use App\Models\customerAccountSummary;
use App\Models\payment;
use App\Models\purchase;
use App\Models\purchaseOrder;
use App\Models\sale;
use App\Models\supplier;
use App\Models\supplierAccountSummary;
use App\Models\supplierWallet;
use App\Models\supplierWalletSummury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class paymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = purchaseOrder::
        join('suppliers','purchase_orders.supplier_id','suppliers.id')
        ->leftjoin('supplier_wallets','supplier_wallets.supplier_id','suppliers.id')
        ->select('purchase_orders.*','suppliers.supplier_name','suppliers.address','suppliers.tin','suppliers.phone','supplier_wallets.balance as wallet_balance','supplier_wallets.id as wallet_id')
        ->where('purchase_orders.balance','>',0)
        ->where('payment','Purchased')
        ->get();

        $totals = purchaseOrder::
        select([DB::raw('SUM(amount) as total_purchase'),
        DB::raw('SUM(paid) as total_paid'),
        DB::raw('SUM(balance) as total_balance')])
        ->where('purchase_orders.balance','>',0)
        ->where('payment','Purchased')
        ->get();


        return view('admin.payments.payment',compact('payments','totals'));
    }

    /**
     * Invoice previews
     */
    public function viewInvoice($id){
        //
        $payments = purchaseOrder::
        join('suppliers','purchase_orders.supplier_id','suppliers.id')
        ->select('purchase_orders.*','suppliers.supplier_name','suppliers.address','suppliers.tin','suppliers.phone')
        ->where('purchase_orders.id',$id)
        ->get();

        $items = purchaseOrder::
       join('purchase_items','purchase_items.order_id','purchase_orders.id')
        ->join('stocks','stocks.id','purchase_items.item_id')
        ->select('purchase_orders.*','purchase_items.qty','stocks.item','stocks.price')
        ->where('purchase_orders.id',$id)
        ->get();

        $totals = purchaseOrder::
        where('purchase_orders.id',$id)
        ->first();


        return view('admin.payments.invoices',compact('payments','totals','items'));
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
        // return request()->all();
        if(request('pay_order')){
        $minimum = account::wheremain_account(1)->first();
        $min = $minimum->total;
        $get_data = purchaseOrder::where('id',request('purchase_order_id'))->first();
        $balance = $get_data->balance - request('pay_amount');
        $wallet_account = supplierWallet::where('id',request('wallet_id'))->first();
        $supplier_balance = supplier::where('id',$get_data->supplier_id)->first();
        // validations
        $request->validate([
            'pay_amount'=>"lte:$min"
        ]);

          //create supplier wallet
          if(supplierWallet::where('id',request('wallet_id'))->exists()){
            //do nothing
        }
        else{
            $wallet_account = supplierWallet::create([
                'supplier_id'=>$get_data->supplier_id,
                'amount'=>0,
                'balance'=>0,
                'user_id'=>auth()->id()
                ]);
        }
    if($wallet_account->balance < 0 ){
            return redirect()->back()->with('error','The supplier wallet account has an error kindly fix first');
        }
        // wallet validation
        if(request('pay_wallet')){
            $wallet = request('pay_amount');
            $paid = request('pay_amount');
        }
        else{
            $wallet = request('wallet');
            $paid =  $wallet + request('pay_amount');
        }
        // status variables
        if($balance == 0){
            $status = "Final Payment";
        }
        else{
            $status = "Installment";
        }

        if($get_data){
        // if paid fully via wallet
        if(request('pay_wallet')){
        // Update order status
            $purchaseOrder = purchaseOrder::where('id',request('purchase_order_id'))->update([
                'paid'=>$get_data->paid + $paid,
                'balance'=>$get_data->balance - request('pay_amount'),
                'status'=>$status
            ]);
        // update balance on supplier account
        $supplier = supplier::where('id',$get_data->supplier_id)->update([
            'from'=>$supplier_balance->to,
            'to'=>$supplier_balance->to + $paid
        ]);

        // create supplierAccountSummary record
        $supplier_account_summary = supplierAccountSummary::create([
            'supplier_id'=>$get_data->supplier_id,
            'from'=>$supplier_balance->to,
            'to'=>$supplier_balance->to + $paid,
            'status'=>$status,
            'user_id'=>auth()->id()
        ]);

        // Create wallet record
        $supplierwallet = supplierWallet::where('supplier_id',request('supplier_id'))->update([
            'amount'=>$wallet_account->balance,
            'balance'=>$wallet_account->balance - request('pay_amount'),
        ]);
        $wallet_summury = supplierWalletSummury::create([
            'supplier_id'=>request('supplier_id'),
            'wallet_id'=>request('wallet_id'),
            'purchase_id'=>$get_data->id,
            'wallet_amount'=>$wallet,
            'wallet_balance'=>$wallet_account->balance - request('pay_amount'),
            'status'=>'Paid fully via wallet',
            'user_id'=>auth()->id()
        ]);

        // Create purchase records
        $purchase_record = purchase::create([
            'purchase_id'=>request('purchase_order_id'),
            'amount'=>$get_data->amount,
            'paid'=>request('pay_amount'),
            'balance'=> $get_data->balance - request('pay_amount'),
            'status'=>$status,
            'user_id'=>auth()->id(),
        ]);

        return redirect()->back()->with('success','Payment paid via wallet successfuly');
      }


      /**
         * if paid partially via wallet
         */

      elseif(request('wallet_patially')){
            // Update order status

          //  return 'balance = '.$get_data->balance.' wallets = '. request('wallet') .' Amount payee = '. request('pay_amount');

            purchaseOrder::where('id',request('purchase_order_id'))->update([
                'paid'=>$get_data->paid + $paid,
                'balance'=>$get_data->balance - request('wallet') - request('pay_amount'),
                'status'=>$status
            ]);
            // Create purchase records
            $purchase_record = purchase::create([
                'purchase_id'=>request('purchase_order_id'),
                'amount'=>$get_data->amount,
                'paid'=>request('pay_amount'),
                'balance'=> $get_data->balance - request('pay_amount'),
                'status'=>$status,
                'user_id'=>auth()->id(),
            ]);


        // update balance on supplier account
        $supplier = supplier::where('id',$get_data->supplier_id)->update([
            'from'=>$supplier_balance->to,
            'to'=>$supplier_balance->to + $paid
        ]);

        // create supplierAccountSummary record
        $supplier_account_summary = supplierAccountSummary::create([
        'supplier_id'=>$get_data->supplier_id,
        'from'=>$supplier_balance->to,
        'to'=>$supplier_balance->to + $wallet + request('pay_amount'),
        'status'=>'Paid via wallet',
        'user_id'=>auth()->id()
        ]);

        // Create wallet record
         $supplierwallet = supplierWallet::where('supplier_id',request('supplier_id'))->update([
            'amount'=>$wallet_account->balance,
            'balance'=>$wallet_account->balance - $wallet,
        ]);
        $wallet_summury = supplierWalletSummury::create([
            'supplier_id'=>request('supplier_id'),
            'wallet_id'=>request('wallet_id'),
            'purchase_id'=>$get_data->id,
            'wallet_amount'=>$wallet,
            'wallet_balance'=>$wallet_account->balance - $wallet,
            'status'=>'Order payment',
            'user_id'=>auth()->id()
        ]);

         // deduct cash paid amount only from the main account
         $deduction = account::where('main_account',1)->update([
            'total'=> $min - request('pay_amount')
        ]);
        // create main account transaction records
        $main_account_summury = cashIn::create([
            'account_id'=>$minimum->id,
            'amount_received'=>-request('pay_amount'),
            'amount_to'=>$min-request('pay_amount'),
            'cash_category'=> 'Purchase',
            'cash_descriptions'=>'Purchase payment',
            'user_id'=>auth()->id()
        ]);
        return redirect()->back()->with('success','Paid partially with wallet and other cash successfuly');
      }

        //if not paid via wallet
      else{
        purchaseOrder::where('id',request('purchase_order_id'))->update([
            'paid'=>$get_data->paid + $paid,
            'balance'=>$get_data->balance - request('pay_amount'),
            'status'=>$status
        ]);
        // Create purchase records
        $purchase_record = purchase::create([
            'purchase_id'=>request('purchase_order_id'),
            'amount'=>$get_data->amount,
            'paid'=>request('pay_amount'),
            'balance'=> $get_data->balance - request('pay_amount'),
            'status'=>$status,
            'user_id'=>auth()->id(),
        ]);

        // update balance on supplier account
        $supplier = supplier::where('id',$get_data->supplier_id)->update([
            'from'=>$supplier_balance->to,
            'to'=>$supplier_balance->to + $paid
        ]);

        // create supplierAccountSummary record
        $supplier_account_summary = supplierAccountSummary::create([
        'supplier_id'=>$get_data->supplier_id,
        'from'=>$supplier_balance->to,
        'to'=>$supplier_balance->to + request('pay_amount'),
        'status'=>$status,
        'user_id'=>auth()->id()
        ]);

     // deduct cash paid amount only from the main account
     $deduction = account::where('main_account',1)->update([
        'total'=> $min - request('pay_amount')
    ]);
    // create main account transaction records
    $main_account_summury = cashIn::create([
        'account_id'=>$minimum->id,
        'amount_received'=>-request('pay_amount'),
        'amount_to'=>$min-request('pay_amount'),
        'cash_category'=> 'Purchase',
        'cash_descriptions'=>'Purchase payment',
        'user_id'=>auth()->id()
    ]);
    return redirect()->back()->with('success','Payment done successfuly');
      }
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
        // delete payment
        $delete = payment::where('id',$id)->first();
        $account = account::where('main_account',1)->first();
        $sales = sale::where('id',$delete->sale_id)->first();
        $customer_account = customer::where('id', $sales->customer_id)->first();

        if(payment::where('id',$id)->exists()){
        if($account->total < $delete->paid){
            return redirect()->back()->with('error','You do not have enough balance to refund this payment');
        }
        else{

            $cash_in = cashIn::create([
                'account_id'=>$account->id,
                'amount_received'=>-$delete->paid,
                'amount_to'=>$account->id-$delete->paid,
                'cash_category'=>'Deleted',
                'cash_descriptions'=>'Deleted paymment',
                'user_id'=>auth()->id()
            ]);
           $deduct_amount = account::where('main_account',1)->update([
            'total'=>$account->total-$delete->paid
           ]);

           $payment=  payment::where('id',$id)->update([
                'status'=>'Deleted'
            ]);

           $update = sale::where('id',$delete->sale_id)->update([
                'amount'=>$sales->amount,
                'paid'=>$sales->paid - $delete->paid,
                'balance'=>$sales->balance + $delete->paid,
                'status'=>'Credit'
           ]);

           $customer_update = customer::where('id', $sales->customer_id)->update([
            'from'=>$customer_account->to,
            'to'=>$customer_account->to-$delete->paid,
           ]);

           $customer_account_summary = customerAccountSummary::create([
            'customer_id'=>$sales->customer_id,
            'sale_id'=>$sales->id,
            'from'=>$customer_account->to,
            'to'=>$customer_account->to-$delete->paid,
            'status'=>'Deleted',
            'user_id'=>auth()->id()
           ]);

            return redirect()->back()->with('success','Payment deleted successfuly');
        }
    }
    else{
        return redirect()->back()->with('error','No such payment');
    }


        // return sale value

    }
}
