<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class testerController extends Controller
{
    //
    public function test(){
        // $testing  = sale::select(
        //     'cutomers.customer_name',
        //     DB::raw('sum(sales.balance)total_balance')
        // )
        // ->groupBy('sales.customer_id')
        // ->get();
        // $customers = customer::get();

   $testers = sale::join('customers','customers.id','sales.customer_id')
      ->select('customers.id',
        'customers.customer_name', 'customers.to as total_credit',
        DB::raw('sum(sales.balance)total_invoices')
    )
    ->where('sales.status','<>','Deleted')
    ->groupBy('sales.customer_id')
    ->get();



        return view('admin.tester',compact('testers'));
    }
}
