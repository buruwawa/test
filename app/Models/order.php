<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'warehouse_id',
        'discount',
        'status',
        'user_id',
    ];
}

