<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'category_id',
        'sub_category_id',
        'amount',
        'tanggal',
        'deskripsi'
    ];

     protected $casts = [
        'tanggal' => 'date', // otomatis jadi Carbon instance
    ];

    // Relasi ke Type
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke SubCategory
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}