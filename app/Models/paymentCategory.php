<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paymentCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_category',
        'user_id'
    ];
}
