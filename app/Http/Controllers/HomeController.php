<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::notDeleted()->paginate(10);
        return view('welcome', compact('products'));
    }

    public function show($slug)
    {
    $product = Product::where('slug_produk', $slug)->firstOrFail();
    return view('products.detail', compact('product'));
    }

}
