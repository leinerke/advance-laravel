<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(StoreProductRequest $request)
    {
        return Product::create($request->all());
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json();
    }
}
