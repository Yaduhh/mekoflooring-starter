<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::notDeleted()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        $categories = Category::where('deleted_status', false)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'slug_produk' => 'required|string|unique:products,slug_produk',
            'image_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mockup_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_category' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'width' => 'required|numeric',
            'length' => 'required|numeric',
            'thickness' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        // Menyimpan data produk
        $product = new Product($validated);

        // Memeriksa apakah ada file gambar yang diupload
        if ($request->hasFile('image_produk')) {
            $imagePath = $request->file('image_produk')->store('images');
            $product->image_produk = $imagePath;
        }
        
        if ($request->hasFile('mockup_image')) {
            $mockupPath = $request->file('mockup_image')->store('images', 'public');
            $product->mockup_image = $mockupPath;
        }

        // Menyimpan produk ke database
        $product->save();

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil dibuat');
    }

    // Menampilkan form untuk edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('deleted_status', false)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'slug_produk' => 'required|string|max:255',
            'id_category' => 'required|exists:categories,id',
            'image_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mockup_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'width' => 'required|numeric',
            'length' => 'required|numeric',
            'thickness' => 'required|numeric',
            'description' => 'required|string',
            'status' => 'required|boolean',
        ]);

        // Hapus gambar lama jika ada dan gambar baru diupload
        if ($request->hasFile('image_produk')) {
            // Hapus gambar lama
            if ($product->image_produk) {
                Storage::disk('public')->delete($product->image_produk);
            }

            // Upload gambar baru
            $imagePath = $request->file('image_produk')->store('images');
            $product->image_produk = $imagePath;
        }

        // Hapus mockup gambar lama jika ada dan gambar baru diupload
        if ($request->hasFile('mockup_image')) {
            // Hapus gambar lama
            if ($product->mockup_image) {
                Storage::disk('public')->delete($product->mockup_image);
            }

            // Upload mockup gambar baru
            $mockupPath = $request->file('mockup_image')->store('category', 'public');
            $product->mockup_image = $mockupPath;
        }

        // Update data produk lainnya
        $product->update($request->except(['image_produk', 'mockup_image']));

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }


    // Menghapus produk (soft delete)
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['deleted_status' => true]);

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}