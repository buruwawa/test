<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subStore extends Model
{
    use HasFactory;
    protected $fillable = [
        'warehouse',
        'warehouse_name',
        'item_id',
        'current_qty'
    ];
}
