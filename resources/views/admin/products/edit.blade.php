@extends('layouts.admin')
@section('title', 'Edit Item Lookbook')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Item Lookbook</h1>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl border border-stone-200 p-6 max-w-2xl space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm font-medium mb-1">Koleksi</label>
        <select name="collection_id" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
            @foreach ($collections as $collection)
                <option value="{{ $collection->id }}" {{ old('collection_id', $product->collection_id) == $collection->id ? 'selected' : '' }}>
                    {{ $collection->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Nama Item</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                   class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Kategori</label>
            <select name="category" required class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
                @foreach (['Atasan', 'Bawahan', 'Outerwear', 'Dress'] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Warna</label>
            <input type="text" name="color" value="{{ old('color', $product->color) }}" required
                   class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Bahan</label>
            <input type="text" name="material" value="{{ old('material', $product->material) }}"
                   class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Ukuran</label>
            <input type="text" name="size" value="{{ old('size', $product->size) }}" required
                   class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Harga (Rp)</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" required
                   class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Ganti Foto Lookbook</label>
            <input type="file" name="image" accept="image/*" class="w-full text-sm">
        </div>
    </div>
    <div class="flex gap-2 pt-2">
        <button type="submit" class="bg-stone-900 text-white px-4 py-2 rounded-lg text-sm">Update</button>
        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded-lg text-sm border border-stone-300">Batal</a>
    </div>
</form>
@endsection