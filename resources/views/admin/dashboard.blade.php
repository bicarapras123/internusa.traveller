<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-200 shadow-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Daftar Reservasi Lengkap</h3>
                        <p class="text-sm text-gray-500">Monitor data pesanan, detail pembayaran, dan partisipan.</p>
                    </div>

                    {{-- SEARCH BAR --}}
                    <form action="{{ route('admin.bookings.index') }}" method="GET" class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/kode..." 
                            class="text-sm border-gray-200 rounded-xl focus:ring-sky-500 focus:border-sky-500 w-full md:w-64">
                        
                        <button type="submit" class="bg-slate-900 text-white px-4 py-2 rounded-xl text-sm font-bold hover:bg-sky-600 transition">
                            Cari
                        </button>

                        {{-- TOMBOL BATAL / RESET --}}
                        <a href="{{ route('admin.bookings.index') }}" 
                           class="bg-gray-100 text-gray-600 px-4 py-2 rounded-xl text-sm font-bold hover:bg-gray-200 transition">
                            Batal
                        </a>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-[10px] tracking-widest font-bold">
                            <tr>
                                <th class="px-6 py-4 text-left">Pemesan & Status</th>
                                <th class="px-6 py-4 text-left">Kontak & Alamat</th>
                                <th class="px-6 py-4 text-left">Detail Trip</th>
                                <th class="px-6 py-4 text-left">Detail Partisipan</th>
                                <th class="px-6 py-4 text-left">Pembayaran</th>
                                <th class="px-6 py-4 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                        @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50/50 transition duration-150 align-top">
                            <td class="px-6 py-5">
                                <div class="font-semibold text-gray-900">{{ $booking->full_name }}</div>
                                <div class="text-[10px] bg-sky-100 text-sky-700 font-bold px-2 py-0.5 rounded-full mt-1.5 inline-block uppercase tracking-wider">
                                    {{ $booking->kode_booking }}
                                </div>
                                <div class="mt-2">
                                    <form action="{{ route('admin.bookings.update-status', $booking->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" 
                                            class="px-3 py-1 text-[10px] font-semibold rounded-full border-none cursor-pointer focus:ring-0
                                            {{ $booking->status == 'paid' ? 'text-emerald-700 bg-emerald-100' : ($booking->status == 'cancelled' ? 'text-rose-700 bg-rose-100' : 'text-amber-700 bg-amber-100') }}">
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $booking->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-gray-600">
                                <div class="text-xs">{{ $booking->email }}</div>
                                <div class="text-xs font-semibold">{{ $booking->phone }}</div>
                                <div class="text-[11px] text-gray-400 mt-1 max-w-[150px] leading-tight">
                                    {{ $booking->address }}, {{ $booking->country }}
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($booking->departure_date)->format('d M Y') }}</div>
                                <div class="text-xs text-gray-500 mt-0.5">{{ $booking->quantity }} Peserta</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="max-h-32 overflow-y-auto pr-2 scrollbar-thin">
                                    @foreach($booking->participants as $p)
                                        <div class="mb-2 p-2 bg-gray-50 rounded-lg border border-gray-100 w-40 text-[10px]">
                                            <div class="font-bold text-sky-600 uppercase truncate">{{ $p->tujuan_wisata }}</div>
                                            <div class="font-mono font-medium text-gray-700 mt-0.5">{{ $p->nik }}</div>
                                            <div class="mt-1 flex items-center gap-1 text-emerald-600 font-bold bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-100">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                                <span>{{ $p->kode_booking }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-5 text-xs">
                                <div class="font-semibold text-gray-800">{{ $booking->card_name }}</div>
                                <div class="font-mono text-gray-500">**** **** **** {{ substr(decrypt($booking->card_number), -4) }}</div>
                                <div class="text-[10px] text-gray-400">Exp: {{ $booking->card_expiry }}</div>
                            </td>
                            <td class="px-6 py-5 text-right font-bold text-gray-900">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-400">Belum ada pesanan yang sesuai dengan pencarian.</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>