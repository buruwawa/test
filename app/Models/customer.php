<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'company_name',
        'tin',
        'vrn',
        'email',
        'phone',
        'location',
        'from',
        'to',
        'user_id'
    ];
}
