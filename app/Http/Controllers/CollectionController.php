<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::withCount('products')->latest()->get();
        return view('admin.collections.index', compact('collections'));
    }

    public function create()
    {
        return view('admin.collections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:120',
            'season'      => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        Collection::create($validated);

        return redirect()->route('admin.collections.index')->with('success', 'Koleksi berhasil ditambahkan.');
    }

    public function edit(Collection $collection)
    {
        return view('admin.collections.edit', compact('collection'));
    }

    public function update(Request $request, Collection $collection)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:120',
            'season'      => 'nullable|string|max:100',
            'description' => 'nullable|string',
        ]);

        $collection->update($validated);

        return redirect()->route('admin.collections.index')->with('success', 'Koleksi berhasil diperbarui.');
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();
        return redirect()->route('admin.collections.index')->with('success', 'Koleksi berhasil dihapus.');
    }
}