<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

   protected $fillable = [
    'username',
    'no_wa',
    'password',
    'tiktok_1',
    'tiktok_2',
];


    protected $hidden = [
        'password',
        'remember_token',
    ];
}
