<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIRDA LOOKBOOK — Editorial Fashion & Digital Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,600&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        maroon: {
                            950: '#160608',
                            900: '#26090d',
                            800: '#3b0e14',
                            700: '#54141c',
                        },
                        blush: {
                            100: '#f4e3dc',
                            200: '#e8cbbd',
                            300: '#dfb5a5',
                        },
                        ink: '#0d0b0c',
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'Georgia', 'serif'],
                        editorial: ['"Cormorant Garamond"', 'Georgia', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        .editorial-title {
            letter-spacing: -0.03em;
            line-height: 0.92;
        }
    </style>
</head>
<body class="bg-ink text-blush-100 font-sans antialiased selection:bg-blush-300 selection:text-maroon-950">

    <!-- TOP BAR -->
    <header class="bg-maroon-950/95 backdrop-blur border-b border-blush-200/15 sticky top-0 z-50 pointer-events-auto">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 py-3.5 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-3 text-[11px] uppercase tracking-[0.22em] text-blush-200/80">
                <span>Editorial Lookbook</span>
                <span class="text-blush-300/50">•</span>
                <span class="hidden sm:inline">Curated Digital Catalog</span>
            </div>

            <div class="flex items-center gap-2.5 sm:gap-3 relative z-50">
                <a href="#catalog-section" class="text-xs uppercase tracking-[0.16em] px-3.5 py-2 rounded-full border border-blush-200/25 text-blush-100 hover:bg-blush-200 hover:text-maroon-950 transition">
                    Catalog
                </a>
                <button type="button" onclick="toggleSavedOnly()" id="savedBtn"
                        class="text-xs uppercase tracking-[0.16em] px-3.5 py-2 rounded-full border border-blush-300/40 text-blush-100 hover:bg-blush-300 hover:text-maroon-950 transition flex items-center gap-1.5">
                    <span>Saved Styles</span>
                    <span id="savedCount" class="px-1.5 py-0.5 text-[11px] rounded-full bg-blush-200/20 font-semibold">0</span>
                </button>
                <a href="{{ route('admin.products.index') }}"
                   class="relative z-50 pointer-events-auto text-xs uppercase tracking-[0.16em] px-4 py-2 rounded-full bg-blush-200 text-maroon-950 font-semibold hover:bg-blush-300 transition">
                    Admin Panel
                </a>
            </div>
        </div>
    </header>

    <!-- HERO EDITORIAL BANNER -->
    <section class="relative z-10 bg-gradient-to-b from-maroon-800 via-maroon-900 to-ink pt-6 pb-14 border-b border-blush-200/10 overflow-hidden">
        <div class="max-w-7xl mx-auto px-5 sm:px-8">
            <div class="text-center mb-6 sm:mb-8">
                <h1 class="font-display font-extrabold uppercase text-blush-200 editorial-title text-[clamp(3.3rem,11.5vw,9.2rem)] select-none">
                    LOOKBOOK
                </h1>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-4 space-y-4 text-center lg:text-left">
                    <p class="font-editorial italic text-xl sm:text-2xl text-blush-200/90">Curated by</p>
                    <h2 class="font-display uppercase text-3xl sm:text-5xl font-bold tracking-tight text-blush-100 leading-none">
                        PIRDA MUSTIKA
                    </h2>
                    <p class="text-xs uppercase tracking-[0.24em] text-blush-300 font-semibold pt-1">
                        Fashion Catalog &amp; Styling Archive
                    </p>
                    <p class="text-sm text-blush-100/75 max-w-md mx-auto lg:mx-0 leading-relaxed pt-1">
                        Eksplorasi koleksi busana pilihan dengan detail bahan, palet warna, ukuran, dan kurasi gaya favorit yang bisa kamu simpan langsung.
                    </p>
                    <div class="pt-2 flex flex-wrap justify-center lg:justify-start gap-3">
                        <a href="#catalog-section" class="px-5 py-2.5 rounded-full bg-blush-200 text-maroon-950 text-xs uppercase tracking-[0.18em] font-bold hover:bg-blush-300 transition">
                            Explore Looks ↓
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-4 flex justify-center">
                    <div class="w-full max-w-sm aspect-[3/4] rounded-2xl overflow-hidden border border-blush-200/25 bg-maroon-950 shadow-2xl relative group">
                        @if ($products->first() && $products->first()->image)
                            <img src="{{ asset('storage/' . $products->first()->image) }}" alt="{{ $products->first()->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center p-8 text-center bg-gradient-to-br from-maroon-800 to-maroon-950">
                                <span class="font-editorial italic text-3xl text-blush-200 mb-2">Atelier Edition</span>
                                <p class="text-xs uppercase tracking-[0.2em] text-blush-200/65">
                                    Tambahkan foto item di Admin Panel untuk menampilkan featured look
                                </p>
                            </div>
                        @endif
                        <div class="absolute inset-x-0 bottom-0 p-4 bg-gradient-to-t from-maroon-950 via-maroon-950/70 to-transparent">
                            <p class="text-[11px] uppercase tracking-[0.2em] text-blush-300">Featured Look</p>
                            <p class="font-display text-lg text-blush-100">
                                {{ $products->first()->name ?? 'Seasonal Capsule Collection' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 flex flex-col items-center lg:items-end text-center lg:text-right space-y-5">
                    <p class="font-editorial italic text-2xl sm:text-3xl text-blush-200 leading-snug max-w-xs">
                        Style that tells your story
                    </p>
                    <div class="space-y-1.5 text-xs uppercase tracking-[0.22em] text-blush-100/80 border-t border-b border-blush-200/20 py-4 w-full max-w-[220px]">
                        <p>Atasan</p>
                        <p>Bawahan</p>
                        <p>Outerwear</p>
                        <p>Dress</p>
                    </div>
                    <div class="w-16 h-16 rounded-full border border-blush-300/40 flex items-center justify-center text-[10px] uppercase tracking-[0.18em] text-blush-200 text-center leading-tight">
                        New<br>Season
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STRIP MAROON: CURATED LOOKS + FOTO EDITORIAL LAURA -->
    <section class="bg-gradient-to-b from-maroon-900/95 to-ink py-12 border-y border-blush-200/15">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 space-y-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <div class="lg:col-span-3 space-y-2">
                    <p class="text-[11px] uppercase tracking-[0.22em] text-blush-300">How To Explore</p>
                    <h2 class="font-display font-bold uppercase text-3xl sm:text-4xl leading-none text-blush-100">
                        CURATED<br>LOOKS
                    </h2>
                    <p class="text-xs text-blush-100/70 leading-relaxed pt-1">
                        Panduan singkat melihat detail outfit, menyaring koleksi, dan menyimpan gaya favoritmu.
                    </p>
                </div>

                <div class="lg:col-span-9 grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-5">
                    <div class="bg-maroon-950/85 border border-blush-200/15 rounded-xl p-4 hover:border-blush-300/40 transition">
                        <div class="h-20 rounded-lg bg-gradient-to-br from-maroon-700 to-maroon-950 border border-blush-200/10 flex items-end p-3 mb-3">
                            <span class="font-display text-lg font-bold text-blush-200">01</span>
                        </div>
                        <h3 class="text-xs font-bold uppercase tracking-[0.14em] text-blush-100">Detail Outfit</h3>
                        <p class="text-xs text-blush-100/70 mt-1 leading-relaxed">Cek warna, bahan, ukuran, dan harga tiap item.</p>
                    </div>

                    <div class="bg-maroon-950/85 border border-blush-200/15 rounded-xl p-4 hover:border-blush-300/40 transition">
                        <div class="h-20 rounded-lg bg-gradient-to-br from-maroon-800 to-maroon-950 border border-blush-200/10 flex items-end p-3 mb-3">
                            <span class="font-display text-lg font-bold text-blush-200">02</span>
                        </div>
                        <h3 class="text-xs font-bold uppercase tracking-[0.14em] text-blush-100">Filter Koleksi</h3>
                        <p class="text-xs text-blush-100/70 mt-1 leading-relaxed">Cari gaya berdasarkan nama, kategori, atau koleksi.</p>
                    </div>

                    <div class="bg-maroon-950/85 border border-blush-200/15 rounded-xl p-4 hover:border-blush-300/40 transition">
                        <div class="h-20 rounded-lg bg-gradient-to-br from-maroon-700/80 to-maroon-950 border border-blush-200/10 flex items-end p-3 mb-3">
                            <span class="font-display text-lg font-bold text-blush-200">03</span>
                        </div>
                        <h3 class="text-xs font-bold uppercase tracking-[0.14em] text-blush-100">Saved Styles</h3>
                        <p class="text-xs text-blush-100/70 mt-1 leading-relaxed">Klik "Simpan Gaya" lalu saring lewat tombol di atas.</p>
                    </div>

                    <div class="bg-maroon-950/85 border border-blush-200/15 rounded-xl p-4 hover:border-blush-300/40 transition">
                        <div class="h-20 rounded-lg bg-gradient-to-br from-maroon-800 to-maroon-950 border border-blush-200/10 flex items-end p-3 mb-3">
                            <span class="font-display text-lg font-bold text-blush-200">04</span>
                        </div>
                        <h3 class="text-xs font-bold uppercase tracking-[0.14em] text-blush-100">Kelola Katalog</h3>
                        <p class="text-xs text-blush-100/70 mt-1 leading-relaxed">Tambah atau edit item &amp; koleksi lewat Admin Panel.</p>
                    </div>
                </div>
            </div>

            <!-- BANNER FOTO LAURA -->
            <div class="relative rounded-2xl overflow-hidden border border-blush-200/20 bg-maroon-950 shadow-2xl">
                <div class="aspect-[16/9] sm:aspect-[21/9] w-full overflow-hidden">
                    <img src="{{ asset('images/laura.jpg') }}" alt="Editorial Lookbook Styling"
                         class="w-full h-full object-cover object-center grayscale contrast-110">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-maroon-950/90 via-maroon-950/45 to-transparent flex items-end sm:items-center p-6 sm:p-10">
                    <div class="max-w-md space-y-2">
                        <p class="text-[11px] uppercase tracking-[0.24em] text-blush-300">Editorial Mood</p>
                        <h3 class="font-display font-bold uppercase text-3xl sm:text-5xl text-blush-100 leading-none">
                            MONOCHROME<br><span class="font-editorial italic font-semibold text-blush-200 normal-case text-3xl sm:text-5xl">Effortless Edge</span>
                        </h3>
                        <p class="text-xs sm:text-sm text-blush-100/80 leading-relaxed pt-1">
                            Paduan siluet tegas dan nuansa gelap yang menyatu dengan palet katalog lookbook.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FILTER & KATALOG UTAMA LOOKBOOK -->
    <section id="catalog-section" class="max-w-7xl mx-auto px-5 sm:px-8 py-14">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <p class="text-xs uppercase tracking-[0.22em] text-blush-300 mb-1">Seasonal Archive</p>
                <h2 class="font-display font-bold uppercase text-3xl sm:text-5xl text-blush-100">
                    SELECTED LOOKS
                </h2>
            </div>
            <p class="text-xs uppercase tracking-[0.18em] text-blush-200/70">
                Showing {{ $products->count() }} Item(s)
            </p>
        </div>

        <form method="GET" action="{{ route('lookbook.index') }}#catalog-section"
              class="bg-maroon-900/80 border border-blush-200/15 rounded-2xl p-4 sm:p-5 mb-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama item atau warna..."
                   class="rounded-xl bg-maroon-950/90 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 placeholder-blush-200/45 focus:outline-none focus:border-blush-300">

            <select name="category"
                    class="rounded-xl bg-maroon-950/90 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 focus:outline-none focus:border-blush-300">
                <option value="">Semua Kategori</option>
                @foreach (['Atasan', 'Bawahan', 'Outerwear', 'Dress'] as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>

            <select name="collection_id"
                    class="rounded-xl bg-maroon-950/90 border border-blush-200/20 px-4 py-2.5 text-sm text-blush-100 focus:outline-none focus:border-blush-300">
                <option value="">Semua Koleksi</option>
                @foreach ($collections as $collection)
                    <option value="{{ $collection->id }}" {{ request('collection_id') == $collection->id ? 'selected' : '' }}>
                        {{ $collection->name }}
                    </option>
                @endforeach
            </select>

            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 rounded-xl bg-blush-200 text-maroon-950 font-semibold text-xs uppercase tracking-[0.16em] py-2.5 hover:bg-blush-300 transition">
                    Filter
                </button>
                <a href="{{ route('lookbook.index') }}#catalog-section"
                   class="px-4 py-2.5 rounded-xl border border-blush-200/25 text-xs uppercase tracking-[0.14em] text-blush-100 hover:bg-maroon-800 flex items-center transition">
                    Reset
                </a>
            </div>
        </form>

        <div id="catalogGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
            @forelse ($products as $product)
                <article class="lookbook-card bg-maroon-900/65 border border-blush-200/15 rounded-2xl overflow-hidden flex flex-col justify-between hover:border-blush-300/40 transition"
                         data-id="{{ $product->id }}">
                    <div>
                        <div class="aspect-[4/5] bg-maroon-950 overflow-hidden relative">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                     class="w-full h-full object-cover hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-blush-200/40 text-xs uppercase tracking-[0.2em] p-6 text-center">
                                    <span>Lookbook Image</span>
                                    <span class="mt-1 text-[11px] opacity-70">{{ $product->category }}</span>
                                </div>
                            @endif
                            <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-maroon-950/85 backdrop-blur text-[10px] uppercase tracking-[0.18em] text-blush-200 border border-blush-200/15">
                                {{ $product->collection->name ?? 'Collection' }}
                            </span>
                        </div>

                        <div class="p-5">
                            <div class="flex items-center justify-between text-[11px] uppercase tracking-[0.18em] text-blush-300 mb-1.5">
                                <span>{{ $product->category }}</span>
                                <span>Size {{ $product->size }}</span>
                            </div>

                            <h3 class="font-display text-2xl font-bold text-blush-100 leading-snug">
                                {{ $product->name }}
                            </h3>

                            <p class="text-base font-semibold text-blush-200 mt-1.5">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            <div class="mt-4 pt-3.5 border-t border-blush-200/10 text-xs text-blush-100/75 space-y-1.5">
                                <div class="flex justify-between">
                                    <span class="text-blush-200/60">Warna</span>
                                    <span class="font-medium text-blush-100">{{ $product->color }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blush-200/60">Bahan</span>
                                    <span class="font-medium text-blush-100">{{ $product->material ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 pb-5">
                        <button type="button" onclick="toggleSave({{ $product->id }})" id="save-btn-{{ $product->id }}"
                                class="w-full py-2.5 rounded-xl border border-blush-300/35 text-xs uppercase tracking-[0.16em] font-semibold text-blush-100 hover:bg-blush-200 hover:text-maroon-950 transition">
                            Simpan Gaya
                        </button>
                    </div>
                </article>
            @empty
                <div class="col-span-full bg-maroon-900/60 border border-blush-200/15 rounded-2xl p-12 text-center">
                    <p class="font-editorial italic text-2xl text-blush-200 mb-2">Belum ada item lookbook yang tampil</p>
                    <p class="text-sm text-blush-100/70 mb-5">
                        Masuk ke Admin Panel untuk menambahkan koleksi dan item katalog fashion kamu.
                    </p>
                    <a href="{{ route('admin.products.index') }}"
                       class="inline-block px-5 py-2.5 rounded-full bg-blush-200 text-maroon-950 text-xs uppercase tracking-[0.18em] font-bold hover:bg-blush-300 transition">
                        Buka Admin Panel
                    </a>
                </div>
            @endforelse
        </div>
    </section>

    <!-- BANNER PENUTUP & FOOTER -->
    <footer class="bg-gradient-to-t from-maroon-950 via-maroon-900 to-ink border-t border-blush-200/15 pt-12 pb-8">
        <div class="max-w-7xl mx-auto px-5 sm:px-8">
            <div class="bg-maroon-800/60 border border-blush-200/15 rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 mb-10">
                <div>
                    <h2 class="font-display font-bold uppercase text-2xl sm:text-4xl text-blush-100 leading-tight">
                        CURATE YOUR<br>OWN <span class="font-editorial italic font-semibold text-blush-200 normal-case text-3xl sm:text-5xl">Signature Look</span>
                    </h2>
                    <p class="text-xs sm:text-sm text-blush-100/75 mt-2 max-w-lg">
                        Kelola koleksi terbaru, perbarui stok lookbook, atau pantau data katalog melalui panel administrasi.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.products.index') }}"
                       class="px-5 py-2.5 rounded-full bg-blush-200 text-maroon-950 text-xs uppercase tracking-[0.18em] font-bold hover:bg-blush-300 transition">
                        Admin Dashboard
                    </a>
                    <a href="{{ url('/api/lookbooks') }}" target="_blank"
                       class="px-5 py-2.5 rounded-full border border-blush-200/30 text-xs uppercase tracking-[0.18em] text-blush-100 hover:bg-maroon-950 transition">
                        API Endpoint ↗
                    </a>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] uppercase tracking-[0.2em] text-blush-200/60 border-t border-blush-200/10 pt-6">
                <p>© 2026 PIRDA MUSTIKA — FASHION LOOKBOOK</p>
                <p>LARAVEL • TAILWIND CSS • EDITORIAL CATALOG</p>
            </div>
        </div>
    </footer>

    <script>
        const STORAGE_KEY = 'lookbook_saved_ids';
        let onlySaved = false;

        function getSaved() {
            return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
        }

        function setSaved(ids) {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(ids));
            renderSavedState();
        }

        function toggleSave(id) {
            const saved = getSaved();
            const idx = saved.indexOf(id);
            if (idx === -1) saved.push(id);
            else saved.splice(idx, 1);
            setSaved(saved);
        }

        function toggleSavedOnly() {
            onlySaved = !onlySaved;
            const btn = document.getElementById('savedBtn');
            btn.classList.toggle('bg-blush-200', onlySaved);
            btn.classList.toggle('text-maroon-950', onlySaved);
            btn.classList.toggle('font-semibold', onlySaved);
            renderSavedState();
        }

        function renderSavedState() {
            const saved = getSaved();
            document.getElementById('savedCount').textContent = saved.length;

            document.querySelectorAll('.lookbook-card').forEach(card => {
                const id = Number(card.dataset.id);
                const isSaved = saved.includes(id);
                const btn = document.getElementById('save-btn-' + id);
                if (btn) {
                    btn.textContent = isSaved ? '✓ Tersimpan di Gaya' : 'Simpan Gaya';
                    btn.classList.toggle('bg-blush-200', isSaved);
                    btn.classList.toggle('text-maroon-950', isSaved);
                    btn.classList.toggle('font-bold', isSaved);
                }
                card.style.display = (onlySaved && !isSaved) ? 'none' : '';
            });
        }

        renderSavedState();
    </script>
</body>
</html>