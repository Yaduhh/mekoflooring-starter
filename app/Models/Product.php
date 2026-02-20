<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        // Common fields (all product types)
        'nama',
        'image_produk',
        'slug_produk',
        'deleted_status',
        'status',
        'description',
        'mockup_image',
        'product_type',
        'id_category',

        // For regular products & accessories (type 0, 1)
        'width',
        'thickness',
        'length',

        // For complete door models (type 3)
        'door_base_name',
        'handle_name',
        'handle_code',
        'catalog_image',
        'viewer_thumbnail',
        'complete_model_3d',
        'complete_model_2d',
        'is_3d',
        'thumbnail_3d',
        'model_file_size',
        'model_complexity',
    ];

    protected $casts = [
        'deleted_status' => 'boolean',
        'status' => 'boolean',
        'is_3d' => 'boolean',
        'model_file_size' => 'integer',
        'width' => 'float',
        'thickness' => 'float',
        'length' => 'float',
    ];

    protected $appends = ['formatted_file_size'];

    // ========================================
    // SCOPES
    // ========================================

    public function scopeNotDeleted($query)
    {
        return $query->where('deleted_status', false);
    }

    /**
     * Regular products (floors, general items)
     */
    public function scopeRegularProducts($query)
    {
        return $query->where('product_type', 0);
    }

    /**
     * 2D Accessories for homepage
     */
    public function scopeAccessories2D($query)
    {
        return $query->where('product_type', 1);
    }

    /**
     * Complete door models (door + handle combined)
     */
    public function scopeCompleteDoors($query)
    {
        return $query->where('product_type', 3);
    }

    // ========================================
    // RELATIONSHIPS
    // ========================================

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    // ========================================
    // COMPLETE DOOR MODEL METHODS
    // ========================================

    /**
     * Get all handle variations for the same door base
     * Only applies to product_type = 3
     */
    public function handleVariations()
    {
        if ($this->product_type !== 3) {
            return collect([]);
        }

        return self::where('door_base_name', $this->door_base_name)
            ->where('id_category', $this->id_category)
            ->where('product_type', 3)
            ->where('id', '!=', $this->id)
            ->notDeleted()
            ->where('status', 1)
            ->orderBy('handle_code')
            ->get();
    }

    /**
     * Check if this product has 3D model
     */
    public function has3DModel()
    {
        return $this->is_3d && !empty($this->complete_model_3d);
    }

    /**
     * Get 3D model URL
     */
    public function getModelUrl()
    {
        if (!$this->complete_model_3d) {
            return null;
        }
        return Storage::url($this->complete_model_3d);
    }

    // ========================================
    // IMAGE METHODS
    // ========================================

    /**
     * Get catalog image URL with fallback chain
     */
    public function getCatalogImageUrl()
    {
        // For accessories and regular products (type 0, 1)
        if ($this->product_type <= 1) {
            if ($this->image_produk) {
                return route('product.image', ['filename' => basename($this->image_produk)]);
            }
            if ($this->mockup_image) {
                return Storage::url($this->mockup_image);
            }
        }

        // For complete door models (type 3)
        if ($this->catalog_image) {
            return Storage::url($this->catalog_image);
        }
        if ($this->viewer_thumbnail) {
            return Storage::url($this->viewer_thumbnail);
        }
        if ($this->image_produk) {
            return route('product.image', ['filename' => basename($this->image_produk)]);
        }

        return asset('images/placeholder-door.png');
    }

    /**
     * Get viewer thumbnail URL with fallback
     */
    public function getViewerThumbnailUrl()
    {
        if ($this->viewer_thumbnail) {
            return Storage::url($this->viewer_thumbnail);
        }
        if ($this->catalog_image) {
            return Storage::url($this->catalog_image);
        }
        return $this->getCatalogImageUrl();
    }

    // ========================================
    // HELPER METHODS
    // ========================================

    /**
     * Get formatted file size
     */
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->model_file_size) {
            return 'Unknown';
        }

        $size = $this->model_file_size;
        $units = ['B', 'KB', 'MB', 'GB'];
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }

    /**
     * Generate automatic name and slug for complete door models
     */
    public static function generateSlugAndName($doorBase, $handleName, $handleCode)
    {
        $name = "{$doorBase} with {$handleName}";
        if ($handleCode) {
            $name .= " ({$handleCode})";
        }

        $slug = Str::slug($name);

        // Ensure uniqueness
        $count = 1;
        $originalSlug = $slug;
        while (self::where('slug_produk', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return [
            'nama' => $name,
            'slug_produk' => $slug,
        ];
    }
}
