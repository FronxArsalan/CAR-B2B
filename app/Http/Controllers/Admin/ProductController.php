<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'size' => 'required',
            'type' => 'nullable',
            'season' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable',
        ]);

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'size' => 'required',
            'type' => 'nullable',
            'season' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
