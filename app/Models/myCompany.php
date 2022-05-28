<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class myCompany extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'logo',
        'address',
        'phone_number',
        'package',
        'status',
        'renew_at',
    ];
}
