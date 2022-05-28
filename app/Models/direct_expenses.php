<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class direct_expenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'expenses_name',
        'amount',
        'category',
        'descriptions',
        'status',
        'user_id'
    ];
}
