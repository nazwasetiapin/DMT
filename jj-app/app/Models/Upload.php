<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'file',
        'request_note',
        'bukti',
        'harga',
        'status', 
        'processed_file'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}