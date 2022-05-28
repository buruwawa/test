<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class myPayment extends Model
{
    use HasFactory;
     protected $connection = 'mysql';
    protected $fillable = [
        'invoice_number',
        'my_id',
        'package_name',
        'amount_paid',
        'transaction_id',
        'paid_via',
        'start_from',
        'end_at',
        'status',
    ];

}
