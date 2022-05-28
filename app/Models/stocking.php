<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stocking extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'qty',
        'current_qty',
        'from',
        'to',
        'status',
        'user_id'
    ];
}
