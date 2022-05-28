<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerWallet extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'amount',
        'balance',
        'user_id'
    ];
}
