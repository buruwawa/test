<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerWalletSummury extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'wallet_id',
        'order_id',
        'wallet_amount',
        'wallet_balance',
        'status',
        'user_id'
    ];
}
