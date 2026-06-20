<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'GO TRAVEL') }}</title>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen">

    @include('components.navbar')
    <section class="relative pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?q=80&w=2000&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-sky-700/80"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-6 text-center text-white">
        <h1 class="text-4xl lg:text-6xl font-bold mb-6">Mau Liburan ke Mana Hari Ini?</h1>
        <p class="text-sky-100 text-lg mb-10">Jelajahi ribuan destinasi terbaik dengan penawaran harga termurah.</p>
        
        {{-- FORM HANYA DIBUKA SEKALI --}}
        <form action="{{ route('travel.search') }}" method="GET" class="bg-white p-4 rounded-2xl shadow-2xl max-w-4xl mx-auto flex flex-col md:flex-row gap-4">
            
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}" 
                   placeholder="Mau ke mana?" 
                   class="flex-1 p-4 rounded-lg border border-gray-200 text-slate-800 focus:ring-2 focus:ring-sky-500 outline-none">
            
            <select name="category" class="p-4 rounded-lg border border-gray-200 text-slate-800 focus:ring-2 focus:ring-sky-500 outline-none">
                <option value="">Semua Kategori</option>
                @foreach(['Pantai', 'Gunung', 'Budaya', 'Kuliner', 'Belanja', 'Religi'] as $cat)
                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-sky-600 hover:bg-sky-700 text-white font-bold px-8 py-4 rounded-lg transition duration-300">
                Cari
            </button>
        </form> {{-- FORM DITUTUP SEKALI --}}
        
    </div>
</section>

    <section class="py-16 max-w-7xl mx-auto px-6">
    <h2 class="text-3xl font-bold mb-10 text-center">Jelajahi Berdasarkan Kategori</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
        @php
            $categories = [
                ['name' => 'Pantai', 'svg' => '<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8 0-.96.17-1.88.48-2.73l4.5 4.5c.39.39 1.02.39 1.41 0l4.5-4.5c.31.85.48 1.77.48 2.73 0 4.41-3.59 8-8 8zm0-10.45l-3.27-3.27c.85-.31 1.77-.48 2.73-.48 4.41 0 8 3.59 8 8 0 .96-.17 1.88-.48 2.73L12 9.55z"/>'],
                ['name' => 'Gunung', 'svg' => '<path d="M14.6 16.6l4.6-9.2-4.6 9.2zm-5.2 0l4.6-9.2-4.6 9.2zM5.3 7.4l4.6 9.2-4.6-9.2zm13.4 9.2h-13.4l6.7-13.4 6.7 13.4z"/>'],
                ['name' => 'Budaya', 'svg' => '<path d="M4 20h16v2H4zM6 10h12v7H6zm3-7l-3 3h12l-3-3H9z"/>'],
                ['name' => 'Kuliner', 'svg' => '<path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>'],
                ['name' => 'Belanja', 'svg' => '<path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>'],
                ['name' => 'Religi', 'svg' => '<path d="M12 2L4.5 20.29l.71.71L12 18l6.79 3 .71-.71L12 2z"/>']
            ];
        @endphp

        @foreach($categories as $cat)
        <a href="{{ route('travel.category', $cat['name']) }}" class="block">
            <div class="flex flex-col items-center justify-center p-6 bg-white border border-slate-100 rounded-2xl hover:border-sky-300 transition-all duration-300 cursor-pointer shadow-sm hover:shadow-lg group">
                <svg class="w-10 h-10 text-sky-600 mb-4 group-hover:scale-110 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                    {!! $cat['svg'] !!}
                </svg>
                <span class="font-bold text-slate-700 text-sm tracking-wide">{{ $cat['name'] }}</span>
            </div>
        </a>
        @endforeach
    </div>
</section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-16">Cara Mudah Memesan</h2>
            <div class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                <div class="absolute top-8 left-8 md:left-0 md:right-0 h-0.5 bg-sky-200 w-0.5 md:w-full md:mx-0 -z-0 ml-7 hidden md:block"></div>
                
                @foreach(['Cari Destinasi', 'Pilih Paket', 'Pembayaran Aman', 'Siap Berlibur'] as $step)
                <div class="flex items-center md:flex-col gap-6 md:gap-4 z-10 bg-white md:bg-transparent">
                    <div class="w-16 h-16 bg-sky-600 text-white rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <h3 class="font-bold text-lg text-slate-900">{{ $step }}</h3>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-20 bg-slate-50" x-data="{ scrollContainer: null }">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between mb-10">
            <h2 class="text-3xl font-bold text-slate-950">Destinasi Berbagai Belahan Dunia</h2>
            <div class="flex gap-2">
                <button @click="scrollContainer.scrollBy({ left: -350, behavior: 'smooth' })" class="p-2 rounded-full bg-white border shadow-sm text-sky-600 hover:bg-sky-50 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg></button>
                <button @click="scrollContainer.scrollBy({ left: 350, behavior: 'smooth' })" class="p-2 rounded-full bg-white border shadow-sm text-sky-600 hover:bg-sky-50 transition"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg></button>
            </div>
        </div>

        <div x-ref="container" x-init="scrollContainer = $refs.container" class="flex overflow-x-auto gap-8 pb-8 scrollbar-hide scroll-smooth">
            @php
                $destinations = \App\Models\TravelItem::where('is_active', 1)
                    ->orderBy('stock', 'asc')
                    ->get();
            @endphp

            @foreach($destinations as $dest)
            <div class="min-w-[320px] bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl transition-all duration-300 group flex flex-col relative">
                
                {{-- Badge Terfavorit: muncul untuk 5 item dengan stok terkecil --}}
                @if($loop->iteration <= 5 && $dest->stock > 0)
                    <div class="absolute top-4 left-4 z-10 bg-amber-400 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-md">
                        Terfavorit
                    </div>
                @endif

                <div class="h-60 overflow-hidden relative">
                    <img src="{{ $dest->image_url ?? 'default-image.jpg' }}" alt="{{ $dest->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="font-bold text-xl mb-3 text-slate-900">{{ $dest->name }}</h3>
                    
                    {{-- Stok Tiket SVG --}}
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-6">
                        <svg class="w-5 h-5 {{ $dest->stock > 0 ? 'text-sky-600' : 'text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                        <span class="font-medium {{ $dest->stock > 0 ? 'text-slate-700' : 'text-red-500' }}">
                            {{ $dest->stock > 0 ? 'Tiket Tersedia' : 'Habis' }}
                        </span>
                    </div>

                    <p class="text-sky-600 font-bold text-lg mb-6">Rp {{ number_format($dest->price, 0, ',', '.') }}</p>
                    
                    <a href="{{ route('checkout.index', $dest->id) }}" 
                       class="mt-auto block w-full text-center {{ $dest->stock > 0 ? 'bg-slate-900 hover:bg-sky-600' : 'bg-slate-300 cursor-not-allowed' }} text-white font-bold py-4 rounded-xl transition duration-300">
                        {{ $dest->stock > 0 ? 'Pesan Sekarang' : 'Stok Habis' }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

    <section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-16">Kenapa Memilih INTERNUSA?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $features = [
                    ['title' => 'Destinasi Terlengkap', 'desc' => 'Lebih dari 10.000 pilihan wisata di seluruh dunia.', 'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 110 4H5.5a2 2 0 01-2-2V5.5'],
                    ['title' => 'Harga Terbaik', 'desc' => 'Dapatkan jaminan harga termurah setiap hari.', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2z M12 2a10 10 0 100 20 10 10 0 000-20z'],
                    ['title' => 'Support 24/7', 'desc' => 'Tim kami siap membantu Anda kapan saja.', 'icon' => 'M18.364 5.636a9 9 0 11-12.728 0m12.728 0A9 9 0 015.636 18.364m12.728 0A9 9 0 005.636 5.636'],
                    ['title' => 'Pembayaran Aman', 'desc' => 'Sistem transaksi terenkripsi dengan berbagai metode.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                    ['title' => 'Konfirmasi Instan', 'desc' => 'Tiket dikirim langsung ke email Anda setelah pembayaran.', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                    ['title' => 'Bebas Biaya Ubah Jadwal', 'desc' => 'Fleksibilitas penuh untuk rencana perjalanan Anda.', 'icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15']
                ];
            @endphp
            
            @foreach($features as $f)
            <div class="p-8 border border-slate-100 rounded-3xl hover:border-sky-200 transition group shadow-sm hover:shadow-md text-center">
                <svg class="w-12 h-12 text-sky-600 mb-6 mx-auto group-hover:scale-110 transition duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $f['icon'] }}" />
                </svg>
                <h3 class="text-xl font-bold mb-3">{{ $f['title'] }}</h3>
                <p class="text-slate-600 leading-relaxed">{{ $f['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

    <section class="py-10 max-w-7xl mx-auto px-6">
        <div class="bg-sky-900 rounded-3xl p-12 text-white flex flex-col md:flex-row items-center justify-between gap-8">
            <div>
                <h2 class="text-3xl font-bold mb-4">Diskon Spesial 20%</h2>
                <p class="text-sky-200">Gunakan kode voucher: <span class="font-mono bg-sky-800 px-2 py-1 rounded">GOTRAVEL20</span></p>
            </div>
            <a href="#" class="bg-white text-sky-900 font-bold px-8 py-4 rounded-full hover:bg-gray-100 transition">Klaim Promo</a>
        </div>
    </section>

    @include('components.footer')

</body>
</html>