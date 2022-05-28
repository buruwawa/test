<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchaseItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'item_id',
        'width',
        'height',
        'qty',
        'buying_price',
         'cost',
    ];
}
