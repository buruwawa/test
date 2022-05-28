<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplierWallet extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'amount',
        'balance',
        'user_id'
    ];
}
