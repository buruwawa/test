<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendingStock extends Model
{
     use HasFactory;
    protected $fillable = [
        'item_id',
        'trans_no',
        'item_name',
        'from_store',
        'Qty_issued',
        'to_store',
        'Qty_received',
        'trans_type',
        'user_id'
    ];
}
