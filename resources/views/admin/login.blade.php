<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — PIRDA LOOKBOOK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: { 950: '#160608', 900: '#26090d', 800: '#3b0e14' },
                        blush: { 100: '#f4e3dc', 200: '#e8cbbd', 300: '#dfb5a5' },
                        ink: '#0d0b0c',
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-ink text-blush-100 font-sans antialiased min-h-screen flex items-center justify-center px-5 py-10">
    <div class="w-full max-w-md bg-maroon-900/80 border border-blush-200/20 rounded-2xl p-7 sm:p-8 shadow-2xl space-y-6">
        <div class="text-center space-y-1">
            <p class="text-[11px] uppercase tracking-[0.24em] text-blush-300">Pirda Lookbook</p>
            <h1 class="font-display text-3xl font-bold uppercase text-blush-100">Admin Login</h1>
            <p class="text-xs text-blush-200/70">Masuk untuk mengelola Catalog, Limited Edition, &amp; Model.</p>
        </div>

        @if (session('success'))
            <div class="rounded-xl bg-maroon-800 border border-blush-300/40 px-4 py-3 text-xs text-blush-100">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-xl bg-maroon-950 border border-red-400/50 px-4 py-3 text-xs text-blush-100">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs uppercase tracking-[0.16em] text-blush-200/80 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', 'pirdaadmin@lookbook.catalog') }}" required autofocus
                       placeholder="pirdaadmin@lookbook.catalog"
                       class="w-full rounded-xl bg-maroon-950 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/40 focus:outline-none focus:border-blush-300">
            </div>

            <div>
                <label class="block text-xs uppercase tracking-[0.16em] text-blush-200/80 mb-1.5">Password</label>
                <input type="password" name="password" required
                       placeholder="••••••••"
                       class="w-full rounded-xl bg-maroon-950 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/40 focus:outline-none focus:border-blush-300">
            </div>

            <label class="inline-flex items-center gap-2 text-xs text-blush-200/80 cursor-pointer">
                <input type="checkbox" name="remember" value="1" class="rounded border-blush-200/30 bg-maroon-950">
                <span>Ingat saya</span>
            </label>

            <button type="submit"
                    class="w-full py-3 rounded-xl bg-blush-200 text-maroon-950 text-xs font-bold uppercase tracking-[0.18em] hover:bg-blush-300 transition">
                Masuk ke Admin Panel
            </button>
        </form>

        <div class="pt-3 border-t border-blush-200/15 text-center">
            <a href="{{ url('/') }}" class="text-xs uppercase tracking-[0.16em] text-blush-200/75 hover:text-blush-100 transition">
                ← Kembali ke Lookbook Utama
            </a>
        </div>
    </div>
</body>
</html>