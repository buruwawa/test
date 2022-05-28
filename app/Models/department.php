<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    use HasFactory;
      protected $fillable = [       
        'department_name',
        'unit_name', 
         'status', 
        'users',       
        'user_id'
       ];
}
