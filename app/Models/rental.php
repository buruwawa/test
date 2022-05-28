<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rental extends Model
{
    use HasFactory;
    protected $fillable  = [
        'order_id',
        'customer_id',
        'amount',
        'paid',
        'balance',
        'wallet',
        'status',
        'user_id',
    ];
}
