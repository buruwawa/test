<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentalOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'start_date',
        'end_date',
        'amount',
        'status',
        'user_id',
    ];
}
