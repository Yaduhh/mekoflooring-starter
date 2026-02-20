<?php
// app/Http/Controllers/DoorController.php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class DoorController extends Controller
{
    public function landing()
    {
        return view('door.doorView');
    }

    public function index()
    {
        $categories = Category::notDeleted()
            ->withCount(['completeModels'])
            ->having('complete_models_count', '>', 0)
            ->orderBy('name_category')
            ->get();

        return view('door.index', compact('categories'));
    }

    public function showCategory($categorySlug)
    {
        $category = Category::where('slug_category', $categorySlug)
            ->notDeleted()
            ->firstOrFail();

        // Get grouped models (grouped by door_base_name)
        $groupedModels = $category->getGroupedModels();

        // If no models, show empty state
        if ($groupedModels->isEmpty()) {
            return view('door.category', compact('category', 'groupedModels'));
        }

        return view('door.category', compact('category', 'groupedModels'));
    }

    /**
     * 3D Viewer - view specific complete model
     * URL: /doors/{category-slug}/{product-slug}
     */
    public function view($categorySlug, $productSlug)
    {
        // Get category first
        $category = Category::where('slug_category', $categorySlug)
            ->notDeleted()
            ->firstOrFail();

        // Get product in this category
        $product = Product::where('slug_produk', $productSlug)
            ->where('id_category', $category->id)
            ->completeDoors()
            ->notDeleted()
            ->where('status', 1)
            ->firstOrFail();

        // Get other handle variations for same door
        $handleVariations = $product->handleVariations();

        return view('door.viewer', compact('product', 'handleVariations'));
    }

    /**
     * API: Get model data for AJAX loading
     */
    public function getModelData($productId)
    {
        try {
            $product = Product::completeDoors()
                ->findOrFail($productId);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $product->id,
                    'name' => $product->nama,
                    'door_base' => $product->door_base_name,
                    'handle_name' => $product->handle_name,
                    'handle_code' => $product->handle_code,
                    'is_3d' => $product->is_3d,
                    'model_url' => $product->getModelUrl(),
                    'thumbnail' => $product->getViewerThumbnailUrl(),
                    'file_size' => $product->formatted_file_size,
                    'complexity' => $product->model_complexity,
                    'description' => $product->description,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Model not found'
            ], 404);
        }
    }

    /**
     * API: Get handle variations for door base
     */
    public function getHandleVariations($productId)
    {
        try {
            $product = Product::completeDoors()->findOrFail($productId);
            $variations = $product->handleVariations();

            return response()->json([
                'success' => true,
                'data' => $variations->map(function($variation) {
                    return [
                        'id' => $variation->id,
                        'name' => $variation->handle_name,
                        'code' => $variation->handle_code,
                        'slug' => $variation->slug_produk,
                        'category_slug' => $variation->category->slug_category,
                        'thumbnail' => $variation->getViewerThumbnailUrl(),
                        'file_size' => $variation->formatted_file_size,
                    ];
                })
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }
    }
}
