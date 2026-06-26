<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Booking | {{ config('app.name', 'GO TRAVEL') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen">

    @include('components.navbar')

    <main class="py-16 px-6">

        <div class="max-w-3xl mx-auto">

            {{-- Header --}}
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-slate-900">
                    Cek Booking
                </h1>

                <p class="mt-3 text-slate-500">
                    Masukkan <span class="font-semibold text-sky-600">Kode Booking</span>
                    dan <span class="font-semibold text-sky-600">Email</span>
                    untuk melihat status perjalanan Anda.
                </p>
            </div>

            {{-- Card --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">

                @if(session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('booking.search') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Kode Booking --}}
                    <div>
                        <label class="block mb-2 font-semibold text-slate-700">
                            Kode Booking
                        </label>

                        <input
                            type="text"
                            name="kode_booking"
                            value="{{ old('kode_booking') }}"
                            placeholder="Contoh: TRV-AB12CD34"
                            class="w-full rounded-2xl border border-slate-300 px-5 py-4 focus:border-sky-500 focus:ring-sky-500"
                            required>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block mb-2 font-semibold text-slate-700">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email saat booking"
                            class="w-full rounded-2xl border border-slate-300 px-5 py-4 focus:border-sky-500 focus:ring-sky-500"
                            required>
                    </div>

                    {{-- Tombol --}}
                    <button
                        type="submit"
                        class="w-full bg-sky-600 hover:bg-sky-700 text-white py-4 rounded-2xl font-bold transition">

                        Cari Booking

                    </button>

                </form>

            </div>

            {{-- Informasi --}}
            <div class="mt-8 bg-sky-50 rounded-3xl p-6 border border-sky-100">

                <h3 class="font-bold text-sky-700 mb-3">
                    Informasi
                </h3>

                <ul class="space-y-2 text-slate-600 text-sm">
                    <li>• Gunakan kode booking yang Anda terima setelah melakukan pemesanan.</li>
                    <li>• Masukkan email yang sama dengan email saat melakukan booking.</li>
                    <li>• Anda dapat melihat status booking, detail perjalanan, dan data peserta.</li>
                </ul>

            </div>

        </div>

    </main>

    @include('components.footer')

</body>
</html>