<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Saya | {{ config('app.name', 'GO TRAVEL') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen">
    @include('components.navbar')

    <main class="py-16 px-6">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-slate-900">Riwayat Pesanan</h1>
                <span class="bg-slate-200 text-slate-700 px-4 py-1.5 rounded-full text-sm font-bold">
                    {{ $orders->count() }} Pesanan
                </span>
            </div>

            <div class="space-y-4">
                @forelse($orders as $order)
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-all flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-sky-50 rounded-2xl flex items-center justify-center text-sky-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-slate-900">{{ $order->full_name }}</h3>
                            <p class="text-sm text-slate-500 font-medium">Tanggal: {{ $order->departure_date }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between md:justify-end gap-8">
                        <div class="text-right">
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Total</p>
                            <p class="font-bold text-sky-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <span class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider 
                                {{ $order->status == 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-20 bg-white rounded-3xl border border-slate-100 border-dashed">
                    <p class="text-slate-400 font-medium">Belum ada riwayat pesanan yang tersedia.</p>
                </div>
                @endforelse
            </div>
        </div>
    </main>

    @include('components.footer')
</body>
</html>