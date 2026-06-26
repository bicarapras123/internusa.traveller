<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking | {{ config('app.name', 'GO TRAVEL') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen">

@include('components.navbar')

<main class="py-16 px-6">

    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="text-center mb-10">

            <div class="w-20 h-20 bg-sky-100 rounded-full mx-auto flex items-center justify-center mb-5">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m5-2a9 9 0 11-18 0 9 9 0 0118 0z"/>

                </svg>

            </div>

            <h1 class="text-4xl font-bold text-slate-900">
                Detail Booking
            </h1>

            <p class="mt-3 text-slate-500">
                Berikut informasi booking perjalanan Anda.
            </p>

        </div>

        {{-- Detail Booking --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">

            <div class="grid md:grid-cols-2 gap-8">

                {{-- Data Pemesan --}}
                <div>

                    <h2 class="text-xl font-bold mb-6">
                        Data Pemesan
                    </h2>

                    <div class="space-y-5">

                        <div>
                            <p class="text-sm text-slate-500">Nama Lengkap</p>
                            <p class="font-semibold">{{ $booking->full_name }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">Email</p>
                            <p class="font-semibold">{{ $booking->email }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">Nomor Telepon</p>
                            <p class="font-semibold">{{ $booking->phone }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">Negara</p>
                            <p class="font-semibold">{{ $booking->country }}</p>
                        </div>

                    </div>

                </div>

                {{-- Detail Perjalanan --}}
                <div>

                    <h2 class="text-xl font-bold mb-6">
                        Detail Perjalanan
                    </h2>

                    <div class="space-y-5">

                        <div>
                            <p class="text-sm text-slate-500">Kode Booking</p>
                            <p class="font-bold text-sky-600">
                                {{ $booking->participants->first()->kode_booking }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">Tujuan Wisata</p>
                            <p class="font-semibold">
                                {{ $booking->participants->first()->tujuan_wisata }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">Tanggal Keberangkatan</p>
                            <p class="font-semibold">
                                {{ \Carbon\Carbon::parse($booking->departure_date)->format('d F Y') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500 mb-2">NIK Peserta</p>

                            <div class="space-y-2">
                                @foreach($booking->participants as $index => $participant)
                                    <div class="flex items-center justify-between bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
                                        <span class="text-slate-500 text-sm">
                                            Peserta {{ $index + 1 }}
                                        </span>

                                        <span class="font-semibold tracking-wide">
                                            {{ $participant->nik }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500">Total Pembayaran</p>

                            <p class="text-2xl font-bold text-sky-600">
                                Rp {{ number_format($booking->total_price,0,',','.') }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-slate-500 mb-2">
                                Status Booking
                            </p>

                            @if($booking->status == 'paid')

                                <span class="bg-emerald-100 text-emerald-700 px-4 py-2 rounded-xl font-bold">
                                    LUNAS
                                </span>

                            @elseif($booking->status == 'pending')

                                <span class="bg-amber-100 text-amber-700 px-4 py-2 rounded-xl font-bold">
                                    PENDING
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-xl font-bold">
                                    {{ strtoupper($booking->status) }}
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Tombol --}}
        <div class="flex flex-col md:flex-row gap-4 mt-10">

            <a href="{{ route('booking.search.form') }}"
               class="flex-1 text-center bg-slate-200 hover:bg-slate-300 py-4 rounded-2xl font-bold transition">

                Cek Booking Lagi

            </a>

            <a href="{{ route('home') }}"
               class="flex-1 text-center bg-sky-600 hover:bg-sky-700 text-white py-4 rounded-2xl font-bold transition">

                Kembali ke Beranda

            </a>

        </div>

    </div>

</main>

@include('components.footer')

</body>
</html>