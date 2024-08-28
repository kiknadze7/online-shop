<?php

namespace App\Http\Controllers;

use App\Models\Product;

class MainPageController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)->get();
        // dd($featuredProducts);

        $products = Product::where('is_active', true)->paginate(12);

        return view('index', [
            'featuredProducts' => $featuredProducts,
            'products' => $products,
        ]);
    }
}
