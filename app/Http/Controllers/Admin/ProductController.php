<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::notDeleted()
            ->where('product_type', 0)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Display 2D accessories for homepage
     */
    public function aksesoris()
    {
        $products = Product::notDeleted()
            ->where('product_type', 1) // ← FILTER: Only 2D accessories
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('admin.products.aksesoris', compact('products'));
    }

    /**
     * Display complete door models
     */
    public function completeDoors()
    {
        $products = Product::notDeleted()
            ->where('product_type', 3) // ← FILTER: Only complete models
            ->with('category')
            ->orderBy('door_base_name')
            ->orderBy('handle_code')
            ->paginate(20);

        return view('admin.products.complete-doors', compact('products'));
    }
    /**
     * Recycle bin - ALL deleted products
     */
    public function recycle()
    {
        $products = Product::where('deleted_status', true)
            ->with('category')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.recycle.product', compact('products'));
    }

    /**
     * Show create form
     */
    public function create(Request $request)
    {
        $categories = Category::notDeleted()->get();

        // Determine which form based on product_type
        $productType = $request->get('product_type', 0);

        if ($productType == 3) {
            // Complete door model form
            return view('admin.products.create-complete', compact('categories'));
        }

        // Regular/Accessories form
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store new product
     */
    public function store(Request $request)
    {
        $productType = $request->input('product_type', 0);

        if ($productType == 3) {
            return $this->storeCompleteDoorModel($request);
        }

        return $this->storeRegularProduct($request);
    }

    /**
     * Store complete door model
     */
    protected function storeCompleteDoorModel(Request $request)
    {
        $validated = $request->validate([
            'id_category' => 'required|exists:categories,id',
            'door_base_name' => 'required|string|max:255',
            'handle_name' => 'required|string|max:255',
            'handle_code' => 'required|string|max:10',
            'complete_model_3d' => 'required|file|max:102400',
            'catalog_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'viewer_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'description' => 'nullable|string',
            'model_complexity' => 'required|in:low,medium,high',
            'status' => 'required|boolean',
        ]);

        $generated = Product::generateSlugAndName(
            $validated['door_base_name'],
            $validated['handle_name'],
            $validated['handle_code']
        );

        $product = new Product(array_merge($validated, $generated));
        $product->product_type = 3;
        $product->is_3d = true;

        // Upload 3D model - preserve original extension (.glb/.gltf)
        if ($request->hasFile('complete_model_3d')) {
            $file = $request->file('complete_model_3d');
            $extension = $file->getClientOriginalExtension() ?: 'glb';
            $filename = \Str::random(40) . '.' . $extension;
            $modelPath = $file->storeAs('models/complete-doors', $filename, 'public');
            $product->complete_model_3d = $modelPath;
            $product->model_file_size = $file->getSize();
        }

        // Upload catalog image
        if ($request->hasFile('catalog_image')) {
            $product->catalog_image = $request->file('catalog_image')
                ->store('images/catalog', 'public');
        }

        // Upload viewer thumbnail
        if ($request->hasFile('viewer_thumbnail')) {
            $product->viewer_thumbnail = $request->file('viewer_thumbnail')
                ->store('images/viewer-thumbnails', 'public');
        } else {
            $product->viewer_thumbnail = $product->catalog_image;
        }

        $product->save();

        // Update category product count
        $product->category->updateProductCount();

        return redirect()->route('admin.products.complete-doors')
            ->with('success', 'Complete door model created successfully.');
    }
    /**
     * Store regular product or 2D accessory
     */
    protected function storeRegularProduct(Request $request)
    {
        $productType = $request->input('product_type', 0);

        $rules = [
            'nama' => 'required|string|max:255',
            'slug_produk' => [
                'required',
                'string',
                Rule::unique('products', 'slug_produk')->where(function ($query) {
                    return $query->where('deleted_status', false);
                }),
            ],
            'product_type' => 'required|numeric',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
            'id_category' => 'nullable|exists:categories,id', // ← NULLABLE for regular products
            'image_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:6048',
            'mockup_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6048',
            'width' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'thickness' => 'nullable|numeric',
        ];

        $validated = $request->validate($rules);

        $product = new Product($validated);

        // Upload images
        if ($request->hasFile('image_produk')) {
            $imagePath = $request->file('image_produk')->store('images', 'public');
            $product->image_produk = $imagePath;
        }

        if ($request->hasFile('mockup_image')) {
            $mockupPath = $request->file('mockup_image')->store('images', 'public');
            $product->mockup_image = $mockupPath;
        }

        $product->save();

        // Redirect based on product type
        if ($product->product_type == 1) {
            return redirect()->route('admin.products.aksesoris')
                ->with('success', 'Accessory created successfully');
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::notDeleted()->get();

        if ($product->product_type == 3) {
            return view('admin.products.edit-complete', compact('product', 'categories'));
        }

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update product
     */
    public function update(Request $request, Product $product)
    {
        if ($product->product_type == 3) {
            return $this->updateCompleteDoorModel($request, $product);
        }

        return $this->updateRegularProduct($request, $product);
    }

    /**
     * Update complete door model
     */
    protected function updateCompleteDoorModel(Request $request, Product $product)
    {
        $validated = $request->validate([
            'id_category' => 'required|exists:categories,id',
            'door_base_name' => 'required|string|max:255',
            'handle_name' => 'required|string|max:255',
            'handle_code' => 'required|string|max:10',
            'complete_model_3d' => 'nullable|file|max:102400',
            'catalog_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'viewer_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'description' => 'nullable|string',
            'model_complexity' => 'required|in:low,medium,high',
            'status' => 'required|boolean',
        ]);

        // Regenerate name and slug
        $generated = Product::generateSlugAndName(
            $validated['door_base_name'],
            $validated['handle_name'],
            $validated['handle_code']
        );

        $product->update(array_merge($validated, $generated));

        // Update 3D model if uploaded
        if ($request->hasFile('complete_model_3d')) {
            if ($product->complete_model_3d) {
                Storage::disk('public')->delete($product->complete_model_3d);
            }

            $file = $request->file('complete_model_3d');
            $extension = $file->getClientOriginalExtension() ?: 'glb';
            $filename = \Str::random(40) . '.' . $extension;
            $modelPath = $file->storeAs('models/complete-doors', $filename, 'public');
            $product->complete_model_3d = $modelPath;
            $product->model_file_size = $file->getSize();
        }

        // Update images
        if ($request->hasFile('catalog_image')) {
            if ($product->catalog_image) {
                Storage::disk('public')->delete($product->catalog_image);
            }
            $product->catalog_image = $request->file('catalog_image')
                ->store('images/catalog', 'public');
        }

        if ($request->hasFile('viewer_thumbnail')) {
            if ($product->viewer_thumbnail && $product->viewer_thumbnail !== $product->catalog_image) {
                Storage::disk('public')->delete($product->viewer_thumbnail);
            }
            $product->viewer_thumbnail = $request->file('viewer_thumbnail')
                ->store('images/viewer-thumbnails', 'public');
        }

        $product->save();

        // Update category count
        $product->category->updateProductCount();

        return redirect()->route('admin.products.complete-doors')
            ->with('success', 'Complete door model updated successfully.');
    }

    /**
     * Update regular product or accessory
     */
    protected function updateRegularProduct(Request $request, Product $product)
    {
        $productType = $request->input('product_type');

        $rules = [
            'nama' => 'required|string|max:255',
            'slug_produk' => [
                'required',
                'string',
                Rule::unique('products', 'slug_produk')
                    ->where(function ($query) {
                        return $query->where('deleted_status', false);
                    })
                    ->ignore($product->id),
            ],
            'product_type' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'id_category' => 'nullable|exists:categories,id', // ← NULLABLE
            'image_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6048',
            'mockup_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6048',
            'width' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'thickness' => 'nullable|numeric',
        ];

        $request->validate($rules);

        // Update images
        if ($request->hasFile('image_produk')) {
            if ($product->image_produk) {
                Storage::disk('public')->delete($product->image_produk);
            }
            $imagePath = $request->file('image_produk')->store('images', 'public');
            $product->image_produk = $imagePath;
        }

        if ($request->hasFile('mockup_image')) {
            if ($product->mockup_image) {
                Storage::disk('public')->delete($product->mockup_image);
            }
            $mockupPath = $request->file('mockup_image')->store('images', 'public');
            $product->mockup_image = $mockupPath;
        }

        // Update other fields
        $product->update($request->except(['image_produk', 'mockup_image']));

        // Redirect based on product type
        if ($product->product_type == 1) {
            return redirect()->route('admin.products.aksesoris')
                ->with('success', 'Accessory updated successfully!');
        }

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Soft delete product
     */
    public function destroy(Request $request, Product $product)
    {
        try {
            $oldCategory = $product->category;

            $product->update(['deleted_status' => 1]);

            // Update category count if complete door model
            if ($product->product_type == 3 && $oldCategory) {
                $oldCategory->updateProductCount();
            }

            // Redirect based on product type
            if ($product->product_type == 1) {
                return redirect()->route('admin.products.aksesoris')
                    ->with('success', 'Accessory deleted.');
            } elseif ($product->product_type == 3) {
                return redirect()->route('admin.products.complete-doors')
                    ->with('success', 'Complete door model deleted.');
            }

            return redirect()->route('products.index')
                ->with('success', 'Product deleted.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete product.');
        }
    }

    /**
     * Restore deleted product
     */
    public function restore(Product $product)
    {
        $product->update(['deleted_status' => false]);

        // Update category count if complete door model
        if ($product->product_type == 3 && $product->category) {
            $product->category->updateProductCount();
        }

        return redirect()->route('admin.product.recycle')
            ->with('success', 'Product restored.');
    }
}
