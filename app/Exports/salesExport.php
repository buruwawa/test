<?php

namespace App\Exports;

use App\Models\sale;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class salesExport implements FromQuery,WithHeadings
{

    public function headings(): array
    {
        return [
            'id',
            'order_id',
            'customer_id',
            'discount',
            'vat',
            'amount',
            'paid',
            'balance',
            'wallet',
            'status',
            'user_id',
            'created_at',
            'updated_at',
            'customer_name',
            'sales_name',
        ];
    }
    public function query()
    {
        $sales = sale::query()->join('customers','customers.id','sales.customer_id')
        ->join('users','sales.user_id','users.id')
        ->select('sales.*','customers.customer_name','users.name')
        ->where('sales.status','!=','Deleted')
        ->whereBetween('sales.created_at',
        [Carbon::now()->startOfMonth(),
        Carbon::now()->endOfMonth()]);
        return  $sales;
    }
}
