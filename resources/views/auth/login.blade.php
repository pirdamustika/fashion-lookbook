<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Fashion Lookbook</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-100 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-sm border border-stone-200 p-8">
        <h1 class="text-2xl font-bold text-stone-900 mb-1">Admin Lookbook</h1>
        <p class="text-sm text-stone-500 mb-6">Masuk untuk mengelola koleksi dan katalog fashion.</p>

        @if ($errors->any())
            <div class="mb-4 p-3 rounded-lg bg-red-50 text-red-700 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
    @csrf
    <div>
        <label class="block text-sm font-medium text-stone-700 mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', 'pirdaadmin@lookbook.test') }}" required
               class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:outline-none focus:border-stone-900">
    </div>
    <div>
        <label class="block text-sm font-medium text-stone-700 mb-1">Password</label>
        <input type="password" name="password" placeholder="Masukkan password admin" required
               class="w-full rounded-lg border border-stone-300 px-3 py-2 text-sm focus:outline-none focus:border-stone-900">
    </div>
    <button type="submit" class="w-full bg-stone-900 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-stone-800">
        Masuk
    </button>
</form>

        <div class="mt-6 text-center">
            <a href="{{ route('lookbook.index') }}" class="text-xs text-stone-500 hover:text-stone-800">← Kembali ke Katalog Lookbook</a>
        </div>
    </div>
</body>
</html>