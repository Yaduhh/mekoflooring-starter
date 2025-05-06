<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Catalogue;
use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $productsSPC = Product::notDeleted()->where('product_type', 0)->get();
        $productsVinyl = Product::notDeleted()->where('product_type',10)->get();
        $articles = Article::notDeleted()->orderBy('created_at', 'desc')->paginate(4);
        return view('welcome', compact('productsSPC', 'productsVinyl', 'articles'));
    }

    public function showCatalogue()
    {
        $catalogueSPC = Catalogue::where('status_deleted', 0)->where('product_type', 0)->get();
        $catalogueVinyl = Catalogue::where('status_deleted', 0)->where('product_type', 1)->get();
        return view('catalogue.catalogue', compact('catalogueSPC', 'catalogueVinyl'));
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
