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
        $articles = Article::notDeleted()->get();
        return view('welcome', compact('products', 'articles'));
    }

    public function show($slug)
    {
        $product = Product::where('slug_produk', $slug)->firstOrFail();
        return view('products.detail', compact('product'));
    }

}
