<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::notDeleted()->get();
        $articles = Article::notDeleted()->paginate(4);
        return view('welcome', compact('products', 'articles'));
    }

    public function show($slug)
    {
        $product = Product::where('slug_produk', $slug)->firstOrFail();
        return view('products.detail', compact('product'));
    }

    public function showArticle($slug)
    {
        // Ambil artikel berdasarkan slug dengan status 'published' dan deleted_status 0
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->where('deleted_status', 0)
            ->firstOrFail();
            
        // Ambil artikel terkait berdasarkan kategori atau kriteria lainnya
        $relatedArticles = Article::where('status', 'published')
            ->where('deleted_status', 0)
            ->where('slug', '!=', $slug)
            ->limit(3)
            ->get();

        return view('articles.detail', compact('article', 'relatedArticles'));
    }
}
