<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class optionalAnswer extends Model
{
    use HasFactory;
      protected $fillable  = [
        'indicator_id',
        'answer',
        'datatype',
        'status',
        'user_id',
    ];
}
