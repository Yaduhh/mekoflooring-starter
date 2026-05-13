<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('deleted_status', false)->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'sinopsis'  => 'required|string|max:500',
            'content'   => 'required|string',
            'status'    => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('thumbnails', 'public');
        }

        Article::create($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dibuat.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'sinopsis'  => 'required|string|max:500',
            'content'   => 'required|string',
            'status'    => 'required|in:draft,published',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('thumbnails', 'public');
        }

        $article->update($validated);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $article->update(['deleted_status' => true]);

        return redirect()->route('articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4048',
        ]);

        if ($request->hasFile('upload')) {
            $path = $request->file('upload')->store('articles', 'public');
            $url  = asset('storage/' . $path);

            return response()->json([
                'uploaded' => true,
                'url'      => $url,
            ]);
        }

        return response()->json([
            'uploaded' => false,
            'error'    => [
                'message' => 'Gagal mengunggah file.',
            ],
        ]);
    }

    public function removeImage(Request $request)
    {
        $request->validate([
            'image_url' => 'required|string',
        ]);

        $imagePath    = parse_url($request->image_url, PHP_URL_PATH);
        $relativePath = str_replace('/storage/', '', $imagePath);
        $filePath     = storage_path('app/public/' . $relativePath);

        if (file_exists($filePath)) {
            unlink($filePath);
            return response()->json([
                'message' => 'Gambar berhasil dihapus.',
            ], 200);
        }

        return response()->json([
            'error' => 'Gambar tidak ditemukan atau gagal dihapus.',
        ], 400);
    }
}
