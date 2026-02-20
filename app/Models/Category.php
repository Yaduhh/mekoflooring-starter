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
        'description',
        'product_count',
        'deleted_status',
    ];

    protected $casts = [
        'deleted_status' => 'boolean',
        'product_count' => 'integer',
    ];

    // ========================================
    // SCOPES
    // ========================================

    public function scopeNotDeleted($query)
    {
        return $query->where('deleted_status', false);
    }

    // ========================================
    // RELATIONSHIPS
    // ========================================

    /**
     * All products in this category
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'id_category');
    }

    /**
     * Only complete door models (product_type = 3)
     */
    public function completeModels()
    {
        return $this->hasMany(Product::class, 'id_category')
            ->where('product_type', 3)
            ->where('status', 1)
            ->where('deleted_status', false);
    }

    /**
     * Only active complete door models
     */
    public function activeCompleteModels()
    {
        return $this->completeModels()
            ->where('status', 1);
    }

    // ========================================
    // HELPER METHODS
    // ========================================

    /**
     * Get complete door models grouped by door base name
     */
    public function getGroupedModels()
    {
        return $this->completeModels()
            ->orderBy('door_base_name')
            ->orderBy('handle_code')
            ->get()
            ->groupBy('door_base_name');
    }

    /**
     * Get all unique door bases in this category
     */
    public function doorBases()
    {
        return $this->completeModels()
            ->select('door_base_name')
            ->distinct()
            ->pluck('door_base_name');
    }

    /**
     * Update cached product count
     */
    public function updateProductCount()
    {
        $this->product_count = $this->completeModels()->count();
        $this->save();
    }
}
