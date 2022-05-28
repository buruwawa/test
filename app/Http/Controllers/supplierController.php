<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\cashIn;
use App\Models\customerAccount;
use App\Models\purchaseOrder;
use App\Models\supplier;
use App\Models\supplierAccount;
use App\Models\supplierAccountSummary;
use App\Models\supplierWallet;
use App\Models\supplierWalletSummury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class supplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = supplierWallet::rightjoin('suppliers','suppliers.id','supplier_wallets.supplier_id')->get();
        return view('admin.settings.suppliers.supplier',compact('suppliers'));
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
        if(request('supplier_name')){
        $request->validate([
        'supplier_name'=>'required',
        'contact_person'=>'required',
        'position'=>'required',
        'phone'=>'required',
        'tin'=>'required',
        'vrn'=>'nullable|integer',
        'email'=>'required',
        'address'=>'nullable|string',
        ]);


        $suppliers = supplier::create([
        'supplier_name'=>$request->input('supplier_name'),
        'contact_person'=>$request->input('contact_person'),
        'position'=>$request->input('position'),
        'phone'=>$request->input('phone'),
        'tin'=>$request->input('tin'),
        'vrn'=>empty($request->input('vrn')) ? 'null': $request->input('vrn'),
        'email'=>$request->input('email'),
        'address'=>empty($request->input('address')) ? 'null': $request->input('address'),
        'from'=>0,
        'to'=>0,
        'user_id'=>auth()->id()
            ]);

        //create supplier wallet
        $supplier_wallet = supplierWallet::create([
        'supplier_id'=>$suppliers->id,
        'amount'=>0,
        'balance'=>0,
        'user_id'=>auth()->id()
        ]);
        return redirect()->back()->with('success','supplier created successfuly');
        }
        // Add advanced payment to supplier account
        if(request('pay_amount')){

             $main_account = account::wheremain_account(1)->first();
             $amount = $main_account->total;
             if(request('pay_amount') > $amount){
                return redirect()->back()->with('error','Insurficient balance');
             }
             else{
             // deduct amount from main account
             $accounts = account::wheremain_account(1)->update([
                 'total'=>$amount - request('pay_amount')

             ]);
                  // Deduct amount from cash in account
            $cashin = cashIn::create([
                'account_id'=>$main_account->id,
                'amount_received'=>-request('pay_amount'),
                'amount_to'=> $amount - request('pay_amount'),
                'cash_category'=>'advanced to Supplier',
                'cash_descriptions'=>'Advanced payment for supplier',
                'user_id'=>auth()->id(),
            ]);

        $ewallet = supplierWallet::where('supplier_id',request('supplier_id'))->first();
        if($ewallet){
            $wallet = $ewallet->balance;
            $customer_wallet = supplierWallet::where('supplier_id',request('supplier_id'))->update(
            [
                'supplier_id'=>request('supplier_id'),
                'amount'=>request('pay_amount'),
                'balance'=>$wallet + request('pay_amount'),
                'user_id'=>auth()->id()
            ]);
            $supplierwalletsummury = supplierWalletSummury::create([
                'supplier_id'=>request('supplier_id'),
                'wallet_id'=>$ewallet->id,
                'purchase_id'=>0,
                'wallet_amount'=>request('pay_amount'),
                'wallet_balance'=>$wallet + request('pay_amount'),
                'status'=>'Added amount',
                'user_id'=>auth()->id()
            ]);
        }
        else{
            $wallet= 0;
            $customer_wallet = supplierWallet::create(
                [
                    'supplier_id'=>request('supplier_id'),
                    'amount'=>request('pay_amount'),
                    'balance'=>$wallet + request('pay_amount'),
                    'user_id'=>auth()->id()
                ]);
                $supplierwalletsummury = supplierWalletSummury::create([
                    'supplier_id'=>request('supplier_id'),
                    'wallet_id'=>$customer_wallet->id,
                    'purchase_id'=>0,
                    'wallet_amount'=>$wallet + request('pay_amount'),
                    'wallet_balance'=>$wallet + request('pay_amount'),
                    'status'=>'Added amount',
                    'user_id'=>auth()->id()
                ]);

        }



            }

             return redirect()->back()->with('success','supplier created successfuly');
        }
        // Add more advance payment
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
        $balances = supplierAccountSummary::where('supplier_id',$id)->latest()->get();
        $supplier_name = supplier::where('id',$id)->first();
        $supplier = $supplier_name->supplier_name;
        return view('admin.payments.shows_suppliers_account',compact('balances','supplier'));
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
        $supplier = supplier::where('id',$id)->first();
        if($supplier){
            $supplier->update(
                [
        'supplier_name'=>request('supplier_name'),
        'contact_person'=>request('contact_person'),
        'position'=>request('position'),
        'phone'=>request('phone'),
        'tin'=>request('tin'),
        'vrn'=>request('vrn'),
        'email'=>request('email'),
        'address'=>request('address')
                ]);
                return redirect()->back()->with('success','Supplier updated successfully');
        }
        else{
            return redirect()->back()->with('error','Supplier can not be edited');
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
        $supplier = supplier::where('id',$id)->first();
        if($supplier){
            $supplier->delete();
            return redirect()->back()->with('success','Supplier deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Supplier can not be deleted');
        }
    }
}
