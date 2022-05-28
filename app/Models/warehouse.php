<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'warehouse',
        'location',
        'descriptions',
        'main_warehouse',
        'user_id'
    ];
}
