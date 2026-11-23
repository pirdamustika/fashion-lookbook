@extends('layouts.admin')
@section('title', 'Produk Lookbook')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold">Produk & Lookbook</h1>
        <p class="text-sm text-stone-500">Kelola item pakaian, bahan, ukuran, harga, dan foto lookbook.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="bg-stone-900 text-white px-4 py-2 rounded-lg text-sm hover:bg-stone-800">
        + Tambah Item
    </a>
</div>

<div class="bg-white rounded-xl border border-stone-200 overflow-x-auto">
    <table class="w-full text-sm text-left">
        <thead class="bg-stone-50 border-b border-stone-200 text-stone-600">
            <tr>
                <th class="py-3 px-4">Foto</th>
                <th class="py-3 px-4">Nama Item</th>
                <th class="py-3 px-4">Koleksi</th>
                <th class="py-3 px-4">Kategori & Warna</th>
                <th class="py-3 px-4">Size</th>
                <th class="py-3 px-4">Harga</th>
                <th class="py-3 px-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($products as $product)
                <tr>
                    <td class="py-3 px-4">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-14 object-cover rounded-lg">
                        @else
                            <div class="w-12 h-14 bg-stone-100 rounded-lg flex items-center justify-center text-xs text-stone-400">No Img</div>
                        @endif
                    </td>
                    <td class="py-3 px-4 font-medium">{{ $product->name }}</td>
                    <td class="py-3 px-4 text-stone-600">{{ $product->collection->name ?? '-' }}</td>
                    <td class="py-3 px-4 text-stone-600">{{ $product->category }} • {{ $product->color }}</td>
                    <td class="py-3 px-4">{{ $product->size }}</td>
                    <td class="py-3 px-4 font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="py-3 px-4 text-right space-x-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Hapus item ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-6 px-4 text-center text-stone-500">Belum ada produk lookbook.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection