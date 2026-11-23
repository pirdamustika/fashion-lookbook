<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('collection')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $collections = Collection::all();
        return view('admin.products.create', compact('collections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'collection_id' => 'required|exists:collections,id',
            'name'          => 'required|string|max:150',
            'category'      => 'required|string|max:50',
            'color'         => 'required|string|max:50',
            'material'      => 'nullable|string|max:100',
            'size'          => 'required|string|max:20',
            'price'         => 'required|integer|min:0',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('lookbooks', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Item lookbook berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $collections = Collection::all();
        return view('admin.products.edit', compact('product', 'collections'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'collection_id' => 'required|exists:collections,id',
            'name'          => 'required|string|max:150',
            'category'      => 'required|string|max:50',
            'color'         => 'required|string|max:50',
            'material'      => 'nullable|string|max:100',
            'size'          => 'required|string|max:20',
            'price'         => 'required|integer|min:0',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('lookbooks', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Item lookbook berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Item lookbook berhasil dihapus.');
    }
}