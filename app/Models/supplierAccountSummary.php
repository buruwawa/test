<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplierAccountSummary extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'from',
        'to',
        'status',
        'user_id'
    ];
}
