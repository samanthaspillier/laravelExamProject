<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaqCategory;

class FaqCategoriesController extends Controller
{
   public function index()
    {
        $categories = FaqCategory::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.newCategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        FaqCategory::create($request->all());
        
        return redirect()->route('admin.categories')->with('success', 'Category created successfully.');
    }

    public function edit(FaqCategory $category)
    {
        return view('admin.categories.editCategory', compact('category'));
    }

    public function update(Request $request, FaqCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    public function destroy(FaqCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully.');
    }
}
