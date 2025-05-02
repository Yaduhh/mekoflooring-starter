<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model
    protected $table = 'catalogue';

    // Menentukan kolom mana saja yang dapat diisi mass-assignment
    protected $fillable = [
        'images',
        'kode_produk',
        'status',
        'status_deleted',
        'deskripsi',
        'views',
        'product_type',
    ];

    // Menentukan kolom yang harus di-cast
    protected $casts = [
        'status_deleted' => 'boolean',
        'views' => 'integer',
    ];

    // Menentukan kolom yang akan otomatis dikelola oleh Laravel
    public $timestamps = true;
}
