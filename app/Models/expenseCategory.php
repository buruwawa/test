<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expenseCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'expenses_category',
        'user_id'
    ];
}
