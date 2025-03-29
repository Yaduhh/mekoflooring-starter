<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory; 
    protected $fillable = [
        'title',
        'slug',
        'sinopsis',
        'content',
        'status',
        'deleted_status',
        'thumbnail',
    ];

    // Tentukan kolom yang harus di-cast
    protected $casts = [
        'deleted_status' => 'boolean',
    ];

    // Pengaturan untuk slug otomatis
    public function scopeNotDeleted($query)
    {
        return $query->where('deleted_status', false);
    }

    protected static function boot()
    {
        parent::boot();

        // Membuat slug otomatis berdasarkan title
        static::creating(function ($article) {
            $article->slug = \Str::slug($article->title);
        });
    }
}

