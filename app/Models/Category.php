<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Tentukan nama tabel (optional jika nama tabel mengikuti konvensi)
    protected $table = 'categories';

    // Tentukan kolom yang dapat diisi (mass assignment)
    protected $fillable = [
        'slug_category',
        'name_category',
        'image_category',
        'deleted_status',
    ];

    // Tentukan kolom yang harus di-cast
    protected $casts = [
        'deleted_status' => 'boolean',
    ];

    public function scopeNotDeleted($query)
    {
        return $query->where('deleted_status', false);
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'id_category');
    }
}
