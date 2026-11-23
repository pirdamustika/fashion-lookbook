@extends('layouts.admin')
@section('title', 'Daftar Koleksi')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-bold">Koleksi Musiman</h1>
        <p class="text-sm text-stone-500">Kelola tema koleksi pakaian brand kamu.</p>
    </div>
    <a href="{{ route('admin.collections.create') }}" class="bg-stone-900 text-white px-4 py-2 rounded-lg text-sm hover:bg-stone-800">
        + Tambah Koleksi
    </a>
</div>

<div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-stone-50 border-b border-stone-200 text-stone-600">
            <tr>
                <th class="py-3 px-4">Nama Koleksi</th>
                <th class="py-3 px-4">Musim</th>
                <th class="py-3 px-4">Jumlah Item</th>
                <th class="py-3 px-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100">
            @forelse ($collections as $collection)
                <tr>
                    <td class="py-3 px-4 font-medium">{{ $collection->name }}</td>
                    <td class="py-3 px-4 text-stone-600">{{ $collection->season ?? '-' }}</td>
                    <td class="py-3 px-4">{{ $collection->products_count }} item</td>
                    <td class="py-3 px-4 text-right space-x-2">
                        <a href="{{ route('admin.collections.edit', $collection) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.collections.destroy', $collection) }}" method="POST" class="inline" onsubmit="return confirm('Hapus koleksi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="py-6 px-4 text-center text-stone-500">Belum ada koleksi. Klik "+ Tambah Koleksi" dulu ya.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection