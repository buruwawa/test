<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\cashIn;
use App\Models\direct_expenses;
use App\Models\expenseCategory;
use App\Models\purchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class expensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // //
        $expenses = direct_expenses::where('status','Pending')->get();
        $categories = expenseCategory::get();

        $totals = direct_expenses::
        select([DB::raw('SUM(amount) as total_request')])->where('status','Pending')
        ->first();
        return view('admin.payments.expenses',compact('expenses','totals','categories'));
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
        if(request('category')){
            if(expenseCategory::where('expenses_category',request('expenses_category'))->exists()){
                return redirect()->back()->with('error','Category alredy exist');
            }
            else{
        $set_category = expenseCategory::create([
            'expenses_category'=>request('expenses_category')
        ]);
        return redirect()->back()->with('success','Category created successfully');
         }
        }

        if(request('expenses')){
            $expenses = direct_expenses::create([
                'expenses_name'=>request('expenses_name'),
                'amount'=>request('expense_amount'),
                'category'=>request('expenses_category'),
                'descriptions'=>request('descriptions'),
                'status'=>'Pending',
                'user_id'=>auth()->id()
            ]);

            return redirect()->back()->with('success','Expense created successfully');
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
        if(request('pay')){

            $account = account::wheremain_account(1)->first();
            $pay = direct_expenses::where('id',$id)->first();
            $request->validate([
                'pay_this_amount'=>"lte:$account->total"
            ]);

            $pay_amount =  $account->total - request('pay_this_amount');
            if($pay_amount >= 0){
               $direct_expense = direct_expenses::where('id',$id)->update([
                    'status'=>'Paid'
                ]);
                $cashin = cashIn::create([
                    'account_id'=>$account->id,
                    'amount_received'=>request('pay_this_amount'),
                    'amount_to'=>$pay_amount,
                    'cash_category'=>'Expenses',
                    'cash_descriptions'=>$pay->category,
                    'user_id'=>auth()->id(),
                 ]);

                $update_main_account = account::wheremain_account(1)->update([
                    'total'=> $pay_amount
                ]);
                return redirect()->back()->with('success','Expense paid successfully');
            }
            else{
                return redirect()->back()->with('error','Insurficient amount to service this expense');
            }

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
          $delete = direct_expenses::where('id',$id)->delete();
          return redirect()->back()->with('success','Expense deleted successfully');
    }
}
