<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\cashIn;
use App\Models\customer;
use App\Models\customerAccount;
use App\Models\customerAccountSummary;
use App\Models\customerWallet;
use App\Models\customerWalletSummury;
use App\Models\orderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class customerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /*
     * customers list
     */
    public function customer_list(){
        $customers = customerWallet::rightjoin('customers','customer_wallets.customer_id','customers.id')->get();
        $customer_total = customerWallet::rightjoin('customers','customer_wallets.customer_id','customers.id')
        ->select(DB::raw('SUM(customers.to) as total_debts'))
        ->first();
        $customer_wallet = customerWallet::rightjoin('customers','customer_wallets.customer_id','customers.id')
        ->select(DB::raw('SUM(customer_wallets.balance) as total_balance'))
        ->first();
        return view('admin.customers.customers',compact('customers','customer_total','customer_wallet'));
    }
    /**
     * Customer item show
     */
    public function customershow($id){
        $sales = orderItem::join('orders','order_items.order_id','orders.id')
        ->join('stocks','order_items.item_id','stocks.id')
        ->select('order_items.*','stocks.item')
        ->where('orders.status','Sold')
        ->where('orders.customer_id',$id)->get();

        return view('admin.customers.show_sales', compact('sales'));
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
        if(request('customer_name')){
        $request->validate([
        'customer_name'=>'required',
        'company_name'=>'nullable|string',
        'tin'=>'required',
        'vrn'=>'nullable|string',
        'email'=>'nullable|string',
        'phone'=>'required',
        'location'=>'required'
        ]);

if(customer::where('customer_name',request('customer_name'))->where('company_name',request('company_name'))->where('location',request('location'))->exists()){
    return redirect()->back()->with('success','This customer already exist');
}
else{
        $customer = customer::create([
        'customer_name'=>$request->input('customer_name'),
        'company_name'=>empty($request->input('company_name')) ? 'null': $request->input('company_name'),
        'tin'=>$request->input('tin'),
        'vrn'=>empty($request->input('vrn')) ? 'null': $request->input('vrn'),
        'email'=>empty($request->input('email')) ? 'null': $request->input('email'),
        'phone'=>$request->input('phone'),
        'location'=>$request->input('location'),
        'from'=>0,
        'to'=>0,
        'user_id'=>auth()->id()
            ]);
        $customer_wallet = customerWallet::create([
        'customer_id'=>$customer->id,
        'amount'=>0,
        'balance'=>0,
        'user_id'=>auth()->id()
        ]);

            return redirect()->back()->with('success','Customer created successfuly');
    }
}
if(request('customer_account')){
    $acc_id = account::where('main_account',1)->first();
    $customer_account = customer::where('id', request('customer_account'))->first();
    $from = $customer_account->to;
    // $customer_account = customer::where('id', request('customer_account'))->update([
    //     'from'=>$from,
    //     'to'=>$from + request('pay_amount')
    // ]);

    // $payment = customerAccountSummary::create(
    //     [
    //         'customer_id'=>request('customer_account'),
    //         'from'=>$from,
    //         'to'=>$from + request('pay_amount'),
    //         'status'=>'Advanced',
    //         'user_id'=>auth()->id()
    //     ]);
        $ewallet = customerWallet::where('customer_id',request('customer_account'))->first();
        if($ewallet){
            $wallet = $ewallet->balance;
            $customer_wallet = customerWallet::where('customer_id',request('customer_account'))->update(
            [
                'customer_id'=>request('customer_account'),
                'amount'=>request('pay_amount'),
                'balance'=>$wallet + request('pay_amount'),
                'user_id'=>auth()->id()
            ]);

                                // Create records for e-wallet transactions
                                $wallet_report = customerWalletSummury::create([
                                    'customer_id'=>request('customer_account'),
                                    'wallet_id'=> $ewallet->id,
                                    'wallet_amount'=>request('pay_amount'),
                                    'wallet_balance'=>$wallet + request('pay_amount'),
                                    'status'=>'Pay via E-Wallet',
                                    'user_id'=>auth()->id()
                                ]);
        }
        else{
            $wallet= 0;
            $customer_wallet = customerWallet::create(
                [
                    'customer_id'=>request('customer_account'),
                    'amount'=>request('pay_amount'),
                    'balance'=>$wallet + request('pay_amount'),
                    'user_id'=>auth()->id()
                ]);

                // Create records for e-wallet transactions
                $wallet_report = customerWalletSummury::create([
                    'customer_id'=>request('customer_account'),
                    'wallet_id'=> $customer_wallet->id,
                    'wallet_amount'=>request('pay_amount'),
                    'wallet_balance'=>$wallet + request('pay_amount'),
                    'status'=>'Pay via E-Wallet',
                    'user_id'=>auth()->id()
                ]);

        }

            // Add amount to cash in account
            $cashin = cashIn::create(
                [
                    'account_id'=>$acc_id->id,
                    'amount_received'=>request('pay_amount'),
                    'amount_to'=> $acc_id->total + request('pay_amount'),
                    'cash_category'=>'Customer advanced',
                    'cash_descriptions'=>'Customer advanced payment',
                    'user_id'=>auth()->id(),
                ]);
                // Add payment to main account
        $account = account::wheremain_account(1)->first();
        $accounts = account::wheremain_account(1)->update([
            'total'=>$account->total + request('pay_amount')
        ]);
    return redirect()->back()->with('success','Amount added successfuly');
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
        $balances = customerAccountSummary::
        join('users','users.id','customer_account_summaries.user_id')
        ->select('customer_account_summaries.*','users.name')
        ->where('customer_account_summaries.customer_id',$id)->latest()->get();
        $customer_name = customer::where('id',$id)->first('customer_name');
        $customer = $customer_name->customer_name;
        return view('admin.payments.shows_customers_account',compact('balances','customer'));
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
        $customer = customer::where('id',$id)->first();
        if($customer){
        $update = customer::where('id',$id)->update([
        'customer_name'=>request('customer_name'),
        'company_name'=>request('company_name'),
        'tin'=>request('tin'),
        'vrn'=>request('vrn'),
        'email'=>request('email'),
        'phone'=>request('phone'),
        'location'=>request('location'),
        'from'=> $customer->from,
        'to'=> $customer->to,
        'user_id'=>auth()->id()
        ]);

        return redirect()->back()->with('success','Customer updated successfuly');
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
        //
       $check_customer_balance = customer::where('id',$id)->first();
       $check_customer_wallet = customerWallet::where('customer_id',$id)->first();
        if($check_customer_balance->to == 0 && $check_customer_wallet->balance == 0){
            $delete = customer::where('id',$id)->delete();
            return redirect()->back()->with('success','Customer deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Can not delete this customer until you reconcile account balances');
        }

    }
}
