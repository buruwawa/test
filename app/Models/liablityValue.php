<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class liablityValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'payable_supplier',
        'expenses',
        'advance_paid_by_customer',
    ];
}
