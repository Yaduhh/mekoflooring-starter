<?php
// app/Http/Controllers/Admin/CategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display all door type categories
     */
    public function index()
    {
        $categories = Category::notDeleted()
            ->withCount(['completeModels'])
            ->orderBy('name_category')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }
    /**
     * Show recycle bin
     */
    public function recycle()
    {
        $categories = Category::where('deleted_status', true)->get();
        return view('admin.recycle.category', compact('categories'));
    }
    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store new door type category
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_category' => 'required|string|max:255',
            'slug_category' => [
                'nullable',
                'string',
                Rule::unique('categories', 'slug_category')->where(function ($query) {
                    return $query->where('deleted_status', false);
                }),
            ],
            'image_category' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'description' => 'nullable|string',
        ]);

        // Auto-generate slug if empty
        if (empty($validated['slug_category'])) {
            $validated['slug_category'] = Str::slug($validated['name_category']);
        }

        $category = new Category($validated);

        // Upload door type image
        if ($request->hasFile('image_category')) {
            $imagePath = $request->file('image_category')
                ->store('categories/door-types', 'public');
            $category->image_category = $imagePath;
        }

        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Door type category created successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update door type category
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name_category' => 'required|string|max:255',
            'slug_category' => [
                'required',
                'string',
                Rule::unique('categories', 'slug_category')
                    ->where(function ($query) {
                        return $query->where('deleted_status', false);
                    })
                    ->ignore($category->id),
            ],
            'image_category' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        // Update image if uploaded
        if ($request->hasFile('image_category')) {
            // Delete old image
            if ($category->image_category) {
                Storage::disk('public')->delete($category->image_category);
            }

            $imagePath = $request->file('image_category')
                ->store('categories/door-types', 'public');
            $category->image_category = $imagePath;
            $category->save();
        }

        return redirect()->route('categories.index')
            ->with('success', 'Door type updated successfully.');
    }

    /**
     * Soft delete category
     */
    public function destroy(Category $category)
    {
        $category->update(['deleted_status' => true]);

        return redirect()->route('categories.index')
            ->with('success', 'Door type deleted.');
    }

    /**
     * Permanently delete category
     */
    public function delete(Category $category)
    {
        // Delete image
        if ($category->image_category) {
            Storage::disk('public')->delete($category->image_category);
        }

        $category->update(['deleted_status' => '2']);
        $category->save();

        return redirect()->route('admin.category.recycle')
            ->with('success', 'Door type permanently deleted.');
    }

    /**
     * Restore deleted category
     */
    public function restore(Category $category)
    {
        $category->update(['deleted_status' => false]);

        return redirect()->route('admin.category.recycle')
            ->with('success', 'Door type restored.');
    }
}
