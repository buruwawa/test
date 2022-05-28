<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_name',
        'contact_person',
        'position',
        'phone',
        'tin',
        'vrn',
        'email',
        'address',
        'from',
        'to',
        'user_id'
    ];
}
