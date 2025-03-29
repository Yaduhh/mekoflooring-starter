<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $categories = Category::where('deleted_status', false)->get();
        return view('admin.categories.index', compact('categories'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'slug_category' => 'nullable|string|unique:categories,slug_category',
            'name_category' => 'required|string',
            'image_category' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Buat slug otomatis berdasarkan name_category jika slug_category tidak diberikan
        if (empty($request->slug_category)) {
            $validated['slug_category'] = Str::slug($request->name_category);
        }

        // Simpan kategori
        $category = new Category($validated);

        // Menyimpan gambar kategori jika ada
        if ($request->hasFile('image_category')) {
            $imagePath = $request->file('image_category')->store('category', 'public');
            $category->image_category = $imagePath;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dibuat.');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Mengupdate kategori
    public function update(Request $request, Category $category)
    {
        // Validasi input
        $request->validate([
            'slug_category' => 'required|string|unique:categories,slug_category,' . $category->id,
            'name_category' => 'required|string',
            'image_category' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category->update($request->only(['slug_category', 'name_category']));

        // Menyimpan gambar kategori jika ada
        if ($request->hasFile('image_category')) {
            $imagePath = $request->file('image_category')->store('category', 'public');
            $category->image_category = $imagePath;
        }

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // Menghapus kategori (mengubah deleted_status menjadi true)
    public function destroy(Category $category)
    {
        $category->update(['deleted_status' => true]);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
