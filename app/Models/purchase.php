<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_id',
        'amount',
        'paid',
        'balance',
        'status',
        'user_id',
    ];
}
