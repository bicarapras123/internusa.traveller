<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Kategori | Internusa Travel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800">

    @include('components.navbar')

    <div class="max-w-7xl mx-auto px-6 py-16">
        <h1 class="text-3xl font-bold mb-8">Hasil Kategori: {{ $category }}</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($travelItems as $item)
                <div class="bg-white rounded-2xl p-4 shadow border">
                    <img src="{{ $item->image_url }}" class="w-full h-48 object-cover rounded-xl mb-4">
                    <h3 class="font-bold text-lg">{{ $item->name }}</h3>
                    <p class="text-slate-500 text-sm">{{ $item->description }}</p>
                    <a href="{{ route('travel.show', $item->slug) }}" class="mt-4 block text-sky-600 font-bold">Lihat Detail →</a>
                </div>
            @empty
                <p>Tidak ada destinasi untuk kategori ini.</p>
            @endforelse
        </div>
    </div>

    @include('components.footer')

</body>
</html>