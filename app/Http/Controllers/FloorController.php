<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    public function index()
    {
        return view('floor.floorView');
    }

    public function show()
    {
        $categories = Category::notDeleted()->get();
        return view('floor.showFloor', compact('categories'));
    }
}
