<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = \App\Models\Category::all();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        \App\Models\Category::create($request->all());
        return back()->with('success', 'Kategori ditambah!');
    }

    public function destroy(\App\Models\Category $category)
    {
        $category->delete();
        return back()->with('success', 'Kategori dihapus!');
    }
}
