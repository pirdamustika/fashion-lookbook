@extends('layouts.admin')
@section('title', 'Edit Koleksi')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Koleksi</h1>

<form action="{{ route('admin.collections.update', $collection) }}" method="POST" class="bg-white rounded-xl border border-stone-200 p-6 max-w-xl space-y-4">
    @csrf
    @method('PUT')
    <div>
        <label class="block text-sm font-medium mb-1">Nama Koleksi</label>
        <input type="text" name="name" value="{{ old('name', $collection->name) }}" required
               class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Musim / Tema</label>
        <input type="text" name="season" value="{{ old('season', $collection->season) }}"
               class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Deskripsi</label>
        <textarea name="description" rows="3" class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm">{{ old('description', $collection->description) }}</textarea>
    </div>
    <div class="flex gap-2">
        <button type="submit" class="bg-stone-900 text-white px-4 py-2 rounded-lg text-sm">Update</button>
        <a href="{{ route('admin.collections.index') }}" class="px-4 py-2 rounded-lg text-sm border border-stone-300">Batal</a>
    </div>
</form>
@endsection