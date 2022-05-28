<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activityRole extends Model
{
    use HasFactory;
       protected $fillable  = [
        'role_id',
        'activity_id',
        'status',
        'user_id',
    ];
}
