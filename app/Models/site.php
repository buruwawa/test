<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class site extends Model
{
    use HasFactory;
       protected $fillable = [
        'site_name',
        'site_category',
        'site_rank',
        'room_no',
        'location_name',
        'phone',
        'email',
        'site_description',
        'photo',
        'status',
        'user_id'
    ];
}
