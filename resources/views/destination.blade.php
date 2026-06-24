<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Destinasi | {{ config('app.name', 'GO TRAVEL') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen">
@include('components.navbar')
<section class="pt-14 pb-16 relative bg-cover bg-center bg-fixed" style="background-image: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1920&auto=format&fit=crop');">
    <div class="absolute inset-0 bg-white/92 backdrop-blur-md"></div>
    <div class="relative max-w-7xl mx-auto px-6">
    <h1 class="text-4xl font-bold mb-8 text-center text-white">Jelajahi Destinations</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($destinations as $dest)
            <div class="destination-card reveal bg-white rounded-3xl border border-slate-100 overflow-hidden flex flex-col h-full relative">
                
                {{-- Badge Terfavorit --}}
                @if($loop->iteration <= 5 && $dest->stock > 0)
                    <div class="absolute top-4 left-4 z-10 bg-amber-400 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest shadow-md">
                        Terfavorit
                    </div>
                @endif

                <div class="h-48 overflow-hidden relative">
                    <img src="{{ $dest->image_url ?? 'default.jpg' }}" alt="{{ $dest->name }}" class="w-full h-full object-cover transition duration-700 hover:scale-110 hover:rotate-1">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>

                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-lg mb-2 line-clamp-1">{{ $dest->name }}</h3>
                        
                        {{-- Stok Tiket SVG --}}
                        <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                            <svg class="w-5 h-5 {{ $dest->stock > 0 ? 'text-sky-600' : 'text-red-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                            <span class="font-medium {{ $dest->stock > 0 ? 'text-slate-700' : 'text-red-500' }}">
                                {{ $dest->stock > 0 ? 'Tiket Tersedia' : 'Habis' }}
                            </span>
                        </div>

                        <p class="text-sky-600 font-bold text-lg mb-4">Rp {{ number_format($dest->price, 0, ',', '.') }}</p>
                    </div>

                    <a href="{{ route('checkout.index', $dest->id) }}" 
                       class="block w-full text-center {{ $dest->stock > 0 ? 'bg-slate-900 hover:bg-sky-600' : 'bg-slate-300 cursor-not-allowed' }} text-white font-bold py-3 rounded-xl transition">
                       {{ $dest->stock > 0 ? 'Pesan Sekarang' : 'Stok Habis' }}
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center text-slate-500">Tidak ada destinasi ditemukan.</div>
            @endforelse
        </div>
        @if(method_exists($destinations, 'links'))
        <div class="mt-12 flex justify-center">
            {{ $destinations->links() }}
        </div>
        @endif
    </div>
</section>

<style>
.destination-card{box-shadow:0 10px 25px rgba(0,0,0,.06);transition: all .5s ease;}
.destination-card:hover{transform: translateY(-8px);box-shadow:0 20px 40px rgba(14,165,233,.15);}
.reveal{opacity: 0;transform: translateY(30px);transition: all 0.6s ease-out;}
.reveal.active{opacity: 1;transform: translateY(0);}
</style>
<script>
function revealCards() {
    document.querySelectorAll('.reveal').forEach((el) => {
        if (el.getBoundingClientRect().top < window.innerHeight - 100) el.classList.add('active');
    });
}
window.addEventListener('scroll', revealCards);
window.addEventListener('load', revealCards);
</script>
@include('components.footer')
</body>
</html>