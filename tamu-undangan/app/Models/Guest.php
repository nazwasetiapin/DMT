<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'name',
        'address',
        'whatsapp',
        'message',
        'gift_type',
        'transfer_amount',
        'transfer_method',
        'proof',
        'cash_amount',
        'barang_name',
        'photo',
    ];
}

