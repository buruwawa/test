<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'warehouse_id',
        'discount',
        'amount',
        'paid',
        'balance',
        'status',
        'payment',
        'user_id'
    ];
}

