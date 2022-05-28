<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\cashIn;
use App\Models\paymentCategory;
use App\Models\purchase;
use App\Models\purchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class accountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $accounts = account::get();
        $categories = paymentCategory::get();

        return view('admin.payments.account',compact('accounts','categories'));
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
        if(request('account_name')){
        $account  = account::create([
            'account_name'=>request('account_name'),
            'descriptions'=>request('descriptions'),
            'main_account'=>0,
            'user_id'=>auth()->id()
        ]);
        return redirect()->back()->with('success','Account created successfuly');
    }
    if(request('payment_category')){
        $payment_category = paymentCategory::create([
            'payment_category'=>request('payment_category'),
            'user_id'=>auth()->id()
        ]);
        return redirect()->back()->with('success','Category created successfuly');
    }
    if(request('account_id')){
        $current_cash = account::where('id',request('accountid'))->first();
        $cash_total = $current_cash->total;

        $cashin = cashIn::create([
            'account_id'=>request('accountid'),
            'amount_received'=>request('amount_received'),
            'amount_to'=> $cash_total + request('amount_received'),
            'cash_category'=>request('cash_category'),
            'cash_descriptions'=>request('cash_descriptions'),
            'user_id'=>auth()->id()
        ]);
        // update current account
        $account = account::where('id',request('accountid'))->update([
                'total'=> $cash_total + request('amount_received')
            ]);
     return redirect()->back()->with('success','Cash added successfuly');
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
        $acc =  cashIn::join('users','cash_ins.user_id','users.id')
        ->select('cash_ins.*','users.name')
        ->get();
        if($acc){
        // $purchase =  purchaseOrder::where('purchase_orders.paid','!=',0)
        // ->select('purchase_orders.id','purchase_orders.supplier_id','purchase_orders.warehouse_id','purchase_orders.discount',
        // 'purchase_orders.amount','purchase_orders.paid','purchase_orders.balance','purchase_orders.status','purchase_orders.payment',
        // 'purchase_orders.user_id')->get();
        //     return $purchase;
        $accounts =  cashIn::join('users','cash_ins.user_id','users.id')
        // ->union($purchase)
        ->select('cash_ins.*','users.name')
        ->get();

        return view('admin.payments.show_account',compact('accounts'));
        }
        else{
            return redirect()->back()->with('error','There is no any transactions');
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
        if(request('asign_account')){
            $accounts = account::where('id',request('account_id'))->update([
                'main_account'=>1
            ]);
            return redirect()->back()->with('success','Assigned successfully');
        }
        if(request('remove_id')){
            $accounts = account::where('id',request('remove_id'))->update([
                'main_account'=>0
            ]);
            return redirect()->back()->with('success','Unsigned  successfully');
        }
        if(request('account')){
            $update = account::where('id',$id)->update([
                'location'=>request('location'),
                'descriptions'=>request('descriptions'),
                'main_account'=>request('main_account')
            ]);
            return redirect()->back()->with('success','account edited successfully');
        }
        return redirect()->back()->with('error','Can not Assign ');
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
