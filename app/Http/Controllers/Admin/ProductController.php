<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::notDeleted()->get();
        return view('products.index', compact('products'));
    }

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'image_produk' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'slug_produk' => 'required|string|unique:products',
            'width' => 'required|numeric',
            'thickness' => 'required|numeric',
            'status' => 'required|string',
            'description' => 'required|string',
        ]);

        // Upload image produk
        $imagePath = $request->file('image_produk')->store('public/images');

        // Simpan produk ke database
        Product::create([
            'nama' => $request->nama,
            'image_produk' => $imagePath,
            'slug_produk' => $request->slug_produk,
            'width' => $request->width,
            'thickness' => $request->thickness,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Menampilkan form untuk edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Mengupdate produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'image_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'slug_produk' => 'required|string|unique:products,slug_produk,' . $id,
            'width' => 'required|numeric',
            'thickness' => 'required|numeric',
            'status' => 'required|string',
            'description' => 'required|string',
        ]);

        $product = Product::findOrFail($id);

        // Upload image produk jika ada perubahan
        if ($request->hasFile('image_produk')) {
            $imagePath = $request->file('image_produk')->store('public/images');
            $product->image_produk = $imagePath;
        }

        // Update produk
        $product->update($request->only([
            'nama',
            'slug_produk',
            'width',
            'thickness',
            'status',
            'description',
        ]));

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Menghapus produk (soft delete)
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->update(['deleted_status' => true]);

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}