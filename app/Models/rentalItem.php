<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentalItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'item',
        'unit',
        'material_code',
        'fee',
        'descriptions',
        'user_id'
    ];
}
