<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'item',
        'unit',
        'material_code',
        'price',
        'selling_price',
        'vat',
        'stock_alert',
        'descriptions',
        'user_id'
    ];
}
