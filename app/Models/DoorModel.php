<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DoorModel extends Model
{
    use HasFactory;

    protected $table = 'door_models';

    protected $fillable = [
        'door_type_id',
        'door_base_name',
        'handle_name',
        'handle_code',
        'slug',
        'catalog_image',
        'viewer_thumbnail',
        'model_file',
        'model_file_size',
        'model_complexity',
        'description',
        'status',
        'deleted_status',
    ];

    protected $casts = [
        'status'         => 'boolean',
        'deleted_status' => 'boolean',
        'model_file_size'=> 'integer',
    ];

    protected $appends = ['formatted_file_size'];

    // ========================================
    // SCOPES
    // ========================================

    public function scopeNotDeleted($query)
    {
        return $query->where('deleted_status', false);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true)->where('deleted_status', false);
    }

    // ========================================
    // RELATIONSHIPS
    // ========================================

    public function doorType()
    {
        return $this->belongsTo(DoorType::class, 'door_type_id');
    }

    // ========================================
    // HANDLE VARIATIONS
    // ========================================

    /**
     * Other handle variations for the same door base within the same door type
     */
    public function handleVariations()
    {
        return self::where('door_type_id', $this->door_type_id)
            ->where('door_base_name', $this->door_base_name)
            ->where('id', '!=', $this->id)
            ->active()
            ->orderBy('handle_code')
            ->get();
    }

    // ========================================
    // URL / IMAGE HELPERS
    // ========================================

    public function getModelUrl()
    {
        if (!$this->model_file) return null;
        return Storage::url($this->model_file);
    }

    public function getCatalogImageUrl()
    {
        if ($this->catalog_image) return Storage::url($this->catalog_image);
        if ($this->viewer_thumbnail) return Storage::url($this->viewer_thumbnail);
        return asset('images/placeholder-door.png');
    }

    public function getViewerThumbnailUrl()
    {
        if ($this->viewer_thumbnail) return Storage::url($this->viewer_thumbnail);
        if ($this->catalog_image) return Storage::url($this->catalog_image);
        return asset('images/placeholder-door.png');
    }

    // ========================================
    // COMPUTED ATTRIBUTES
    // ========================================

    public function getFormattedFileSizeAttribute()
    {
        if (!$this->model_file_size) return 'Unknown';

        $size  = $this->model_file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        $unit  = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }

    // ========================================
    // STATIC HELPERS
    // ========================================

    /**
     * Auto-generate slug from door base + handle name + handle code
     */
    public static function generateSlug($doorBase, $handleName, $handleCode)
    {
        $base  = Str::slug("{$doorBase} {$handleName} {$handleCode}");
        $slug  = $base;
        $count = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $count++;
        }

        return $slug;
    }
}
