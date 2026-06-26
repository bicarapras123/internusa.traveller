<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | {{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-sky-100 via-white to-sky-50">

<div class="min-h-screen flex items-center justify-center px-5 py-10">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-100 p-8">

        {{-- Logo --}}
        <div class="text-center mb-8">

            <div class="mx-auto w-20 h-20 rounded-2xl bg-sky-600 flex items-center justify-center shadow-lg">
                <span class="text-white text-3xl font-bold">
                    IN
                </span>
            </div>

            <h1 class="mt-5 text-3xl font-bold text-slate-800">
                WONDERFULL INTERNUSA
            </h1>

            <p class="mt-2 text-slate-500">
                Login ke akun Wonderfull Internusa
            </p>

        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>

                <label class="block mb-2 text-sm font-semibold text-slate-700">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">

                <x-input-error :messages="$errors->get('email')" class="mt-2"/>

            </div>

            {{-- Password --}}
            <div>

                <label class="block mb-2 text-sm font-semibold text-slate-700">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">

                <x-input-error :messages="$errors->get('password')" class="mt-2"/>

            </div>

            <div class="flex items-center justify-between">

                <label class="flex items-center gap-2 text-sm text-slate-600">

                    <input
                        type="checkbox"
                        name="remember"
                        class="rounded border-slate-300 text-sky-600">

                    Remember Me

                </label>

            </div>

            <button
                type="submit"
                class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 rounded-xl transition">

                Login

            </button>

        </form>

        <div class="mt-8 text-center">

            <a href="{{ route('home') }}"
               class="text-sky-600 hover:underline text-sm font-medium">

                ← Kembali ke Beranda

            </a>

        </div>

    </div>

</div>

</body>
</html>