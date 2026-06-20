<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $travelItem->name }} | GO TRAVEL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50">
    
    @include('components.navbar')

    <main class="max-w-3xl mx-auto px-6 py-12">
        
        <img src="{{ $travelItem->image_url }}" alt="{{ $travelItem->name }}" class="w-full h-72 object-cover rounded-2xl shadow-md mb-8">
        
        <h1 class="text-3xl font-bold mb-2">{{ $travelItem->name }}</h1>
        <p class="text-xl font-semibold text-sky-600 mb-8">Rp {{ number_format($travelItem->price, 0, ',', '.') }}</p>
        
        {{-- Section: Cerita Destinasi --}}
        <div class="bg-white p-6 rounded-xl border border-slate-200 mb-6 shadow-sm">
            <h2 class="text-lg font-bold mb-3 text-slate-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Cerita Destinasi
            </h2>
            <p class="text-slate-600 leading-relaxed">{{ $travelItem->description }}</p>
        </div>

        {{-- Section: Highlight dengan Ikon SVG --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-sky-600 p-4 rounded-xl text-white text-center shadow-lg">
                <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                <h3 class="font-bold text-sm mb-1">Eksklusif</h3>
                <p class="text-sky-100 text-[11px]">Akses spot tersembunyi.</p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-slate-200 text-center shadow-sm">
                <svg class="w-6 h-6 mx-auto mb-2 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                <h3 class="font-bold text-sm mb-1 text-slate-800">Kenangan</h3>
                <p class="text-slate-500 text-[11px]">Abadikan momen indah.</p>
            </div>
            <div class="bg-white p-4 rounded-xl border border-slate-200 text-center shadow-sm">
                <svg class="w-6 h-6 mx-auto mb-2 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <h3 class="font-bold text-sm mb-1 text-slate-800">Kenyamanan</h3>
                <p class="text-slate-500 text-[11px]">Fasilitas terkurasi.</p>
            </div>
        </div>

        {{-- Section: Itinerary --}}
        <div class="bg-white p-6 rounded-xl border border-slate-200 mb-8 shadow-sm">
            <h2 class="text-lg font-bold mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Sekilas Perjalanan
            </h2>
            <ul class="space-y-3 text-sm text-slate-600">
                <li class="flex items-center gap-3">
                    <span class="font-bold text-sky-600 bg-sky-50 px-2 py-1 rounded">08:00</span>
                    <span>Titik temu dan persiapan.</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="font-bold text-sky-600 bg-sky-50 px-2 py-1 rounded">10:00</span>
                    <span>Eksplorasi spot utama.</span>
                </li>
                <li class="flex items-center gap-3">
                    <span class="font-bold text-sky-600 bg-sky-50 px-2 py-1 rounded">13:00</span>
                    <span>Makan siang lokal.</span>
                </li>
            </ul>
        </div>

        {{-- Tombol Pesan (Tetap ada di bawah) --}}
        <a href="{{ route('checkout.index', $travelItem->id) }}" 
           class="flex items-center justify-center w-full bg-slate-900 text-white py-4 rounded-xl font-bold hover:bg-sky-600 transition shadow-lg hover:shadow-sky-200">
            Pesan Sekarang - Rp {{ number_format($travelItem->price, 0, ',', '.') }}
        </a>
    </main>

    @include('components.footer')
</body>
</html>