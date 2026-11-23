<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Fashion Lookbook</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-100 text-stone-900 min-h-screen">
    <nav class="bg-white border-b border-stone-200 px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-6">
            <a href="{{ route('admin.products.index') }}" class="font-bold tracking-tight text-lg">LOOKBOOK ADMIN</a>
            <a href="{{ route('admin.collections.index') }}" class="text-sm text-stone-600 hover:text-stone-900">Koleksi</a>
            <a href="{{ route('admin.products.index') }}" class="text-sm text-stone-600 hover:text-stone-900">Produk Lookbook</a>
            <a href="{{ route('lookbook.index') }}" target="_blank" class="text-sm text-amber-700 hover:underline">Lihat Web Utama ↗</a>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-sm px-3 py-1.5 rounded-lg bg-stone-900 text-white hover:bg-stone-800">
                Logout
            </button>
        </form>
    </nav>

    <main class="max-w-6xl mx-auto p-6">
        @if (session('success'))
            <div class="mb-4 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>