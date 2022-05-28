<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datatype extends Model
{
    use HasFactory;
       protected $fillable = [       
        'datatype_name',
        'datatype',       
        'user_id'
       ];
}
