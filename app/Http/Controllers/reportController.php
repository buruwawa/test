<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\cashIn;
use App\Models\customer;
use App\Models\customerAccountSummary;
use App\Models\customerWallet;
use App\Models\customerWalletSummury;
use App\Models\direct_expenses;
use App\Models\expenseCategory;
use App\Models\order;
use App\Models\orderItem;
use App\Models\payment;
use App\Models\purchase;
use App\Models\purchaseOrder;
use App\Models\sale;
use App\Models\stock;
use App\Models\stocking;
use App\Models\subStore;
use App\Models\supplier;
use App\Models\User;
use App\Models\warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sales = sale::join('customers','customers.id','sales.customer_id')
        ->join('users','sales.user_id','users.id')
        ->select('sales.*','customers.customer_name','users.name','customers.id as cid')
        ->where('sales.status','!=','Deleted')
        ->whereDate('sales.created_at', Carbon::today())
        ->get();

        $totals = sale::rightjoin('customers','customers.id','sales.customer_id')
        ->select(['sales.*','customers.customer_name',
        DB::raw('COUNT(customers.customer_name) as total_customers'),
        DB::raw('SUM(sales.amount) as total_revenue'),
        DB::raw('SUM(sales.paid) as total_cash'),
        DB::raw('SUM(sales.balance) as total_credit')
        ])
        ->where('sales.status','!=','Deleted')
        ->whereDate('sales.created_at', Carbon::today())
        ->first();

        $total_customers = customer::select(['*',
        DB::raw('COUNT(customer_name) as total_customers')
        ])
        ->whereDate('customers.created_at', Carbon::today())
        ->first();

        $customers = customer::get();
        $salespeople = User::get();

        return view('admin.reports.sales',compact('sales','customers','salespeople','totals','total_customers'));
    }

    public function expensesReport(){
          //
          $expenses = direct_expenses::
          whereBetween('updated_at',
          [Carbon::now()->startOfMonth(),
          Carbon::now()->endOfMonth()])
          ->get();

          $total_request = direct_expenses::
          select([
          DB::raw('SUM(direct_expenses.amount) as total_request')
          ])
          ->whereBetween('updated_at',
          [Carbon::now()->startOfMonth(),
          Carbon::now()->endOfMonth()])
          ->first();
          $total_pending = direct_expenses::
          select([
          DB::raw('SUM(direct_expenses.amount) as total_pending')
          ])
          ->where('status','Pending')
          ->whereBetween('updated_at',
          [Carbon::now()->startOfMonth(),
          Carbon::now()->endOfMonth()])
          ->first();
          $total_paid = direct_expenses::
          select([
          DB::raw('SUM(direct_expenses.amount) as total_paid')
          ])
          ->where('status','Paid')
          ->whereBetween('updated_at',
          [Carbon::now()->startOfMonth(),
          Carbon::now()->endOfMonth()])
          ->first();

          $categories = expenseCategory::get();
          $status = direct_expenses::groupby('status')->get();


          return view('admin.reports.expenses.expenses',compact('expenses','total_request','total_pending','total_paid','categories','status'));
    }
    public function expensesFilter(Request $request){
        //
        $start_d = substr(request('date'),0,10);
        $start_date = Carbon::parse($start_d)->format('Y-m-d').' 00:00:00';
        $end_d = substr(request('date'),-10);
        $end_date = Carbon::parse($end_d)->format('Y-m-d').' 23:59:00';
        $category = request('category');
        $status = request('status');

        $filter_date = request('date');

        if($category != 'All' && $status == 'All'){
            $expenses = direct_expenses::
            where('category',$category)
            ->whereBetween('updated_at',
           [ $start_date,
           $end_date])
            ->get();

            $total_request = direct_expenses::
            select([
            DB::raw('SUM(direct_expenses.amount) as total_request')
            ])
            ->where('category',$category)
            ->whereBetween('updated_at',
           [ $start_date,
           $end_date])
            ->first();

            $total_pending = direct_expenses::
            select([
            DB::raw('SUM(direct_expenses.amount) as total_pending')
            ])
            ->where('category',$category)
            ->where('status','Pending')
            ->whereBetween('updated_at',
           [ $start_date,
           $end_date])
            ->first();
            $total_paid = direct_expenses::
            select([
            DB::raw('SUM(direct_expenses.amount) as total_paid')
            ])
            ->where('category',$category)
            ->where('status','Paid')
            ->whereBetween('updated_at',
           [ $start_date,
           $end_date])
            ->first();


        }
        if($status != 'All' && $category == 'All'){
            $expenses = direct_expenses::
            where('status',$status)
            ->whereBetween('updated_at',
           [ $start_date,
           $end_date])
            ->get();

            $total_request = direct_expenses::
            select([
            DB::raw('SUM(direct_expenses.amount) as total_request')
            ])
            ->where('status',$status)
            ->whereBetween('updated_at',
           [ $start_date,
           $end_date])
            ->first();

            $total_pending = direct_expenses::
            select([
            DB::raw('SUM(direct_expenses.amount) as total_pending')
            ])
            ->where('status',$status)
            ->where('status','Pending')
            ->whereBetween('updated_at',
           [ $start_date,
           $end_date])
            ->first();
            $total_paid = direct_expenses::
            select([
            DB::raw('SUM(direct_expenses.amount) as total_paid')
            ])
            ->where('status',$status)
            ->where('status','Paid')
            ->whereBetween('updated_at',
           [ $start_date,
           $end_date])
            ->first();
        }
        if($status != 'All' && $category != 'All'){
            $expenses = direct_expenses::
            where('status',$status)
            ->where('category',$category)
            ->whereBetween('updated_at',
           [ $start_date,
           $end_date])
            ->get();

            $total_request = direct_expenses::
            select([
            DB::raw('SUM(direct_expenses.amount) as total_request')
            ])
            ->where('status',$status)
            ->where('category',$category)
            ->whereBetween('updated_at',
           [ $start_date,
           $end_date])
            ->first();

            $total_pending = direct_expenses::
            select([
            DB::raw('SUM(direct_expenses.amount) as total_pending')
            ])
            ->where('status',$status)
            ->where('category',$category)
            ->where('status','Pending')
            ->whereBetween('updated_at',
           [ $start_date,
           $end_date])
            ->first();
            $total_paid = direct_expenses::
            select([
            DB::raw('SUM(direct_expenses.amount) as total_paid')
            ])
            ->where('status',$status)
            ->where('category',$category)
            ->where('status','Paid')
            ->whereBetween('updated_at',
           [ $start_date,
           $end_date])
            ->first();
        }
        if($category == 'All' && $status =='All'){
        $expenses = direct_expenses::
        whereBetween('updated_at',
       [ $start_date,
       $end_date])
        ->get();

        $total_request = direct_expenses::
        select([
        DB::raw('SUM(direct_expenses.amount) as total_request')
        ])
        ->whereBetween('updated_at',
       [ $start_date,
       $end_date])
        ->first();
        $total_pending = direct_expenses::
        select([
        DB::raw('SUM(direct_expenses.amount) as total_pending')
        ])
        ->where('status','Pending')
        ->whereBetween('updated_at',
       [ $start_date,
       $end_date])
        ->first();
        $total_paid = direct_expenses::
        select([
        DB::raw('SUM(direct_expenses.amount) as total_paid')
        ])
        ->where('status','Paid')
        ->whereBetween('updated_at',
       [ $start_date,
       $end_date])
        ->first();

        $categories = expenseCategory::get();
        $status = direct_expenses::groupby('status')->get();
        }


        $categories = expenseCategory::get();
        $status = direct_expenses::groupby('status')->get();
        return view('admin.reports.expenses.expenses',compact('expenses','total_request','total_pending','total_paid','categories','status','filter_date'));
  }

    public function purchaseReport()
    {
        //
        $sales = purchaseOrder::
        join('suppliers','suppliers.id','purchase_orders.supplier_id')
        ->join('users','purchase_orders.user_id','users.id')
        ->select('purchase_orders.*','suppliers.supplier_name','users.name','suppliers.id as cid')
        ->where('purchase_orders.status','!=','Free_stock')
        ->where('purchase_orders.status','!=','Pending')
        ->get();

        $total_invoices = purchaseOrder::select(
        DB::raw('COUNT(id) as total_invoices')
        )
        ->where('purchase_orders.status','!=','Free_stock')
        ->where('purchase_orders.status','!=','Pending')
        ->first();

        $total_paid = purchaseOrder::select(
        DB::raw('COUNT(purchase_orders.id) as total_paid'))
        ->where(function ($query) {
            $query->where('status', 'Cash')
                  ->orwhere('status', 'Installment');
        })
        ->first();
        $total_pending = purchaseOrder::select(
            DB::raw('COUNT(purchase_orders.id) as total_pending'))
            ->where('status', 'Credit')
            ->first();

        $total_payable = purchaseOrder::select(
            DB::raw('SUM(purchase_orders.balance) as total_payable'))
            ->where(function ($query) {
                $query->where('status', 'Credit')
                      ->orwhere('status', 'Installment');
            })
            ->first();

        $suppliers = supplier::get();

        return view('admin.reports.purchase-report',compact('sales','suppliers','total_invoices','total_paid','total_pending','total_payable'));
    }
/**
 * filter sales
 */
    public function filtersales(Request $request){
         $start_d = substr(request('date'),0,10);
         $start_date = Carbon::parse($start_d)->format('Y-m-d').' 00:00:00';
         $end_d = substr(request('date'),-10);
         $end_date = Carbon::parse($end_d)->format('Y-m-d').' 23:59:00';

         if(request('customer')=='All' && request('sales_person')=='All'){
        $sales = sale::join('customers','customers.id','sales.customer_id')
        ->join('users','sales.user_id','users.id')
        ->select('sales.*','customers.customer_name','users.name','customers.id as cid')
        ->where('sales.status','!=','Deleted')
        ->whereBetween('sales.created_at',
        [$start_date,$end_date])
        ->get();

        $totals = sale::rightjoin('customers','customers.id','sales.customer_id')
        ->select(['sales.*','customers.customer_name',
        DB::raw('COUNT(customers.customer_name) as total_customers'),
        DB::raw('SUM(sales.amount) as total_revenue'),
        DB::raw('SUM(sales.paid) as total_cash'),
        DB::raw('SUM(sales.balance) as total_credit')
        ])
        ->where('sales.status','!=','Deleted')
        ->whereBetween('sales.created_at',
            [$start_date,$end_date])
        ->first();

        $total_customers = customer::select(['*',
        DB::raw('COUNT(customer_name) as total_customers')
        ])
        ->whereBetween('customers.created_at',
        [$start_date,$end_date])
        ->first();


         }
         elseif(request('customer')!='All'){
            $sales = sale::join('customers','customers.id','sales.customer_id')
            ->join('users','sales.user_id','users.id')
            ->select('sales.*','customers.customer_name','users.name','customers.id as cid')
            ->where('sales.customer_id',request('customer'))
            ->where('sales.status','!=','Deleted')
            ->whereBetween('sales.created_at',
            [$start_date,$end_date])
            ->get();

            $totals = sale::rightjoin('customers','customers.id','sales.customer_id')
            ->select(['sales.*','customers.customer_name',
            DB::raw('COUNT(customers.customer_name) as total_customers'),
            DB::raw('SUM(sales.amount) as total_revenue'),
            DB::raw('SUM(sales.paid) as total_cash'),
            DB::raw('SUM(sales.balance) as total_credit')
            ])
            ->where('sales.status','!=','Deleted')
            ->where('sales.customer_id',request('customer'))
            ->whereBetween('sales.created_at',
            [$start_date,$end_date])
            ->first();

            $total_customers = customer::select(['*',
            DB::raw('COUNT(customer_name) as total_customers')
            ])
            ->whereBetween('customers.created_at',
                [$start_date,$end_date])
            ->first();

             }
        elseif(request('sales_person')!='All'){
                $sales = sale::join('customers','customers.id','sales.customer_id')
                ->join('users','sales.user_id','users.id')
                ->select('sales.*','customers.customer_name','users.name','customers.id as cid')
                ->where('sales.user_id',request('sales_person'))
                ->where('sales.status','!=','Deleted')
                ->whereBetween('sales.created_at',
                [$start_date,$end_date])
                ->get();

                $totals = sale::rightjoin('customers','customers.id','sales.customer_id')
                ->select(['sales.*','customers.customer_name',
                DB::raw('COUNT(customers.customer_name) as total_customers'),
                DB::raw('SUM(sales.amount) as total_revenue'),
                DB::raw('SUM(sales.paid) as total_cash'),
                DB::raw('SUM(sales.balance) as total_credit')
                ])
                ->where('sales.status','!=','Deleted')
                ->where('sales.user_id',request('sales_person'))
                ->whereBetween('sales.created_at',
                [$start_date,$end_date])
                ->first();

                $total_customers = customer::select(['*',
                DB::raw('COUNT(customer_name) as total_customers')
                ])
                ->whereBetween('customers.created_at',
                [$start_date,$end_date])
                ->first();
                 }
        else{
            $sales = sale::join('customers','customers.id','sales.customer_id')
            ->join('users','sales.user_id','users.id')
            ->select('sales.*','customers.customer_name','users.name','customers.id as cid')
            ->where('sales.status','!=','Deleted')
            ->whereBetween('sales.created_at',
            [$start_date,$end_date])
            ->get();

        $totals = sale::rightjoin('customers','customers.id','sales.customer_id')
        ->select(['sales.*','customers.customer_name',
        DB::raw('COUNT(customers.customer_name) as total_customers'),
        DB::raw('SUM(sales.amount) as total_revenue'),
        DB::raw('SUM(sales.paid) as total_cash'),
        DB::raw('SUM(sales.balance) as total_credit')
        ])
        ->where('sales.status','!=','Deleted')
        ->first();

        $total_customers = customer::select(['*',
        DB::raw('COUNT(customer_name) as total_customers')
        ])->first();
        }
        $dates = request('date');
        $cust = customer::where('id',request('customer'))->first();
        $salesp = User::where('id', request('sales_person'))->first();
        $customers = customer::get();
        $salespeople = User::get();

        return view('admin.reports.sales-filter',compact('sales','customers','salespeople','total_customers',
        'totals','dates','cust','salesp'));


    }
 /**
 * filter Purchase
 */
public function filterPurchase(Request $request){
    $start_d = substr(request('date'),0,10);
    $start_date = Carbon::parse($start_d)->format('Y-m-d').' 00:00:00';
    $end_d = substr(request('date'),-10);
    $end_date = Carbon::parse($end_d)->format('Y-m-d').' 23:59:00';

    if(request('supplier')=='All'){
   //
   $sales = purchaseOrder::
   join('suppliers','suppliers.id','purchase_orders.supplier_id')
   ->join('users','purchase_orders.user_id','users.id')
   ->select('purchase_orders.*','suppliers.supplier_name','users.name','suppliers.id as cid')
   ->where('purchase_orders.status','!=','Free_stock')
   ->where('purchase_orders.status','!=','Pending')
   ->wherebetween('purchase_orders.created_at',[ $start_date,$end_date])
   ->get();

   $total_invoices = purchaseOrder::select(
   DB::raw('COUNT(id) as total_invoices')
   )
   ->where('purchase_orders.status','!=','Free_stock')
   ->where('purchase_orders.status','!=','Pending')
   ->wherebetween('purchase_orders.created_at',[ $start_date,$end_date])
   ->first();

   $total_paid = purchaseOrder::select(
   DB::raw('COUNT(purchase_orders.id) as total_paid'))
   ->where(function ($query) {
       $query->where('status', 'Cash')
             ->orwhere('status', 'Installment');
   })
   ->wherebetween('purchase_orders.created_at',[ $start_date,$end_date])
   ->first();
   $total_pending = purchaseOrder::select(
       DB::raw('COUNT(purchase_orders.id) as total_pending'))
       ->where('status', 'Credit')
       ->wherebetween('purchase_orders.created_at',[ $start_date,$end_date])
       ->first();

   $total_payable = purchaseOrder::select(
       DB::raw('SUM(purchase_orders.balance) as total_payable'))
       ->where(function ($query) {
           $query->where('status', 'Credit')
                 ->orwhere('status', 'Installment');
       })
       ->wherebetween('purchase_orders.created_at',[ $start_date,$end_date])
       ->first();

   $suppliers = supplier::get();


   return view('admin.reports.purchase-report',compact('sales','suppliers','total_invoices','total_paid',
   'total_pending','total_payable','start_date','end_date'));
    }

   elseif(request('supplier')!='All'){
    //
    $sales = purchaseOrder::
    join('suppliers','suppliers.id','purchase_orders.supplier_id')
    ->join('users','purchase_orders.user_id','users.id')
    ->select('purchase_orders.*','suppliers.supplier_name','users.name','suppliers.id as cid')
    ->where('purchase_orders.status','!=','Free_stock')
    ->where('purchase_orders.status','!=','Pending')
    ->where('purchase_orders.supplier_id',request('supplier'))
    ->wherebetween('purchase_orders.created_at',[ $start_date,$end_date])
    ->get();

    $total_invoices = purchaseOrder::select(
    DB::raw('COUNT(id) as total_invoices')
    )
    ->where('purchase_orders.status','!=','Free_stock')
    ->where('purchase_orders.status','!=','Pending')
    ->wherebetween('purchase_orders.created_at',[ $start_date,$end_date])
    ->first();

    $total_paid = purchaseOrder::select(
    DB::raw('COUNT(purchase_orders.id) as total_paid'))
    ->where(function ($query) {
        $query->where('status', 'Cash')
              ->orwhere('status', 'Installment');
    })
    ->wherebetween('purchase_orders.created_at',[ $start_date,$end_date])
    ->first();
    $total_pending = purchaseOrder::select(
        DB::raw('COUNT(purchase_orders.id) as total_pending'))
        ->where('status', 'Credit')
        ->wherebetween('purchase_orders.created_at',[ $start_date,$end_date])
        ->first();

    $total_payable = purchaseOrder::select(
        DB::raw('SUM(purchase_orders.balance) as total_payable'))
        ->where(function ($query) {
            $query->where('status', 'Credit')
                  ->orwhere('status', 'Installment');
        })
        ->wherebetween('purchase_orders.created_at',[ $start_date,$end_date])
        ->first();

    $suppliers = supplier::get();
    return view('admin.reports.purchase-report',compact('sales','suppliers','total_invoices','total_paid',
    'total_pending','total_payable','start_date','end_date'));
}



}
/**
 * Sale Order View
 */
public function showOrder($id){
    //
    $sales = orderItem::join('orders','order_items.order_id','orders.id')
    ->join('stocks','order_items.item_id','stocks.id')
    ->select('order_items.*','stocks.item')
    ->where('orders.status','Sold')
    ->where('order_items.order_id',$id)->get();

    $customers = order::join('customers','orders.customer_id','customers.id')
    ->select('customers.customer_name','customers.tin','customers.phone','customers.location','orders.*')
    ->where('orders.status','Sold')
    ->where('orders.id',$id)->get();

    $totals = sale::where('order_id',$id)->where('status','!=','Deleted')->first();
    return view('admin.reports.show_sales', compact('sales','totals','customers'));

}

public function showPurchase($id){
    //
    $purchase = purchaseOrder::
    join('purchase_items','purchase_items.order_id','purchase_orders.id')
    ->join('stocks','purchase_items.item_id','stocks.id')
    ->join('suppliers','suppliers.id','purchase_orders.supplier_id')
    ->select('purchase_items.*','stocks.item','stocks.price','suppliers.supplier_name')
    ->where('purchase_items.order_id',$id)->get();

    $suppliers = purchaseOrder::join('purchase_items','purchase_items.order_id','purchase_orders.id')
    ->join('suppliers','suppliers.id','purchase_orders.supplier_id')
    ->select('suppliers.supplier_name','suppliers.tin','suppliers.phone','suppliers.address','purchase_orders.*')
    ->where('purchase_orders.payment','Purchased')
    ->where('purchase_items.order_id',$id)->first();

    $totals = purchaseOrder:: join('purchase_items','purchase_items.order_id','purchase_orders.id')
    ->where('purchase_items.order_id',$id)->where('status','!=','Deleted')->first();
    return view('admin.reports.show_purchase', compact('purchase','suppliers','totals'));

}
/**
 * Item sold report
 */

 public function itemSold(){
    $sales = sale::join('order_items','order_items.order_id','sales.id')
    ->join('stocks','stocks.id','order_items.item_id')
    ->select(['sales.*','stocks.item',
    DB::raw('SUM(order_items.qty) as total_qty')])
    ->where('sales.status','!=','Deleted')
    ->whereBetween('sales.created_at',
    [Carbon::now()->startOfMonth(),
    Carbon::now()->endOfMonth()])
    ->groupby('order_items.item_id')
    ->get();
    $items = stock::get();
    $warehouses = warehouse::get();
    return view('admin.reports.sold.sold',compact('sales','items','warehouses'));
 }

/**
 * Filter sold items
 */
public function soldFilter(){

    $start_d = substr(request('date'),0,10);
    $start_date = Carbon::parse($start_d)->format('Y-m-d').' 00:00:00';
    $end_d = substr(request('date'),-10);
    $end_date = Carbon::parse($end_d)->format('Y-m-d').' 23:59:00';
    $warehouses = warehouse::get();


    if(request('date') && request('items')!='All' && request('warehouse')=='All'){
        $sales = sale::join('order_items','order_items.order_id','sales.id')
        ->join('stocks','stocks.id','order_items.item_id')
        ->select(['sales.*','stocks.item',
        DB::raw('SUM(order_items.qty) as total_qty')])
        ->where('sales.status','!=','Deleted')
        ->where('order_items.item_id',request('items'))
        ->whereBetween('sales.created_at',
        [ $start_date,$end_date])
        ->groupby('order_items.item_id')
        ->get();
        $items = stock::get();
    }
    elseif(request('date') && request('items')!='All' && request('warehouse')!='All'){
        $sales = sale::join('order_items','order_items.order_id','sales.id')
        ->join('stocks','stocks.id','order_items.item_id')
        ->join('orders','orders.id','sales.order_id')
        ->select(['sales.*','stocks.item',
        DB::raw('SUM(order_items.qty) as total_qty')])
        ->where('sales.status','!=','Deleted')
        ->where('orders.warehouse_id',request('warehouse'))
        ->where('order_items.item_id',request('items'))
        ->whereBetween('sales.created_at',
        [ $start_date,$end_date])
        ->groupby('order_items.item_id')
        ->get();
        $items = stock::get();

    }
    elseif(request('date') && request('items')=='All' && request('warehouse')!='All'){
        $sales = sale::join('order_items','order_items.order_id','sales.id')
        ->join('orders','orders.id','sales.order_id')
        ->join('stocks','stocks.id','order_items.item_id')
        ->select(['sales.*','stocks.item',
        DB::raw('SUM(order_items.qty) as total_qty')])
        ->where('sales.status','!=','Deleted')
        ->where('orders.warehouse_id',request('warehouse'))
        ->whereBetween('sales.created_at',
        [ $start_date,$end_date])
        ->groupby('order_items.item_id')
        ->get();
        $items = stock::get();
    }

    else{
        $sales = sale::join('order_items','order_items.order_id','sales.id')
        ->join('stocks','stocks.id','order_items.item_id')
        ->select(['sales.*','stocks.item',
        DB::raw('SUM(order_items.qty) as total_qty')])
        ->where('sales.status','!=','Deleted')
        ->whereBetween('sales.created_at',
        [Carbon::now()->startOfMonth(),
        Carbon::now()->endOfMonth()])
        ->groupby('order_items.item_id')
        ->get();
        $items = stock::get();
    }
    return view('admin.reports.sold.sold',compact('sales','items','warehouses'));
}

    /**
     * Customer sale show
     *
     */
    public function customersale($id){
        $sales = orderItem::join('orders','order_items.order_id','orders.id')
        ->join('stocks','order_items.item_id','stocks.id')
        ->select('order_items.*','stocks.item')
        ->where('orders.status','Sold')
        ->where('orders.customer_id',$id)->get();

        return view('admin.reports.show_sales', compact('sales'));
    }
/**
 * Transaction report
 */

 public function transaction_report(){
    //

    $sales = payment::
    join('users','users.id','payments.user_id')
    ->join('sales','sales.id','payments.sale_id')
    ->select(
        'users.name',
        DB::raw('SUM(payments.paid) as total_sale'),
        DB::raw('count(payments.paid) as count')
    )
    ->groupby('payments.user_id')
    ->whereDate('payments.created_at',Carbon::today())
    ->get();

    $warehouses = warehouse::get();
    $payments = payment::
    join('users','users.id','payments.user_id')
    ->join('sales','sales.id','payments.sale_id')
    ->leftjoin('customers','customers.id','sales.customer_id')
    ->select('payments.*','users.name','customers.customer_name','sales.order_id')
    ->where('payments.status','!=','Deleted')
    ->whereDate('payments.created_at',Carbon::today())
    ->get();

    $totals = payment::select(
        DB::raw('SUM(amount) as total_amount'),
        DB::raw('SUM(paid) as total_paid'),
        DB::raw('SUM(balance) as balance')
    )
    ->where('status','!=','Deleted')
    ->whereDate('created_at',Carbon::today())
    ->first();
    return view('admin.reports.transactions.transaction',compact('sales','warehouses','payments','totals'));
}


public function transactions($id){
    //
    $user = User::where('id',auth()->id())->first();
    // For admins only
    if($user->hasRole('Admin')){
    if($id == 'daily'){
        $sales = payment::
        join('users','users.id','payments.user_id')
        ->join('sales','sales.id','payments.sale_id')
        ->select(
            'users.name',
            DB::raw('SUM(payments.paid) as total_sale'),
            DB::raw('count(payments.paid) as count')
        )
        ->groupby('payments.user_id')
        ->wheredate('payments.created_at',Carbon::today())
        ->get();

        $warehouses = warehouse::get();
        $payments = sale::
        join('users','users.id','sales.user_id')
        ->join('payments','sales.id','payments.sale_id')
        ->leftjoin('customers','customers.id','sales.customer_id')
        ->select('payments.*','users.name','customers.customer_name','sales.order_id')
        ->where('sales.status','!=','Deleted')
        ->whereDate('sales.updated_at',Carbon::today())
        ->get();

        $totals = sale::
        join('users','users.id','sales.user_id')
        ->join('payments','sales.id','payments.sale_id')
        ->leftjoin('customers','customers.id','sales.customer_id')
        ->select(
            DB::raw('SUM(sales.amount) as total_amount'),
            DB::raw('SUM(sales.paid) as total_paid'),
            DB::raw('SUM(sales.balance) as balance')
        )
        ->where('sales.status','!=','Deleted')
        ->whereDate('sales.updated_at',Carbon::today())
        ->first();
        return view('admin.reports.transactions.transaction',compact('sales','warehouses','payments','totals'));
    }
    if($id == 'weekly'){
        $period = array([Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()]);
    }
    if($id == 'monthly'){
        $period = array([Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()]);
    }
    else{
        $period = array([Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()]);
    }

    $sales = payment::
    join('users','users.id','payments.user_id')
    ->join('sales','sales.id','payments.sale_id')
    ->select(
        'users.name',
        DB::raw('SUM(payments.paid) as total_sale'),
        DB::raw('count(payments.paid) as count')
    )
    ->groupby('payments.user_id')
    ->wherebetween('payments.created_at',$period)
    ->get();

    $warehouses = warehouse::get();
    $payments = payment::
    join('users','users.id','payments.user_id')
    ->join('sales','sales.id','payments.sale_id')
    ->leftjoin('customers','customers.id','sales.customer_id')
    ->wherebetween('payments.created_at',$period)
    ->get();

    $totals = payment::select(
        DB::raw('SUM(amount) as total_amount'),
        DB::raw('SUM(paid) as total_paid'),
        DB::raw('SUM(balance) as balance')
    )
    ->wherebetween('created_at',$period)
    ->first();
    return view('admin.reports.transactions.transaction',compact('sales','warehouses','payments','totals'));
}

// Sales peoples
if($user->hasRole('Sales')){
    if($id == 'daily'){
        $period = Carbon::today();
        $sales = payment::get();
        $warehouses = warehouse::get();
        $payments = sale::
        join('users','users.id','sales.user_id')
        ->join('payments','sales.id','payments.sale_id')
        ->leftjoin('customers','customers.id','sales.customer_id')
        ->select('payments.*','users.name','customers.customer_name','sales.order_id')
        ->where('sales.user_id', auth()->id())
        ->whereDate('sales.updated_at',$period)
        ->get();

        $totals = sale::
        join('users','users.id','sales.user_id')
        ->join('payments','sales.id','payments.sale_id')
        ->leftjoin('customers','customers.id','sales.customer_id')
        ->select(
            DB::raw('SUM(sales.amount) as total_amount'),
            DB::raw('SUM(sales.paid) as total_paid'),
            DB::raw('SUM(sales.balance) as balance')
        )
        ->where('sales.status','!=','Deleted')
        ->where('sales.user_id', auth()->id())
        ->whereDate('sales.updated_at',$period)
        ->first();
        return view('admin.reports.transactions.transaction',compact('sales','warehouses','payments','totals'));
    }
    if($id == 'weekly'){
        $period = array([Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()]);
    }
    if($id == 'monthly'){
        $period = array([Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()]);
    }
    else{
        $period = array([Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()]);
    }

    $sales = payment::
    join('users','users.id','payments.user_id')
    ->join('sales','sales.id','payments.sale_id')
    ->select(
        'users.name',
        DB::raw('SUM(payments.paid) as total_sale'),
        DB::raw('count(payments.paid) as count')
    )
    ->groupby('payments.user_id')
    ->where('payments.user_id', auth()->id())
    ->wherebetween('payments.created_at',$period)
    ->get();

    $warehouses = warehouse::get();
    $payments = payment::
    join('users','users.id','payments.user_id')
    ->join('sales','sales.id','payments.sale_id')
    ->leftjoin('customers','customers.id','sales.customer_id')
    ->where('payments.user_id', auth()->id())
    ->wherebetween('payments.created_at',$period)
    ->get();

    $totals = payment::select(
        DB::raw('SUM(amount) as total_amount'),
        DB::raw('SUM(paid) as total_paid'),
        DB::raw('SUM(balance) as balance')
    )->where('payments.user_id', auth()->id())
    ->wherebetween('created_at',$period)
    ->first();
    return view('admin.reports.transactions.transaction',compact('sales','warehouses','payments','totals'));
}
}

/**
 * Transaction report
 */

public function transaction_filter(){
        $start_d = substr(request('date'),0,10);
        $start_date = Carbon::parse($start_d)->format('Y-m-d').' 00:00:00';
        $end_d = substr(request('date'),-10);
        $end_date = Carbon::parse($end_d)->format('Y-m-d').' 23:59:00';
        $warehouse_name = request('warehouse');
        $dates = request('date');
        if($warehouse_name !='All'){
        $warehouse_id = warehouse::where('id', $warehouse_name)->first();
        $warehouse_title =  $warehouse_id->warehouse;
        }
        else{
            $warehouse_title = 'All';
        }
        $date = Carbon::parse($start_d)->format('d, M Y').' - '.Carbon::parse($end_d)->format('d,M Y');


if( $warehouse_name == 'All'){
    $sales = payment::
    join('users','users.id','payments.user_id')
    ->join('sales','sales.id','payments.sale_id')
    ->select(
        'users.name',
        DB::raw('SUM(payments.paid) as total_sale'),
        DB::raw('count(payments.paid) as count')
    )
    ->wherebetween('payments.created_at',[$start_date,$end_date])
    ->groupby('payments.user_id')
    ->get();

    $payments = payment::
    join('users','users.id','payments.user_id')
    ->join('sales','sales.id','payments.sale_id')
    ->leftjoin('customers','customers.id','sales.customer_id')
    ->select('payments.*','users.name','customers.customer_name')
    ->where('payments.status','!=','Deleted')
    ->wherebetween('payments.created_at',[$start_date,$end_date])
    ->get();

    $warehouses = warehouse::get();
    $totals = payment::select(
        DB::raw('SUM(amount) as total_amount'),
        DB::raw('SUM(paid) as total_paid'),
        DB::raw('SUM(balance) as balance')
    )
    ->wherebetween('payments.created_at',[$start_date,$end_date])
    ->first();
    return view('admin.reports.transactions.transaction',compact('sales','warehouses','payments','totals','date', 'dates','warehouse_title'));
}
if( $warehouse_name != 'All'){
    $sales = payment::
    join('users','users.id','payments.user_id')
    ->join('sales','sales.id','payments.sale_id')
    ->join('orders','sales.order_id','orders.id')
    ->select(
        'users.name',
        DB::raw('SUM(payments.paid) as total_sale'),
        DB::raw('count(payments.paid) as count')
    )
    ->where('orders.warehouse_id',$warehouse_name)
    ->wherebetween('payments.created_at',[$start_date,$end_date])
    ->groupby('payments.user_id')
    ->get();


    $payments = payment::
    join('users','users.id','payments.user_id')
    ->join('sales','sales.id','payments.sale_id')
    ->join('orders','sales.order_id','orders.id')
    ->leftjoin('customers','customers.id','sales.customer_id')
    ->select('payments.*','users.name','customers.customer_name')
    ->where('orders.warehouse_id',$warehouse_name)
    ->wherebetween('payments.created_at',[$start_date,$end_date])
    ->get();

    $warehouses = warehouse::get();
    $totals = payment::
    join('users','users.id','payments.user_id')
    ->join('sales','sales.id','payments.sale_id')
    ->join('orders','sales.order_id','orders.id')
    ->select(
        DB::raw('SUM(payments.amount) as total_amount'),
        DB::raw('SUM(payments.paid) as total_paid'),
        DB::raw('SUM(payments.balance) as balance')
    )
    ->where('orders.warehouse_id',$warehouse_name)
    ->wherebetween('payments.created_at',[$start_date,$end_date])
    ->first();
    return view('admin.reports.transactions.transaction',compact('sales','warehouses','payments','totals','date','dates','warehouse_title'));
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
        //
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
        $sales = sale::join('customers','customers.id','sales.customer_id')
        ->join('users','sales.user_id','users.id')
        ->select('sales.*','customers.customer_name','users.name')
        ->where('sales.status','!=','Deleted')
        ->whereDate('sales.created_at',Carbon::today())
        ->get();

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
        $sale_value = sale::where('id',$id)->first();
        $account = account::where('main_account',1)->first();

        //validate account not to allow refund without enough balance
       if($account->total >= $sale_value->paid){
           //Proceed with procedure
       if(request('delete-sale')){

        // if sale was on cash
         // return item to  where it came from
        $item = orderItem::join('orders','orders.id', 'order_items.order_id')
        ->where('order_id',$sale_value->order_id)->get();
        foreach($item as $itemed){
            $substore = subStore::where('warehouse',$itemed->warehouse_id)->where('item_id',$itemed->item_id)
            ->first();
            $current_qty = $substore->current_qty;
            $return = subStore::where('warehouse',$itemed->warehouse_id)->where('item_id',$itemed->item_id)->update([
                'current_qty'=>$current_qty + $itemed->qty
            ]);
        //      // keep movement record on stocking
            $stocking = stocking::create([
                'item_id'=>$itemed->item_id,
                'qty'=>$itemed->qty,
                'current_qty'=>$current_qty + $itemed->qty,
                'from'=>$itemed->customer_id,
                'to'=>$itemed->warehouse_id,
                'status'=>'Returned Sale',
                'user_id'=>auth()->id()
            ]);

        }
        //  // Deduct sales value.
         $deduct = account::where('main_account',1)->update([
             'total'=>$account->total - $sale_value->paid
         ]);
        //  // Create a record for main account
         $main_account_reccord = cashIn::create([
             'account_id'=> $account->id,
             'amount_received'=> - $sale_value->paid,
             'amount_to'=> $account->total - $sale_value->paid,
             'cash_category'=>'Returned Sale',
             'cash_descriptions'=>'Returned Sale',
             'user_id'=>auth()->id(),
         ]);
         // return fund to customer if paid
         $sale_wallet = $sale_value->wallet;
         $wallet = customerWallet::where('customer_id', $sale_value->customer_id)->first();
         $wallet_balance = $wallet->balance;


        // If the sale paid via wallet
         if( $sale_wallet > 0){
            $update = customerWallet::where('customer_id', $sale_value->customer_id)->update([
                'amount'=>$sale_wallet,
                'balance'=> $wallet_balance + $sale_wallet
            ]);

        }

// if  sale is on credit or installment
        elseif($sale_value->balance > 0 ){
            $customer_account = customer::where('id',$sale_value->customer_id)->first();
            $balance = $sale_value->balance;
            $current_credit = $customer_account->to;

            if($balance <= -$current_credit){
                // If the customer credit balance is greater than the refunded amount this account should keep the negative figures only;
                $customer = customer::where('id',$sale_value->customer_id)->update([
                    'from'=>$current_credit,
                    'to'=> $current_credit + $balance
                 ]);
                 $customer_account_sammury = customerAccountSummary::create([
                    'customer_id'=>$sale_value->customer_id,
                    'sale_id'=>$id,
                    'from'=>$current_credit,
                    'to'=>$current_credit + $balance,
                    'status'=>'Deleted',
                    'user_id'=>auth()->id()
                 ]);
            }
            else{
                // any positive customer account balance should be kept in the wallet
                $to_wallet = $sale_value->paid + $customer_account->to;
                $customer = customer::where('id',$sale_value->customer_id)->update([
                    'from'=>$current_credit,
                    'to'=>0
                 ]);
                 $customer_account_sammury = customerAccountSummary::create([
                    'customer_id'=>$sale_value->customer_id,
                    'sale_id'=>$id,
                    'from'=>$current_credit,
                    'to'=>0,
                    'status'=>'Deleted',
                    'user_id'=>auth()->id()
                 ]);
                 $wallet_id = customerWallet::where('customer_id', $sale_value->customer_id)->first();
                 $update = customerWallet::where('customer_id', $sale_value->customer_id)->update([
                    'amount'=> $to_wallet,
                    'balance'=> $wallet_balance + $to_wallet
                ]);
                $wallet_summary = customerWalletSummury::create([
                    'customer_id'=>$sale_value->customer_id,
                    'wallet_id'=>$wallet_id->id,
                    'order_id'=>$sale_value->order_id,
                    'wallet_amount'=>$sale_value->wallet,
                    'wallet_balance'=>$wallet_balance + $to_wallet,
                    'status'=>'Refund from deleted sale',
                    'user_id'=>auth()->id()
                ]);
            } // end of if customer credit is greater than 0 then redirect the fund to  customer wallet

        } // end of if is credit or installment payment
        // Delete sale
        $record = sale::where('id',$id)->update([
            'status'=>'Deleted'
        ]);
         // change status to delete from order
         $order = order::where('id',$sale_value->order_id)->update([
            'status'=>'Deleted' ]);
         // Delete record from payment
            $delete_payment = payment::where('sale_id',$id)->first();
            if($delete_payment){
                payment::where('sale_id',$id)->update(['status'=>'Deleted']);
        }
           return redirect()->back()->with('success','Sale deleted Successfully');
       } //end of delete function

    }
       else{
        return redirect()->back()->with('error','You do not have enough balance to refund this amount');
       }

    }
}
