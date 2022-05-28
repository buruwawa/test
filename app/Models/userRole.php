<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userRole extends Model
{
    use HasFactory;
    protected $fillable  = [
        'sys_user_id',
        'role_id',
        'status',
        'user_id',
    ];
}
