<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    /**
     * Menampilkan daftar katalog.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogues = Catalogue::where('status_deleted', 0)->paginate(8);

        return view('admin.catalogue.index', compact('catalogues'));
    }


    /**
     * Menampilkan formulir untuk membuat katalog baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catalogue.create');
    }

    /**
     * Menyimpan katalog baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'images' => 'required|image|mimes:jpeg,png,jpg,gif|max:6048',
            'kode_produk' => 'required|string',
            'status' => 'required|string',
            'deskripsi' => 'required|string',
            'views' => 'nullable|integer',
            'product_type' => 'required|integer',
        ]);

        $imagePath = $request->file('images')->store('catalogue', 'public');

        // Membuat katalog baru
        $catalogue = new Catalogue($validated);
        $catalogue->images = $imagePath; 
        $catalogue->status_deleted = 0;
        $catalogue->views = 0;

        $catalogue->save();

        return redirect()->route('admin.catalogue.index')->with('success', 'Catalogue created successfully.');
    }


    /**
     * Menampilkan formulir untuk mengedit katalog tertentu.
     *
     * @param  \App\Models\Catalogue  $catalogue
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalogue $catalogue)
    {
        return view('admin.catalogue.edit', compact('catalogue'));
    }

    /**
     * Memperbarui data katalog yang ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalogue  $catalogue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalogue $catalogue)
    {
        // Validasi input
        $validated = $request->validate([
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6048',  // Validasi untuk file gambar
            'kode_produk' => 'required|string',
            'status' => 'required|string',
            'deskripsi' => 'required|string',
            'views' => 'nullable|integer',
            'product_type' => 'required|integer',
        ]);

        // Memeriksa apakah ada file gambar yang diupload
        if ($request->hasFile('images')) {
            // Menghapus gambar lama jika ada
            if ($catalogue->images) {
                Storage::disk('public')->delete($catalogue->images);  // Menghapus gambar lama
            }

            // Menyimpan gambar baru
            $imagePath = $request->file('images')->store('catalogue', 'public');
            $catalogue->images = $imagePath;
        }

        // Memperbarui data katalog dengan data yang sudah tervalidasi
        $catalogue->update($validated);

        return redirect()->route('admin.catalogue.index')->with('success', 'Catalogue updated successfully.');
    }


    /**
     * Menghapus katalog yang dipilih.
     *
     * @param  \App\Models\Catalogue  $catalogue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalogue $catalogue)
    {
        // Menghapus katalog
        $catalogue->delete();

        return redirect()->route('admin.catalogue.index')->with('success', 'Catalogue deleted successfully.');
    }
}
