<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class metanameDatatype extends Model
{
    use HasFactory;
       protected $fillable = [  
          
        'metaname_id',
        'metadata_name',
        'datatype', 
        'datatype_name',
        'status',      
        'user_id'
       ];
}
