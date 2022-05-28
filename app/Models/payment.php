<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_id',
        'amount',
        'account_id',
        'paid',
        'wallet',
        'balance',
        'receipt',
        'status',
        'user_id',
    ];
}
