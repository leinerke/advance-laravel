<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use http\Env\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return Category::all();
    }

    public function store(StoreCategoryRequest $request)
    {
        return Category::create($request->all());

    }

    public function show(Category $category)
    {
        return $category;
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json();
    }
}
