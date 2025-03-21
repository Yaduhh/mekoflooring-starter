<?php

namespace App\Models;

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
    ];

    // Tentukan kolom yang harus di-cast
    protected $casts = [
        'deleted_status' => 'boolean', // memastikan deleted_status diperlakukan sebagai boolean
    ];

    // Soft delete menggunakan deleted_status
    public function scopeNotDeleted($query)
    {
        return $query->where('deleted_status', false);
    }
}