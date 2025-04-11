<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // Menampilkan daftar artikel
    public function index()
    {
        $articles = Article::where('deleted_status', false)->get();
        return view('admin.articles.index', compact('articles'));
    }

    // Menampilkan form untuk membuat artikel baru
    public function create()
    {
        return view('admin.articles.create');
    }

    // Menyimpan artikel baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sinopsis' => 'required|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Generate slug otomatis
        $validated['slug'] = \Str::slug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public'); // Simpan di folder 'public/thumbnails'
            $validated['thumbnail'] = $thumbnailPath;
        }

        // Simpan artikel
        Article::create($validated);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dibuat.');
    }


    // Menampilkan form untuk mengedit artikel
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    // Menyimpan perubahan artikel
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'sinopsis' => 'required|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('thumbnail')) {
            // Hapus file thumbnail lama jika ada
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            // Upload thumbnail baru dan simpan path-nya
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $thumbnailPath;
        }

        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }


    public function destroy(Article $article)
    {
        $article->update(['deleted_status' => true]);

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }

     public function uploadImage(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4048',
        ]);

        // Simpan file jika valid
        if ($request->hasFile('upload')) {
            // Simpan ke folder "public/images"
            $path = $request->file('upload')->store('articles', 'public');

            // Generate URL untuk file
            $url = asset('storage/' . $path);

            // Kirim respons JSON ke CKEditor
            return response()->json([
                'uploaded' => true,
                'url' => $url,
            ]);
        }

        // Kalau file tidak ditemukan
        return response()->json([
            'uploaded' => false,
            'error' => [
                'message' => 'Gagal mengunggah file.',
            ],
        ]);
    }

    public function removeImage(Request $request)
    {
        $request->validate([
            'image_url' => 'required|string'
        ]);
    
        // Parse path dari URL
        $imagePath = parse_url($request->image_url, PHP_URL_PATH);
        $relativePath = str_replace('/storage/', '', $imagePath);
    
        // Hapus file jika ada
        $filePath = storage_path('app/public/' . $relativePath);
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file dari server
            return response()->json([
                'message' => 'Gambar berhasil dihapus.'
            ], 200);
        }
    
        return response()->json([
            'error' => 'Gambar tidak ditemukan atau gagal dihapus.'
        ], 400);
    }
}
