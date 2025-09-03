<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions'; // tabel dari migration
    protected $guarded = ['id'];       // proteksi kolom id

    protected $casts = [
        'tanggal' => 'datetime', // kalau nanti ada kolom tanggal
        'amount'  => 'decimal:2'
    ];

    // relasi ke tabel types
    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    // relasi ke tabel categories
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // relasi ke tabel sub_categories
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    // contoh accessor (misalnya ambil nama tipe dari category → type)
    public function getTypeNameAttribute()
    {
        return $this->type ? $this->type->name : null;
    }
}
