<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hubungi Kami | {{ config('app.name', 'GO TRAVEL') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen">

@include('components.navbar')

<main class="py-16 px-6">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4 text-slate-900">Hubungi Kami</h1>
            <p class="text-slate-500">Kami siap menjawab pertanyaan dan membantu rencana perjalanan Anda.</p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 md:p-10 mb-12">
            <form id="contactForm" action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold mb-2 text-slate-700">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="w-full p-4 rounded-xl border border-slate-200 focus:ring-2 focus:ring-sky-500 outline-none transition" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold mb-2 text-slate-700">Alamat Email</label>
                        <input type="email" name="email" id="email" class="w-full p-4 rounded-xl border border-slate-200 focus:ring-2 focus:ring-sky-500 outline-none transition" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2 text-slate-700">Pesan Anda</label>
                    <textarea name="message" id="message" rows="5" class="w-full p-4 rounded-xl border border-slate-200 focus:ring-2 focus:ring-sky-500 outline-none transition" required></textarea>
                </div>
                <button type="submit" id="submitBtn" class="w-full bg-slate-900 text-white font-bold py-4 rounded-xl hover:bg-sky-600 transition duration-300">
                    <span id="btnText">Kirim Pesan Sekarang</span>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-center">
            <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center">
                <div class="w-12 h-12 bg-sky-50 text-sky-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h4 class="font-bold text-slate-900 mb-1">Email Customer Service</h4>
                <p class="text-sky-600 font-semibold">cs@internusa.com</p>
            </div>
            <div class="p-6 bg-white rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <h4 class="font-bold text-slate-900 mb-1">WhatsApp Official</h4>
                <p class="text-emerald-600 font-semibold">+62 812 3456 7890</p>
            </div>
        </div>
    </div>
</main>

@include('components.footer')

<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();
        
        if(name === '' || email === '' || message === '') {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Mohon lengkapi semua kolom sebelum mengirim pesan!',
                confirmButtonColor: '#0f172a'
            });
            return;
        }

        const btn = document.getElementById('submitBtn');
        const text = document.getElementById('btnText');
        btn.disabled = true;
        text.innerText = 'Mengirim...';
        btn.classList.add('opacity-70', 'cursor-not-allowed');
    });

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#0284c7'
        });
    @endif
</script>

</body>
</html>