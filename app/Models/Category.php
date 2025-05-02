<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'slug_category',
        'name_category',
        'image_category',
        'image_product_category',
        'deleted_status',
    ];

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
