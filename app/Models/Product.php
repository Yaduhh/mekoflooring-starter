<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tentukan table yang digunakan
    protected $table = 'products';

    // Tentukan kolom yang dapat diisi (mass assignment)
    protected $fillable = [
        'nama',
        'image_produk',
        'slug_produk',
        'width',
        'thickness',
        'deleted_status',
        'status',
        'description',
        'mockup_image',
        'length', 
        'id_category',
    ];

    // Tentukan kolom yang harus di-cast
    protected $casts = [
        'deleted_status' => 'boolean',
    ];
    
    public function scopeNotDeleted($query)
    {
        return $query->where('deleted_status', false);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}