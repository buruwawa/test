<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userActivity extends Model
{
    use HasFactory;
    protected $fillable  = [
        'sys_user_id',
        'activity_id',
        'status',
        'user_id',
    ];
}
