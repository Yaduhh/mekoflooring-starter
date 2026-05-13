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

    protected $casts = [
        'deleted_status' => 'boolean',
    ];

    public function scopeNotDeleted($query)
    {
        return $query->where('deleted_status', false);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            $article->slug = static::generateUniqueSlug($article->title);
        });

        static::updating(function ($article) {
            if ($article->isDirty('title')) {
                $article->slug = static::generateUniqueSlug($article->title, $article->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $baseSlug = \Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (true) {
            $query = static::withoutGlobalScopes()
                ->where('slug', $slug);

            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (!$query->exists()) {
                break;
            }

            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
