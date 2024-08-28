<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AdminProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }


    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        Cache::forget('summary');
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'is_active' => 'nullable|string',
            'is_featured' => 'nullable|string',
        ]);
        $validatedData['is_featured'] = $request->has('is_featured') ? true : false;
        $validatedData['is_active'] = $request->has('is_active') ? true : false;
        $validatedData['price'] = $validatedData['price'] * 100;

        $product = Product::create($validatedData);

        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');

            foreach ($photos as $index => $photo) {
                $photoPath = $photo->store('photos', 'public');

                $isMain = $index === 0;

                $product->photos()->create([
                    'href' => $photoPath,
                    'is_main' => $isMain,
                ]);
            }
        }

        return redirect()->route('products.show', $product)->with('success', 'Product created successfully!');
    }


    public function create()
    {
        Cache::forget('summary');
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', ['categories' => $categories]);
    }


    public function update(Request $request, Product $product)
    {
        Cache::forget('summary');
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'is_active' => 'nullable|string',
            'is_featured' => 'nullable|string',
        ]);
        $validatedData['is_featured'] = $request->has('is_featured') ? true : false;
        $validatedData['is_active'] = $request->has('is_active') ? true : false;
        $validatedData['price'] = $validatedData['price'] * 100;

        $product->update($validatedData);

        if ($request->has('delete_photos')) {
            foreach ($request->input('delete_photos') as $photoId) {
                $photo = $product->photos()->find($photoId);
                if ($photo) {
                    Storage::delete('public/' . $photo->href);

                    $photo->delete();
                }
            }
        }


        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('photos', 'public');

                $product->photos()->create([
                    'href' => $photoPath,
                    'is_main' => false,
                ]);
            }
        }


        if ($request->has('is_main')) {
            $mainPhotoId = $request->input('is_main');

            $product->photos()->where('is_main', true)->update(['is_main' => false]);
            $product->photos()->where('id', $mainPhotoId)->update(['is_main' => true]);
        }


        return redirect()->route('products.show', $product)->with('success', 'Product updated successfully!');
    }
}
