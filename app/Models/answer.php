<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class answer extends Model
{
    use HasFactory;
    protected $fillable = [
        'indicator_id',
        'answer',
        'property_id',
        'description',
         'image',
        'status',
        'action',
        'user_id'
    ];
}
