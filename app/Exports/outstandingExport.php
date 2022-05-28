<?php

namespace App\Exports;

use App\Models\sale;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class outstandingExport implements FromQuery,WithHeadings
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
            'wallet_balance',
        ];
    }
    public function query()
    {
        $outstandings = sale::query()->join('customers','sales.customer_id','customers.id')
                    ->leftjoin('customer_wallets','customer_wallets.customer_id','customers.id')
                    ->select('sales.*','customers.customer_name','customer_wallets.balance as wallet_balance')
                    ->where(function ($query) {
                        $query->where('sales.status', 'Credit')
                              ->orwhere('sales.status', 'Installment'); });
        return $outstandings;
    }
}
