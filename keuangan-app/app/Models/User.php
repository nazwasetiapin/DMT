<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi (fillable).
     */
    protected $fillable = [
        'username',
        'password',
        'role', // admin atau ceo
        'photo',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting kolom.
     */
    protected $casts = [
        // pakai 'hashed' biar otomatis hash saat update password
        'password' => 'hashed',
    ];

    /**
     * Gunakan kolom `username` untuk login, bukan `email`.
     */
    public function getAuthIdentifierName()
    {
        return 'username';
    }

    /**
     * Setter otomatis untuk password (hash manual).
     * Catatan: ini optional karena sudah ada 'hashed' di $casts.
     */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            // Jika sudah di-hash (misal dari seeder), jangan di-hash ulang
            if (!Hash::info($value)['algo']) {
                $this->attributes['password'] = Hash::make($value);
            } else {
                $this->attributes['password'] = $value;
            }
        }
    }

    /**
     * Cek role user.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isCeo()
    {
        return $this->role === 'ceo';
    }
}
