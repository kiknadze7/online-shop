<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class AdminCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'is_active' => 'nullable|string',
            Rule::unique('categories', 'title'),
        ]);


        if (Category::where('title', $request->input('title'))->exists()) {
            return redirect()->back()->withErrors(['title' => 'მსგავსი სახელის კატეგორია უკვე არსებობს.'])->withInput();
        }


        $isActive = $request->has('is_active') ? true : false;

        Category::create([
            'title' => $request->input('title'),
            'is_active' => $isActive,
        ]);

        return redirect()->route('categories.index')->with('success', 'წარმატებით შეიქმნა.');
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        Cache::forget('summary');
        $request->validate([
            'title' => 'required|string|max:255',
            'is_active' => 'nullable|string',
        ]);

        $exists = Category::where('title', $request->input('title'))
            ->where('id', '!=', $category->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['title' => 'მსგავსი სახელის კატეგორია უკვე არსებობს.'])->withInput();
        }

        $isActive = $request->has('is_active') ? true : false;

        $category->update([
            'title' => $request->input('title'),
            'is_active' => $isActive,
        ]);

        return redirect()->route('categories.index')->with('success', 'კატეგორია წარმატებით დაედითდა.');
    }
}
