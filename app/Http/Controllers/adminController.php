<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\cashIn;
use App\Models\customer;
use App\Models\customerAccountSummary;
use App\Models\customerWallet;
use App\Models\customerWalletSummury;
use App\Models\myCompany;
use App\Models\myPayment;
use App\Models\order;
use App\Models\package;
use App\Models\payment;
use App\Models\sale;
use App\Models\tenant;
use App\Models\User;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;


class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = request()->getHost();
        $common_domain = substr($url, 0, 3);

        if($common_domain == "www"){
          $domain = substr($url,4);
      }
      else{
           $domain = $url;
      }

        $tenant= tenant::where('tenant_status','Active')->where('domain',$domain)
        ->first();
        
       $package= package::where('tenant_id',$tenant->id)->latest()->first();
        if($tenant){
            $mycompany = myCompany::first();
            $mypayment = myPayment::latest()->first();

 
            if($mycompany){
                // do nothing

            }
            else{
                $create_company = myCompany::create([
                'company_name'=>$tenant->name,
                'logo'=>'',
                'address'=>$tenant->address,
                'phone_number'=>$tenant->phone_number,
                'package'=>$tenant->package,
                'status'=>$tenant->tenant_status,
                'renew_at'=>$tenant->next_renewal
            ]);
            }
            if($mypayment){
                if($package->id != $mypayment->invoice_number){
                    $create_payement = myPayment::create([
                        'invoice_number'=>$package->id,
                        'my_id'=>$package->tenant_id,
                        'package_name'=>$package->package_name,
                        'amount_paid'=>$package->amount_paid,
                        'transaction_id'=>$package->transaction_id,
                        'paid_via'=>$package->paid_via_phone,
                        'start_from'=>$package->start_from,
                        'end_at'=>$package->end_at,
                        'limit_shop'=>$package->end_at,
                        'limit_user'=>$package->end_at,
                        'status'=>$package->status,
                ]);
                }
            }
            else{
                $create_payement = myPayment::create([
                    'invoice_number'=>$package->id,
                    'my_id'=>$package->tenant_id,
                    'package_name'=>$package->package_name,
                    'amount_paid'=>$package->amount_paid,
                    'transaction_id'=>$package->transaction_id,
                    'paid_via'=>$package->paid_via_phone,
                    'start_from'=>$package->start_from,
                    'end_at'=>$package->end_at,
                    'status'=>$package->status,
                ]);
            }

 
        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
        $user = User::where('id',auth()->id())->first();

        $users= User::get();
        $user->hasRole('Admin');

//dd($user);

        if($users->count()<=1 && $user->hasRole('Admin') == 0){
            // Create and assign user to be admin
            //dd('ddd');
                if(Role::where('name',request('name'))->exists()){
                    return redirect()->back()->with('error','This role already created');
                }
                else{
            $role = Role::create(['name' => 'Admin']);
            $role = Role::create(['name' => 'Sales']);
            $role = Role::create(['name' => 'Store']);
            $role = Role::create(['name' => 'Account']);
            //assign admin role
            $user->assignRole('Admin');
                }
            // Create main account
            $account  = account::create([
                'account_name'=>'Main Account',
                'descriptions'=>'Main cash account',
                'main_account'=>1,
                'user_id'=>auth()->id()
            ]);
            // Create main warehouse
            $store = warehouse::create(
                [
            'warehouse'=>'Main warehouse',
            'location'=>'HQ',
            'main_warehouse'=>1,
            'descriptions'=>'All items from supplier is stored here before issuing to the shop',
            'user_id'=>auth()->id() ]);
        };


        if($user->hasRole('Admin|Account')){
//dd('ddx');
        $themonthly = sale::select([
            DB::raw('SUM(amount) as monthly_sales'),
            DB::raw('SUM(paid) as monthly_cash'),
            DB::raw('SUM(balance) as monthly_balance'),
            ])
        ->where('status','!=','Deleted')
        ->whereBetween('created_at',
        [Carbon::now()->startOfMonth(),
        Carbon::now()->endOfMonth()])
        ->first();

        $themonthlypaid = payment::select([
            DB::raw('SUM(paid) as paid_cash')
            ])
            ->where('status','!=','Deleted')
            ->whereBetween('created_at',
            [Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()])
            ->first();

            $monthly_profits = sale::join('order_items','order_items.order_id','sales.order_id')
            ->join('stocks','stocks.id','order_items.item_id')
            ->select([
                DB::raw('SUM(order_items.qty*stocks.price)total_buying'),
                DB::raw('SUM(order_items.qty*stocks.selling_price)total_selling')
                 ])
                 ->where('sales.status','!=','Deleted')
                 ->whereBetween('sales.created_at',
                 [Carbon::now()->startOfMonth(),
                 Carbon::now()->endOfMonth()])
                 ->first();

        $theweekly = sale::select([
            DB::raw('SUM(amount) as weekly_sales'),
            DB::raw('SUM(paid) as weekly_cash'),
            DB::raw('SUM(balance) as weekly_balance'),
            ])
            ->where('status','!=','Deleted')
        ->whereBetween('created_at',
        [$weekStartDate,
        $weekEndDate])
        ->first();

      $theweeklypaid = payment::select([
            DB::raw('SUM(paid) as paid_cash')
            ])
            ->where('status','!=','Deleted')
            ->whereBetween('created_at',
            [$weekStartDate,
            $weekEndDate])
            ->first();


            $weekly_profits = sale::join('order_items','order_items.order_id','sales.order_id')
            ->join('stocks','stocks.id','order_items.item_id')
            ->select([
                DB::raw('SUM(order_items.qty*stocks.price)total_buying'),
                DB::raw('SUM(order_items.qty*stocks.selling_price)total_selling')
                 ])
                 ->where('sales.status','!=','Deleted')
                 ->whereBetween('sales.created_at',
            [$weekStartDate,
            $weekEndDate])
                 ->first();

        $thedaily = sale::select([
        DB::raw('SUM(amount) as daily_sales'),
        DB::raw('SUM(paid) as daily_cash'),
        DB::raw('SUM(balance) as daily_balance'),
        ])
        ->where('status','!=','Deleted')
        ->whereDate('created_at',Carbon::today())
        ->first();

      $daily_profits = sale::join('order_items','order_items.order_id','sales.order_id')
       ->join('stocks','stocks.id','order_items.item_id')
       ->select([
             DB::raw('SUM(order_items.qty*stocks.price)total_buying'),
            DB::raw('SUM(order_items.qty*stocks.selling_price)total_selling')
            ])
            ->where('sales.status','!=','Deleted')
            ->whereDate('sales.created_at',Carbon::today())
            ->first();



          $thedailypaid = payment::select([
            DB::raw('SUM(paid) as paid_cash')
            ])
            ->where('status','!=','Deleted')
            ->whereDate('created_at',Carbon::today())
            ->first();


        $collection_daily = $thedailypaid->paid_cash - $thedaily->daily_cash;
        $collection_weekly = $theweeklypaid->paid_cash - $theweekly->weekly_cash;
        $collection_monthly =  $themonthlypaid->paid_cash - $themonthly->monthly_cash ;
        $pending_orders = order::where('status','Pending')->count();

        return view('admin.index',compact(
        'pending_orders','thedaily',
        'thedailypaid',
        'collection_daily',
        'collection_weekly',
        'collection_monthly',
        'theweekly','themonthly',
        'daily_profits',
        'monthly_profits',
        'weekly_profits'
    ));

            }


            // sales users
        if($user->hasRole('Sales')){

        $themonthly = sale::select([
            DB::raw('SUM(amount) as monthly_sales'),
            DB::raw('SUM(paid) as monthly_cash'),
            DB::raw('SUM(balance) as monthly_balance'),
            ])
            ->where('status','!=','Deleted')
        ->where('user_id',auth()->id())
        ->whereBetween('created_at',
        [Carbon::now()->startOfMonth(),
        Carbon::now()->endOfMonth()])
        ->first();

        $monthly_profits = sale::join('order_items','order_items.order_id','sales.order_id')
        ->join('stocks','stocks.id','order_items.item_id')
        ->select([
            DB::raw('SUM(order_items.qty*stocks.price)total_buying'),
            DB::raw('SUM(order_items.qty*stocks.selling_price)total_selling')
             ])
             ->where('sales.status','!=','Deleted')
             ->where('sales.user_id',auth()->id())
             ->whereBetween('sales.created_at',

             [Carbon::now()->startOfMonth(),
             Carbon::now()->endOfMonth()])
             ->first();

        $themonthlypaid = payment::select([
            DB::raw('SUM(paid) as paid_cash')
            ])
            ->where('status','!=','Deleted')
            ->where('user_id',auth()->id())
            ->whereBetween('created_at',
            [Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()])
            ->first();

        $theweekly = sale::select([
            DB::raw('SUM(amount) as weekly_sales'),
            DB::raw('SUM(paid) as weekly_cash'),
            DB::raw('SUM(balance) as weekly_balance'),
            ])
            ->where('status','!=','Deleted')
            ->where('status','!=','Deleted')
        ->where('user_id',auth()->id())
        ->whereBetween('created_at',
        [$weekStartDate,
        $weekEndDate])
        ->first();

        $theweeklypaid = payment::select([
            DB::raw('SUM(paid) as paid_cash')
            ])
            ->where('status','!=','Deleted')
            ->where('user_id',auth()->id())
            ->whereBetween('created_at',
            [$weekStartDate,
            $weekEndDate])
            ->first();

            $weekly_profits = sale::join('order_items','order_items.order_id','sales.order_id')
            ->join('stocks','stocks.id','order_items.item_id')
            ->select([
                  DB::raw('SUM(order_items.qty*stocks.price)total_buying'),
                 DB::raw('SUM(order_items.qty*stocks.selling_price)total_selling')
                 ])
                 ->where('sales.status','!=','Deleted')
                 ->where('sales.user_id',auth()->id())
                 ->whereBetween('sales.created_at',
            [$weekStartDate,
            $weekEndDate])
                 ->first();

        $thedaily = sale::select([
        DB::raw('SUM(amount) as daily_sales'),
        DB::raw('SUM(paid) as daily_cash'),
        DB::raw('SUM(balance) as daily_balance'),
        ])
        ->where('status','!=','Deleted')
        ->where('user_id',auth()->id())
        ->whereDate('created_at',Carbon::today())
        ->first();

        $daily_profits = sale::join('order_items','order_items.order_id','sales.order_id')
        ->join('stocks','stocks.id','order_items.item_id')
        ->select([
              DB::raw('SUM(order_items.qty*stocks.price)total_buying'),
             DB::raw('SUM(order_items.qty*stocks.selling_price)total_selling')
             ])
             ->where('sales.user_id',auth()->id())
             ->whereDate('sales.created_at',Carbon::today())
             ->first();

        $thedailypaid = payment::select([
            DB::raw('SUM(paid) as paid_cash')
            ])
            ->where('status','!=','Deleted')
            ->where('user_id',auth()->id())
            ->whereDate('created_at',Carbon::today())
            ->first();
        $collection_daily = $thedailypaid->paid_cash - $thedaily->daily_cash;
        $collection_weekly = $theweeklypaid->paid_cash - $theweekly->weekly_cash;
        $collection_monthly = $themonthlypaid->paid_cash - $themonthly->monthly_cash;
        $pending_orders = order::where('status','Pending')->count();

        return view('admin.index',compact(
        'pending_orders','thedaily',
        'thedailypaid',
        'collection_daily',
        'collection_weekly',
        'collection_monthly',
        'theweekly','themonthly',
        'daily_profits',
        'monthly_profits',
        'weekly_profits'
    ));
}
if($user->hasRole('Store')){
    return redirect()->route('stocking.index');
}
elseif($user->hasRole('')){
    return "Sorry you are not permitted to access this system";
}

    }
    else{
    Auth::logout();
    return redirect('/license');
    }
    }

    //license
    public function license(){
        return view('admin.license');
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
        $sale = sale::where('id',request('sale_id'))->first();
        $payment = payment::where('sale_id',$sale->order_id)->get();

        if($sale->order_id){
        if(request('pay_wallet')){
            $wallet = request('amount');
            $paid = request('amount');
        }
        else{
            $wallet = request('wallet');
            $paid =  $wallet + request('amount');
        }

        // Installment payment
        $sales = sale::where('id',request('sale_id'))->first();
        if($sales->balance > 0){

            // Deduct from customer account
            $customer_account = customer::where('id', request('customer_id'))->first();
            $from = $customer_account->to;
            $new_balance = $from + $paid;
            if($new_balance > 0){
                return redirect()->back()->with('error','The amount paid is greater than actual credit');
            }
                else{
            $update = customer::where('id', request('customer_id'))->update([
                'from'=>$from,
                'to'=>$from + $paid
            ]);
            $payment = customerAccountSummary::create(
                [
                    'customer_id'=>request('customer_id'),
                    'from'=>$from,
                    'sale_id'=>request('sale_id'),
                    'to'=>$from + $paid,
                    'status'=>'Installment',
                    'user_id'=>auth()->id()
                ]);
            }
            // Add payment records
            $acc_id = account::where('main_account',1)->first();
            $payment = payment::create(
                [   'sale_id'=>$sales->id,
                    'account_id'=> $acc_id->id,
                    'amount'=>$sales->balance,
                    'paid'=> $paid,
                    'wallet'=>$wallet,
                    'balance'=>$sales->balance - $paid,
                    'receipt'=>'Direct',
                    'status'=>'Installment',
                    'user_id'=>auth()->id()
                ]);
                if(request('pay_wallet')){
                // Deduct amount from e-wallet
            $e_wallet  = customerWallet::where('customer_id',$sales->customer_id)->first();
            $customer_wallet = customerWallet::where('customer_id',$sales->customer_id)->update([
                'amount'=>- $wallet,
                'balance'=>$e_wallet->balance - $wallet,
                ]);
               // Create records for e-wallet transactions
               $wallet_report = customerWalletSummury::create([
                'customer_id'=>$sales->customer_id,
                'wallet_id'=> $e_wallet->id,
                'order_id'=> $sales->order_id,
                'wallet_amount'=>- $wallet,
                'wallet_balance'=>$e_wallet->balance - $wallet,
                'status'=>'Pay via E-Wallet',
                'user_id'=>auth()->id()
            ]);
        }
                // Add amount to cash in account
                $cashin = cashIn::create(
                    [
                        'account_id'=>$acc_id->id,
                        'amount_received'=>$paid,
                        'amount_to'=> $acc_id->total + $paid - $wallet,
                        'cash_category'=>'Sale',
                        'cash_descriptions'=>'Installment and Wallet payment',
                        'user_id'=>auth()->id(),
                    ]
                    );

                    // update sale status
                $balancing = $sales->balance -  $paid;
                if($balancing == 0){
                    $status = "Cash";
                }
                else{
                    $status = "Installment";
                }
            $sale = sale::where('id',request('sale_id'))->update(
                [
                    'paid'=>$sales->paid + request('amount'),
                    'balance'=>$sales->balance - $paid,
                    'status'=> $status
                ]);

            // Add payment to account
            $account = account::wheremain_account(1)->first();
            $accounts = $account->update([
                'total'=>$account->total + $paid - $wallet
            ]);
                return redirect()->back()->with('success','Payment done successfully');
        }
        else{
        return redirect()->back()->with('error','This payment has a zero balance you cant pay');
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
        //
    }
}
