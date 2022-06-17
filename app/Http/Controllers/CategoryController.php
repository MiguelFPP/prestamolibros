<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(5);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());

        return redirect()->route('categories.index')->with('info', 'Categoría creada con éxito');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return back()->with('info', 'Categoría actualizada con éxito');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back()->with('info', 'Categoría eliminada con éxito');
    }
}
