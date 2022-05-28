<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assetValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'cash_in_hand',
        'credit_customer',
        'advance_paid_to_supplier',
        'stock_value'
    ];
}
