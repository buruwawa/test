<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customerAccountSummary extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'sale_id',
        'from',
        'to',
        'status',
        'user_id'
    ];
}
