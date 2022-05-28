<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cashIn extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'amount_received',
        'amount_to',
        'cash_category',
        'cash_descriptions',
        'user_id',
    ];
}
