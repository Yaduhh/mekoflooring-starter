<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // Menampilkan semua kategori
    public function index()
    {
        $categories = Category::where('deleted_status', false)->get();
        return view('admin.categories.index', compact('categories'));
    }

    // Menampilkan semua kategori
    public function recycle()
    {
        $categories = Category::where('deleted_status', true)->get();
        return view('admin.recycle.category', compact('categories'));
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
            'image_category' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
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

    public function update(Request $request, Category $category)
    {
        // Validasi input
        $request->validate([
            'slug_category' => 'required|string|unique:categories,slug_category,' . $category->id,
            'name_category' => 'required|string',
            'image_category' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:9048',
        ]);

        // Update nama kategori dan slug
        $category->update($request->only(['slug_category', 'name_category']));

        // Menyimpan gambar kategori jika ada
        if ($request->hasFile('image_category')) {
            // Hapus gambar lama jika ada
            if ($category->image_category) {
                Storage::disk('public')->delete($category->image_category);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image_category')->store('category', 'public');
            $category->image_category = $imagePath;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }


    // Menghapus kategori (mengubah deleted_status menjadi true)
    public function destroy(Category $category)
    {
        $category->update(['deleted_status' => true]);
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }

    public function delete(Category $category)
    {
        $category->update(['deleted_status' => '2']);
        $category->save(); 
        return redirect()->route('admin.category.recycle')->with('success', 'Kategori berhasil dihapus.');
    }

    // Menambahkan fungsi untuk memulihkan kategori
    public function restore(Category $category)
    {
        // Mengubah status deleted_status menjadi false
        $category->update(['deleted_status' => false]);

        // Redirect ke halaman recycle kategori dengan pesan sukses
        return redirect()->route('admin.category.recycle')->with('success', 'Kategori berhasil dipulihkan.');
    }

}
