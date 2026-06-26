<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-sky-50 via-white to-cyan-100 min-h-screen">

<div class="min-h-screen flex">

    {{-- LEFT SIDE --}}
    <div class="hidden lg:flex w-1/2 relative overflow-hidden">

        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2000&auto=format&fit=crop"
             class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-sky-900/60"></div>

        <div class="relative z-10 flex flex-col justify-center px-16 text-white">

            <div class="flex items-center gap-4 mb-10">

                <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center text-3xl font-bold">
                    IN
                </div>

                <div>
                    <h1 class="text-4xl font-bold tracking-wider uppercase">
                        Internusa
                    </h1>

                    <p class="text-sky-100 mt-2">
                        Jelajahi Dunia Dengan Aman & Nyaman
                    </p>
                </div>

            </div>

            <h2 class="text-5xl font-bold leading-tight mb-6">
                Explore the World<br>
                With Confidence
            </h2>

            <p class="text-sky-100 text-lg leading-relaxed max-w-lg">
                Booking perjalanan wisata lebih mudah, cepat, aman,
                dan terpercaya bersama Wonderfull Internusa.
            </p>

        </div>

    </div>

    {{-- RIGHT SIDE --}}
    <div class="flex-1 flex items-center justify-center px-6 py-10">

        <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-10">

            <div class="text-center mb-10">

                <div class="mx-auto w-20 h-20 rounded-2xl bg-sky-100 flex items-center justify-center mb-5">

                    <span class="text-3xl font-bold text-sky-600">
                        IN
                    </span>

                </div>

                <h2 class="text-3xl font-bold text-slate-900">
                    Welcome Back
                </h2>

                <p class="text-slate-500 mt-2">
                    Login ke akun Wonderfull Internusa
                </p>

            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Email --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-sky-500 focus:ring-sky-500">

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                </div>

                {{-- Password --}}
                <div>

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:border-sky-500 focus:ring-sky-500">

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

                </div>

                <div class="flex justify-between items-center">

                    <label class="flex items-center gap-2">

                        <input
                            type="checkbox"
                            name="remember"
                            class="rounded border-slate-300 text-sky-600">

                        <span class="text-sm text-slate-600">
                            Remember Me
                        </span>

                    </label>

                </div>

                <button
                    type="submit"
                    class="w-full bg-sky-600 hover:bg-sky-700 text-white py-3 rounded-xl font-bold shadow-lg transition">

                    Login

                </button>

            </form>

            <div class="mt-10 text-center">

                <a href="{{ route('home') }}"
                   class="text-slate-500 hover:text-sky-600 text-sm font-medium">

                    ← Kembali ke Beranda

                </a>

            </div>

        </div>

    </div>

</div>

</body>
</html>