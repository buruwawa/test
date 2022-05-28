<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplierWalletSummury extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'wallet_id',
        'purchase_id',
        'wallet_amount',
        'wallet_balance',
        'status',
        'user_id'
    ];
}
