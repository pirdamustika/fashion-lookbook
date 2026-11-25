<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel — Catalog, Limited Edition & Model</title>
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
<body class="bg-ink text-blush-100 font-sans antialiased min-h-screen">
    <header class="bg-maroon-950 border-b border-blush-200/15 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 py-4 flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="text-[10px] uppercase tracking-[0.22em] text-blush-300">Admin Dashboard</p>
                <h1 class="font-display text-xl sm:text-2xl font-bold uppercase text-blush-200">
                    Catalog • Limited Edition • Model
                </h1>
            </div>
            <div class="flex flex-wrap items-center gap-2.5">
                <a href="#sec-catalog" class="px-3.5 py-2 rounded-full border border-blush-200/25 text-xs uppercase tracking-wider hover:bg-blush-200 hover:text-maroon-950 transition">
                    1. Catalog
                </a>
                <a href="#sec-limited" class="px-3.5 py-2 rounded-full border border-blush-200/25 text-xs uppercase tracking-wider hover:bg-blush-200 hover:text-maroon-950 transition">
                    2. Limited
                </a>
                <a href="#sec-model" class="px-3.5 py-2 rounded-full border border-blush-200/25 text-xs uppercase tracking-wider hover:bg-blush-200 hover:text-maroon-950 transition">
                    3. Model
                </a>
                <a href="{{ url('/') }}" class="px-4 py-2 rounded-full bg-blush-200 text-maroon-950 text-xs font-bold uppercase tracking-wider hover:bg-blush-300 transition">
                    Lihat Web
                </a>
                @auth
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-3.5 py-2 rounded-full border border-blush-200/30 text-xs uppercase tracking-wider text-blush-200 hover:bg-maroon-800 transition">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-5 sm:px-8 py-10 space-y-14">
        @if (session('success'))
            <div class="rounded-2xl bg-maroon-800 border border-blush-300/40 px-5 py-3.5 text-sm text-blush-100">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-2xl bg-maroon-900 border border-red-400/50 px-5 py-3.5 text-sm text-blush-100">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 1. TAMBAH & KELOLA CATALOG -->
        <section id="sec-catalog" class="bg-maroon-900/65 border border-blush-200/15 rounded-2xl p-6 space-y-6">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-blush-300">Bagian 1</p>
                <h2 class="font-display text-2xl sm:text-3xl font-bold uppercase text-blush-100">
                    Tambah Item Catalog
                </h2>
            </div>

            <form method="POST" action="{{ route('admin.catalog.store') }}" enctype="multipart/form-data"
                  class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 bg-maroon-950/80 border border-blush-200/15 rounded-2xl p-4">
                @csrf
                <input type="text" name="name" required placeholder="Nama baju..."
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45">

                <select name="category" class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100">
                    @foreach (['Atasan', 'Bawahan', 'Outerwear', 'Dress'] as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>

                <input type="number" name="price" required min="0" placeholder="Harga (contoh: 185000)..."
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45">

                <input type="text" name="size" placeholder="Ukuran (contoh: S, M, L, All Size)..."
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45">

                <input type="text" name="color" placeholder="Warna..."
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45">

                <input type="text" name="material" placeholder="Bahan..."
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45">

                <input type="file" name="image" accept="image/*" required
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-3 py-2 text-xs text-blush-100">

                <button type="submit"
                        class="rounded-xl bg-blush-200 text-maroon-950 font-bold text-xs uppercase tracking-wider py-2.5 hover:bg-blush-300 transition">
                    + Simpan ke Catalog
                </button>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($products as $product)
                    @php $isLim = !empty($product->is_limited); @endphp
                    <article class="bg-maroon-950/90 border border-blush-200/15 rounded-2xl overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="aspect-[4/5] bg-maroon-900 overflow-hidden relative">
                                @if (!empty($product->image))
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @endif
                                @if ($isLim)
                                    <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-blush-200 text-maroon-950 text-[10px] font-bold uppercase tracking-wider">
                                        Limited Edition
                                    </span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="font-display text-xl font-bold text-blush-100">{{ $product->name }}</h3>
                                <p class="text-xs text-blush-200/70 mt-1">Rp {{ number_format((float) ($product->price ?? 0), 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="px-4 pb-4 flex gap-2">
                            <form method="POST" action="{{ route('admin.features.toggle-limited', $product->id) }}" class="flex-1">
                                @csrf
                                <button type="submit"
                                        class="w-full py-2 rounded-xl text-[11px] font-bold uppercase tracking-wider border border-blush-300/35 hover:bg-maroon-800 transition">
                                    {{ $isLim ? '★ Lepas Limited' : '+ Limited' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.catalog.destroy', $product->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3.5 py-2 rounded-xl text-[11px] uppercase tracking-wider border border-blush-200/20 text-blush-200/80 hover:bg-maroon-800 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full text-sm text-blush-200/70">Belum ada item catalog.</p>
                @endforelse
            </div>
        </section>

        <!-- 2. TAMBAH FOTO & ITEM LIMITED EDITION -->
        <section id="sec-limited" class="bg-maroon-900/65 border border-blush-200/15 rounded-2xl p-6 space-y-6">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-blush-300">Bagian 2</p>
                <h2 class="font-display text-2xl sm:text-3xl font-bold uppercase text-blush-100">
                    Tambah Item Limited Edition
                </h2>
            </div>

            <form method="POST" action="{{ route('admin.limited.store') }}" enctype="multipart/form-data"
                  class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 bg-maroon-950/80 border border-blush-200/15 rounded-2xl p-4">
                @csrf
                <input type="text" name="name" required placeholder="Nama baju limited..."
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45">

                <select name="category" class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100">
                    @foreach (['Atasan', 'Bawahan', 'Outerwear', 'Dress'] as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>

                <input type="number" name="price" required min="0" placeholder="Harga..."
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45">

                <input type="text" name="size" placeholder="Ukuran..."
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45">

                <input type="text" name="color" placeholder="Warna..."
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45">

                <input type="text" name="material" placeholder="Bahan..."
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45">

                <input type="file" name="image" accept="image/*" required
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-3 py-2 text-xs text-blush-100">

                <button type="submit"
                        class="rounded-xl bg-blush-200 text-maroon-950 font-bold text-xs uppercase tracking-wider py-2.5 hover:bg-blush-300 transition">
                    + Simpan Limited Edition
                </button>
            </form>
        </section>

        <!-- 3. TAMBAH & KELOLA LIST MODEL -->
        <section id="sec-model" class="bg-maroon-900/65 border border-blush-200/15 rounded-2xl p-6 space-y-6">
            <div>
                <p class="text-xs uppercase tracking-[0.2em] text-blush-300">Bagian 3</p>
                <h2 class="font-display text-2xl sm:text-3xl font-bold uppercase text-blush-100">
                    Tambah Foto &amp; Data List Model
                </h2>
            </div>

            <form method="POST" action="{{ route('admin.models.store') }}" enctype="multipart/form-data"
                  class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-maroon-950/80 border border-blush-200/15 rounded-2xl p-4">
                @csrf
                <input type="text" name="name" required placeholder="Nama model..."
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45">
                <input type="text" name="detail" placeholder="Detail / tinggi / look..."
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45">
                <input type="file" name="image" accept="image/*" required
                       class="rounded-xl bg-maroon-900/80 border border-blush-200/20 px-3 py-2 text-xs text-blush-100">
                <button type="submit"
                        class="rounded-xl bg-blush-200 text-maroon-950 font-bold text-xs uppercase tracking-wider py-2.5 hover:bg-blush-300 transition">
                    + Tambah Model
                </button>
            </form>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @forelse ($models as $model)
                    <article class="bg-maroon-950/90 border border-blush-200/15 rounded-2xl overflow-hidden flex flex-col justify-between">
                        <div>
                            <div class="aspect-[4/5] bg-maroon-900 overflow-hidden">
                                @if ($model->image)
                                    <img src="{{ asset('storage/' . $model->image) }}" alt="{{ $model->name }}" class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="p-5">
                                <h3 class="font-display text-2xl font-bold text-blush-100">{{ $model->name }}</h3>
                                <p class="text-xs text-blush-200/75 mt-1">{{ $model->detail }}</p>
                            </div>
                        </div>
                        <div class="px-5 pb-5">
                            <form method="POST" action="{{ route('admin.models.destroy', $model->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="w-full py-2 rounded-xl border border-blush-200/25 text-xs uppercase tracking-wider text-blush-200 hover:bg-maroon-800 transition">
                                    Hapus Model
                                </button>
                            </form>
                        </div>
                    </article>
                @empty
                    <p class="col-span-full text-sm text-blush-200/70">Belum ada model yang ditambahkan.</p>
                @endforelse
            </div>
        </section>
    </main>
</body>
</html>