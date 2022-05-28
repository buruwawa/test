<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class account extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_name',
        'descriptions',
        'main_account',
        'total',
        'user_id'
    ];
}
