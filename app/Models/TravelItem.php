<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TravelItem extends Model
{
    // Mengizinkan mass-assignment untuk kolom berikut
    protected $fillable = [
        'category_id', 'name', 'slug', 'type', 'attributes', 
        'price', 'stock', 'is_active', 'description', 'image_url'
    ];

    // Otomatis ubah JSON ke Array dan tipe data lainnya
    protected $casts = [
        'attributes' => 'array',
        'is_active'  => 'boolean',
        'price'      => 'decimal:2',
    ];

    // Relasi: Setiap Item pasti punya satu Kategori
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}