<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departmentRole extends Model
{
    use HasFactory;
       protected $fillable  = [
        'role_id',
        'department_id',
        'status',
        'user_id',
    ];
}
