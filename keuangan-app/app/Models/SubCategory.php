<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = 'sub_categories'; // nama tabel
    protected $guarded = ['id'];         // proteksi kolom id

    /**
     * Relasi ke transactions
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'sub_category_id');
    }
}
