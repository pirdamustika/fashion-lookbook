<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PIRDA LOOKBOOK — Editorial Digital Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
<body class="bg-ink text-blush-100 font-sans antialiased">
    @php
        $allProducts = $products ?? collect();
        $regularProducts = $allProducts->filter(function ($item) {
            return (int) ($item->is_limited ?? 0) !== 1;
        })->values();
        $limitedProducts = $allProducts->filter(function ($item) {
            return (int) ($item->is_limited ?? 0) === 1;
        })->values();
        $modelList = $models ?? collect();
        $collectionList = $collections ?? collect();
        $featuredLook = $regularProducts->first() ?? $allProducts->first();
    @endphp

    <!-- Top Bar Navigation -->
    <header class="bg-maroon-950/95 border-b border-blush-200/15 sticky top-0 z-30 backdrop-blur">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 py-3.5 flex flex-col gap-2.5">
            <p class="text-[10px] uppercase tracking-[0.26em] text-blush-300/80 text-center sm:text-left">
                Editorial Lookbook • Curated Digital Catalog
            </p>
            <nav class="flex flex-wrap items-center justify-between gap-2">
                <div class="flex flex-wrap items-center gap-2">
                    <a href="#catalog-section"
                       class="px-3.5 py-1.5 rounded-full border border-blush-200/25 text-[11px] font-semibold uppercase tracking-[0.16em] text-blush-100 hover:bg-blush-200 hover:text-maroon-950 transition">
                        Catalog
                    </a>
                    <button type="button" onclick="toggleFeatureSection('model')"
                            class="px-3.5 py-1.5 rounded-full border border-blush-200/25 text-[11px] font-semibold uppercase tracking-[0.16em] text-blush-100 hover:bg-blush-200 hover:text-maroon-950 transition">
                        List Model
                    </button>
                    <a href="#contact-section"
                       class="px-3.5 py-1.5 rounded-full border border-blush-200/25 text-[11px] font-semibold uppercase tracking-[0.16em] text-blush-100 hover:bg-blush-200 hover:text-maroon-950 transition">
                        Hubungi
                    </a>
                    <span class="px-3.5 py-1.5 rounded-full border border-blush-200/20 text-[11px] font-semibold uppercase tracking-[0.16em] text-blush-200/80">
                        Saved Styles <span id="saved-count-badge" class="ml-1 text-blush-300">0</span>
                    </span>
                    <button type="button" onclick="toggleFeatureSection('limited')"
                            class="px-3.5 py-1.5 rounded-full border border-blush-200/25 text-[11px] font-semibold uppercase tracking-[0.16em] text-blush-100 hover:bg-blush-200 hover:text-maroon-950 transition">
                        Limited &amp; Model
                    </button>
                </div>

                <a href="{{ route('admin.products.index') }}"
                   class="px-4 py-1.5 rounded-full bg-blush-200 text-maroon-950 text-[11px] font-bold uppercase tracking-[0.16em] hover:bg-blush-300 transition">
                    Admin Panel
                </a>
            </nav>
        </div>
    </header>

    <!-- HERO EDITORIAL SECTION -->
    <section class="bg-maroon-900 border-b border-blush-200/15 py-10 sm:py-14">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 space-y-8">
            <h1 class="font-display text-5xl sm:text-7xl lg:text-8xl font-bold uppercase tracking-tight text-center text-blush-100">
                LOOKBOOK
            </h1>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <!-- Kiri: Curated by PIRDA MUSTIKA -->
                <div class="lg:col-span-4 space-y-3">
                    <p class="font-display italic text-lg sm:text-xl text-blush-200/85">
                        Curated by
                    </p>
                    <h2 class="font-display text-3xl sm:text-4xl font-bold uppercase leading-tight text-blush-100">
                        PIRDA MUSTIKA
                    </h2>
                    <p class="text-[11px] uppercase tracking-[0.22em] text-blush-300/80">
                        Fashion Catalog &amp; Styling Archive
                    </p>
                    <p class="text-xs sm:text-sm text-blush-200/75 leading-relaxed max-w-sm">
                        Eksplorasi koleksi busana pilihan dengan detail bahan, palet warna, ukuran, dan kurasi gaya favorit yang bisa kamu simpan langsung.
                    </p>
                    <div class="pt-2">
                        <a href="#catalog-section"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-blush-200 text-maroon-950 text-[11px] font-bold uppercase tracking-[0.18em] hover:bg-blush-300 transition">
                            Explore Looks ↓
                        </a>
                    </div>
                </div>

                <!-- Tengah: Featured Look Photo -->
                <div class="lg:col-span-4 flex justify-center">
                    <div class="w-full max-w-sm aspect-[4/5] rounded-2xl overflow-hidden border border-blush-200/20 bg-maroon-950 shadow-2xl relative">
                        @if ($featuredLook && !empty($featuredLook->image))
                            <img src="{{ asset('storage/' . $featuredLook->image) }}" alt="{{ $featuredLook->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-xs uppercase tracking-[0.2em] text-blush-200/50">
                                Featured Look
                            </div>
                        @endif
                        <div class="absolute inset-x-0 bottom-0 p-4 bg-gradient-to-t from-maroon-950/90 via-maroon-950/40 to-transparent">
                            <p class="text-[10px] uppercase tracking-[0.2em] text-blush-300">Featured Look</p>
                            <p class="font-display text-xl font-bold text-blush-100">
                                {{ $featuredLook->name ?? 'Signature Editorial' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Style that tells your story -->
                <div class="lg:col-span-4 flex flex-col lg:items-end text-left lg:text-right space-y-4">
                    <p class="font-display italic text-xl sm:text-2xl text-blush-200/90">
                        Style that tells your story
                    </p>
                    <ul class="space-y-1 text-xs uppercase tracking-[0.22em] text-blush-200/75">
                        <li><a href="{{ route('lookbook.home', ['category' => 'Atasan']) }}#catalog-section" class="hover:text-blush-100 transition">Atasan</a></li>
                        <li><a href="{{ route('lookbook.home', ['category' => 'Bawahan']) }}#catalog-section" class="hover:text-blush-100 transition">Bawahan</a></li>
                        <li><a href="{{ route('lookbook.home', ['category' => 'Outerwear']) }}#catalog-section" class="hover:text-blush-100 transition">Outerwear</a></li>
                        <li><a href="{{ route('lookbook.home', ['category' => 'Dress']) }}#catalog-section" class="hover:text-blush-100 transition">Dress</a></li>
                    </ul>
                    <div class="w-16 h-16 rounded-full border border-blush-200/30 flex items-center justify-center text-[10px] uppercase tracking-[0.18em] text-blush-200/80 text-center leading-tight">
                        New<br>Season
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-5 sm:px-8 py-10 space-y-12">
        <!-- HOW TO EXPLORE / CURATED STRIP -->
        <section class="space-y-4">
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-[10px] uppercase tracking-[0.24em] text-blush-300/80">How to Explore</p>
                    <h2 class="font-display text-3xl sm:text-4xl font-bold uppercase text-blush-100">CURATED</h2>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <a href="#catalog-section" class="group bg-maroon-900/75 border border-blush-200/15 rounded-2xl p-4 hover:border-blush-200/40 transition">
                    <p class="text-[10px] uppercase tracking-[0.2em] text-blush-300">01 • Catalog</p>
                    <p class="font-display text-lg font-bold text-blush-100 mt-1">All Styles</p>
                </a>
                <button type="button" onclick="toggleFeatureSection('limited')" class="text-left group bg-maroon-900/75 border border-blush-200/15 rounded-2xl p-4 hover:border-blush-200/40 transition">
                    <p class="text-[10px] uppercase tracking-[0.2em] text-blush-300">02 • Exclusive</p>
                    <p class="font-display text-lg font-bold text-blush-100 mt-1">Limited Edition</p>
                </button>
                <button type="button" onclick="toggleFeatureSection('model')" class="text-left group bg-maroon-900/75 border border-blush-200/15 rounded-2xl p-4 hover:border-blush-200/40 transition">
                    <p class="text-[10px] uppercase tracking-[0.2em] text-blush-300">03 • Talent</p>
                    <p class="font-display text-lg font-bold text-blush-100 mt-1">List Model</p>
                </button>
                <a href="#contact-section" class="group bg-maroon-900/75 border border-blush-200/15 rounded-2xl p-4 hover:border-blush-200/40 transition">
                    <p class="text-[10px] uppercase tracking-[0.2em] text-blush-300">04 • Order</p>
                    <p class="font-display text-lg font-bold text-blush-100 mt-1">Hubungi Kami</p>
                </a>
            </div>
        </section>

        <!-- Filter & Feature Switcher Bar -->
        <section class="bg-maroon-900/75 border border-blush-200/15 rounded-2xl p-4 sm:p-5">
            <form method="GET" action="{{ route('lookbook.home') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 items-center">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama baju atau warna..."
                       class="lg:col-span-3 rounded-xl bg-maroon-950 border border-blush-200/20 px-4 py-2.5 text-xs text-blush-100 placeholder-blush-200/45 focus:outline-none focus:border-blush-300">

                <select name="category"
                        class="lg:col-span-2 rounded-xl bg-maroon-950 border border-blush-200/20 px-3.5 py-2.5 text-xs text-blush-100 focus:outline-none focus:border-blush-300">
                    <option value="">Semua Kategori</option>
                    @foreach (['Atasan', 'Bawahan', 'Outerwear', 'Dress'] as $cat)
                        <option value="{{ $cat }}" @selected(request('category') === $cat)>{{ $cat }}</option>
                    @endforeach
                </select>

                <select name="collection_id"
                        class="lg:col-span-2 rounded-xl bg-maroon-950 border border-blush-200/20 px-3.5 py-2.5 text-xs text-blush-100 focus:outline-none focus:border-blush-300">
                    <option value="">Semua Koleksi</option>
                    @foreach ($collectionList as $col)
                        <option value="{{ $col->id }}" @selected((string) request('collection_id') === (string) $col->id)>{{ $col->name }}</option>
                    @endforeach
                </select>

                <button type="button" id="btn-toggle-limited" onclick="toggleFeatureSection('limited')"
                        class="lg:col-span-2 rounded-xl bg-blush-200 text-maroon-950 font-bold text-[11px] uppercase tracking-[0.14em] py-2.5 px-3 hover:bg-blush-300 transition">
                    ★ Limited Edition
                </button>

                <button type="button" id="btn-toggle-model" onclick="toggleFeatureSection('model')"
                        class="lg:col-span-1 rounded-xl border border-blush-200/30 bg-maroon-950 text-blush-100 font-semibold text-[11px] uppercase tracking-[0.12em] py-2.5 px-2 hover:bg-maroon-800 transition">
                    List Model
                </button>

                <button type="submit"
                        class="lg:col-span-1 rounded-xl bg-blush-200 text-maroon-950 font-bold text-[11px] uppercase tracking-[0.14em] py-2.5 px-2 hover:bg-blush-300 transition">
                    Filter
                </button>

                <a href="{{ route('lookbook.home') }}"
                   class="lg:col-span-1 text-center rounded-xl border border-blush-200/25 bg-maroon-950 text-blush-200 text-[11px] uppercase tracking-[0.12em] py-2.5 px-2 hover:bg-maroon-800 transition">
                    Reset
                </a>
            </form>
        </section>

        <!-- CATALOG (Ada Rating Bintang Interaktif Khusus Catalog) -->
        <section id="catalog-section" class="space-y-6">
            <div class="flex flex-wrap items-end justify-between gap-2">
                <div>
                    <p class="text-[11px] uppercase tracking-[0.22em] text-blush-300">Curated Collection</p>
                    <h2 class="font-display text-3xl sm:text-4xl font-bold uppercase text-blush-100">Catalog</h2>
                </div>
                <span class="text-xs uppercase tracking-[0.18em] text-blush-200/70">
                    Showing {{ $regularProducts->count() }} Item(s)
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @forelse ($regularProducts as $product)
                    @php
                        $colName = optional($product->collection)->name ?? 'General';
                        $catName = strtoupper($product->category ?? 'ATASAN');
                        $sizeName = strtoupper($product->size ?? 'ALL SIZE');
                        $colorName = strtolower($product->color ?? '-');
                        $materialName = strtolower($product->material ?? '-');
                    @endphp
                    <article class="bg-maroon-900/85 border border-blush-200/15 rounded-2xl overflow-hidden flex flex-col justify-between shadow-xl">
                        <div>
                            <div class="aspect-[4/5] bg-maroon-950 overflow-hidden relative">
                                @if (!empty($product->image))
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                                @endif
                                <span class="absolute top-3.5 left-3.5 px-3 py-1 rounded-full bg-maroon-950/90 border border-blush-200/25 text-[10px] font-bold uppercase tracking-[0.18em] text-blush-200">
                                    {{ strtoupper($colName) }}
                                </span>
                            </div>

                            <div class="p-5 space-y-3">
                                <div class="flex items-center justify-between text-[11px] uppercase tracking-[0.16em] text-blush-200/70">
                                    <span>{{ $catName }}</span>
                                    <span>Size {{ $sizeName }}</span>
                                </div>

                                <h3 class="font-display text-2xl font-bold uppercase text-blush-100">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-lg font-semibold text-blush-200">
                                    Rp {{ number_format((float) ($product->price ?? 0), 0, ',', '.') }}
                                </p>

                                <!-- Rating khusus Catalog -->
                                <div class="flex items-center justify-between pt-1">
                                    <div class="flex items-center gap-1" data-rating-stars="{{ $product->id }}">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <button type="button"
                                                    onclick="setCatalogRating({{ $product->id }}, {{ $i }})"
                                                    aria-label="Beri rating {{ $i }} bintang"
                                                    class="star-btn text-base leading-none text-blush-200/30 hover:text-blush-200 transition">
                                                ★
                                            </button>
                                        @endfor
                                    </div>
                                    <span id="rating-label-{{ $product->id }}" class="text-[11px] text-blush-200/75">
                                        ★ 0.0 (0)
                                    </span>
                                </div>

                                <div class="pt-3 border-t border-blush-200/15 space-y-1.5 text-xs">
                                    <div class="flex items-center justify-between">
                                        <span class="text-blush-200/65">Warna</span>
                                        <span class="text-blush-100 font-medium">{{ $colorName }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-blush-200/65">Bahan</span>
                                        <span class="text-blush-100 font-medium">{{ $materialName }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-5 pb-5 space-y-2.5">
                            <button type="button" onclick="toggleSavedStyle({{ $product->id }})"
                                    class="w-full py-2.5 rounded-xl bg-blush-200 text-maroon-950 text-xs font-bold uppercase tracking-[0.16em] hover:bg-blush-300 transition">
                                Simpan Gaya
                            </button>
                            <a href="#contact-section"
                               class="block w-full text-center py-2.5 rounded-xl bg-blush-100/90 text-maroon-950 text-xs font-bold uppercase tracking-[0.16em] hover:bg-blush-100 transition">
                                Hubungi / Order
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full bg-maroon-900/60 border border-blush-200/15 rounded-2xl p-8 text-center text-sm text-blush-200/75">
                        Belum ada item catalog yang tersedia.
                    </div>
                @endforelse
            </div>
        </section>

        <!-- LIMITED EDITION (Terpisah, muncul saat tombol ★ Limited Edition diklik) -->
        <section id="limited-edition-section" class="hidden bg-maroon-900/60 border border-blush-200/15 rounded-2xl p-6 sm:p-8 space-y-6">
            <div class="flex flex-wrap items-end justify-between gap-2">
                <div>
                    <p class="text-[11px] uppercase tracking-[0.22em] text-blush-300">Exclusive Drop</p>
                    <h2 class="font-display text-3xl sm:text-4xl font-bold uppercase text-blush-100">Limited Edition</h2>
                </div>
                <span class="text-xs uppercase tracking-[0.18em] text-blush-200/70">
                    Showing {{ $limitedProducts->count() }} Item(s)
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @forelse ($limitedProducts as $product)
                    @php
                        $colName = optional($product->collection)->name ?? 'Limited';
                        $catName = strtoupper($product->category ?? 'ATASAN');
                        $sizeName = strtoupper($product->size ?? 'ALL SIZE');
                        $colorName = strtolower($product->color ?? '-');
                        $materialName = strtolower($product->material ?? '-');
                    @endphp
                    <article class="bg-maroon-950/90 border border-blush-200/20 rounded-2xl overflow-hidden flex flex-col justify-between shadow-xl">
                        <div>
                            <div class="aspect-[4/5] bg-maroon-900 overflow-hidden relative">
                                @if (!empty($product->image))
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                                @endif
                                <span class="absolute top-3.5 left-3.5 px-3 py-1 rounded-full bg-blush-200 text-maroon-950 text-[10px] font-bold uppercase tracking-[0.18em]">
                                    ★ Limited Edition
                                </span>
                            </div>

                            <div class="p-5 space-y-3">
                                <div class="flex items-center justify-between text-[11px] uppercase tracking-[0.16em] text-blush-200/70">
                                    <span>{{ $catName }}</span>
                                    <span>Size {{ $sizeName }}</span>
                                </div>

                                <h3 class="font-display text-2xl font-bold uppercase text-blush-100">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-lg font-semibold text-blush-200">
                                    Rp {{ number_format((float) ($product->price ?? 0), 0, ',', '.') }}
                                </p>

                                <div class="pt-3 border-t border-blush-200/15 space-y-1.5 text-xs">
                                    <div class="flex items-center justify-between">
                                        <span class="text-blush-200/65">Warna</span>
                                        <span class="text-blush-100 font-medium">{{ $colorName }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-blush-200/65">Bahan</span>
                                        <span class="text-blush-100 font-medium">{{ $materialName }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-5 pb-5 space-y-2.5">
                            <button type="button" onclick="toggleSavedStyle({{ $product->id }})"
                                    class="w-full py-2.5 rounded-xl bg-blush-200 text-maroon-950 text-xs font-bold uppercase tracking-[0.16em] hover:bg-blush-300 transition">
                                Simpan Gaya
                            </button>
                            <a href="#contact-section"
                               class="block w-full text-center py-2.5 rounded-xl bg-blush-100/90 text-maroon-950 text-xs font-bold uppercase tracking-[0.16em] hover:bg-blush-100 transition">
                                Hubungi / Order
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full bg-maroon-950/70 border border-blush-200/15 rounded-2xl p-8 text-center text-sm text-blush-200/75">
                        Belum ada item Limited Edition yang ditambahkan.
                    </div>
                @endforelse
            </div>
        </section>

        <!-- LIST MODEL (Ukuran foto disamakan dengan kartu Catalog) -->
        <section id="list-model-section" class="hidden bg-maroon-900/60 border border-blush-200/15 rounded-2xl p-6 sm:p-8 space-y-6">
            <div class="flex flex-wrap items-end justify-between gap-2">
                <div>
                    <p class="text-[11px] uppercase tracking-[0.22em] text-blush-300">Editorial Talent</p>
                    <h2 class="font-display text-3xl sm:text-4xl font-bold uppercase text-blush-100">List Model</h2>
                </div>
                <span class="text-xs uppercase tracking-[0.18em] text-blush-200/70">
                    Showing {{ $modelList->count() }} Model(s)
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @forelse ($modelList as $model)
                    <article class="bg-maroon-950/90 border border-blush-200/20 rounded-2xl overflow-hidden flex flex-col justify-between shadow-xl">
                        <div>
                            <div class="aspect-[4/5] bg-maroon-900 overflow-hidden relative">
                                @if (!empty($model->image))
                                    <img src="{{ asset('storage/' . $model->image) }}" alt="{{ $model->name }}"
                                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                                @endif
                                <span class="absolute top-3.5 left-3.5 px-3 py-1 rounded-full bg-maroon-950/90 border border-blush-200/25 text-[10px] font-bold uppercase tracking-[0.18em] text-blush-200">
                                    Model
                                </span>
                            </div>

                            <div class="p-5 space-y-2">
                                <h3 class="font-display text-2xl font-bold uppercase text-blush-100">
                                    {{ $model->name }}
                                </h3>
                                <p class="text-xs uppercase tracking-[0.14em] text-blush-200/75">
                                    {{ $model->detail ?: '-' }}
                                </p>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full bg-maroon-950/70 border border-blush-200/15 rounded-2xl p-8 text-center text-sm text-blush-200/75">
                        Belum ada data model yang ditambahkan.
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Contact & Footer CTA -->
        <section id="contact-section" class="bg-maroon-900/80 border border-blush-200/15 rounded-2xl p-6 sm:p-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2 max-w-xl">
                <h2 class="font-display text-3xl sm:text-4xl font-bold text-blush-100">
                    Curate Your Own <span class="italic font-semibold text-blush-200">Signature Look</span>
                </h2>
                <p class="text-sm text-blush-200/75">
                    Hubungi kami untuk pembelian, tanya stok lookbook, atau kelola koleksi melalui panel administrasi.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="https://wa.me/" target="_blank" rel="noopener"
                   class="px-5 py-2.5 rounded-full bg-blush-200 text-maroon-950 text-xs font-bold uppercase tracking-[0.16em] hover:bg-blush-300 transition">
                    Hubungi WhatsApp
                </a>
                <a href="mailto:pirdaadmin@lookbook.catalog"
                   class="px-5 py-2.5 rounded-full border border-blush-200/30 text-blush-100 text-xs font-semibold uppercase tracking-[0.16em] hover:bg-maroon-800 transition">
                    Email
                </a>
                <a href="{{ route('admin.products.index') }}"
                   class="px-5 py-2.5 rounded-full border border-blush-200/30 text-blush-100 text-xs font-semibold uppercase tracking-[0.16em] hover:bg-maroon-800 transition">
                    Admin Dashboard
                </a>
                <a href="{{ route('api.lookbooks.fallback') }}" target="_blank"
                   class="px-5 py-2.5 rounded-full border border-blush-200/30 text-blush-100 text-xs font-semibold uppercase tracking-[0.16em] hover:bg-maroon-800 transition">
                    API Endpoint ↗
                </a>
            </div>
        </section>
    </main>

    <footer class="border-t border-blush-200/15 py-6 px-5 sm:px-8">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px] uppercase tracking-[0.2em] text-blush-200/60">
            <span>© 2026 Pirda Mustika — Fashion Lookbook</span>
            <span>Laravel • Tailwind CSS • Editorial Catalog</span>
        </div>
    </footer>

    <script>
        const savedKey = 'pirda_lookbook_saved_styles';
        const ratingKey = 'pirda_lookbook_catalog_ratings';

        function getSavedStyles() {
            try {
                const raw = localStorage.getItem(savedKey);
                const parsed = raw ? JSON.parse(raw) : [];
                return Array.isArray(parsed) ? parsed : [];
            } catch (e) {
                return [];
            }
        }

        function updateSavedBadge() {
            const badge = document.getElementById('saved-count-badge');
            if (badge) {
                badge.textContent = getSavedStyles().length;
            }
        }

        function toggleSavedStyle(productId) {
            const list = getSavedStyles();
            const idx = list.indexOf(productId);
            if (idx === -1) {
                list.push(productId);
            } else {
                list.splice(idx, 1);
            }
            localStorage.setItem(savedKey, JSON.stringify(list));
            updateSavedBadge();
        }

        function getCatalogRatings() {
            try {
                const raw = localStorage.getItem(ratingKey);
                const parsed = raw ? JSON.parse(raw) : {};
                return parsed && typeof parsed === 'object' ? parsed : {};
            } catch (e) {
                return {};
            }
        }

        function renderCatalogRating(productId, data) {
            const avg = Number(data?.avg ?? 0);
            const count = Number(data?.count ?? 0);
            const activeStars = Math.round(avg);

            const container = document.querySelector(`[data-rating-stars="${productId}"]`);
            if (container) {
                const buttons = container.querySelectorAll('.star-btn');
                buttons.forEach((btn, index) => {
                    if (index < activeStars) {
                        btn.classList.remove('text-blush-200/30');
                        btn.classList.add('text-blush-200');
                    } else {
                        btn.classList.remove('text-blush-200');
                        btn.classList.add('text-blush-200/30');
                    }
                });
            }

            const label = document.getElementById(`rating-label-${productId}`);
            if (label) {
                label.textContent = `★ ${avg.toFixed(1)} (${count})`;
            }
        }

        function setCatalogRating(productId, stars) {
            const ratings = getCatalogRatings();
            const current = ratings[productId] || { sum: 0, count: 0 };
            current.sum = Number(current.sum || 0) + Number(stars);
            current.count = Number(current.count || 0) + 1;
            current.avg = current.sum / current.count;

            ratings[productId] = current;
            localStorage.setItem(ratingKey, JSON.stringify(ratings));
            renderCatalogRating(productId, current);
        }

        function initCatalogRatings() {
            const ratings = getCatalogRatings();
            document.querySelectorAll('[data-rating-stars]').forEach((container) => {
                const productId = container.getAttribute('data-rating-stars');
                renderCatalogRating(productId, ratings[productId] || { avg: 0, count: 0 });
            });
        }

        function toggleFeatureSection(target) {
            const limitedSec = document.getElementById('limited-edition-section');
            const modelSec = document.getElementById('list-model-section');

            if (target === 'limited' && limitedSec) {
                const willShow = limitedSec.classList.contains('hidden');
                limitedSec.classList.toggle('hidden');
                if (willShow) {
                    limitedSec.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }

            if (target === 'model' && modelSec) {
                const willShow = modelSec.classList.contains('hidden');
                modelSec.classList.toggle('hidden');
                if (willShow) {
                    modelSec.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateSavedBadge();
            initCatalogRatings();
        });
    </script>
</body>
</html>