<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout | Internusa Travel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-slate-100 text-slate-800">

    @include('components.navbar')

    <main class="pt-10 pb-16 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="mt-6 mb-8">
                <h1 class="text-3xl font-bold">Checkout Pembelian</h1>
                <p class="text-slate-500 mt-2">Lengkapi semua data untuk melanjutkan pesanan Anda.</p>
            </div>

            {{-- AREA PESAN --}}
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-xl mb-6 shadow-md">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-xl mb-6 shadow-md font-bold text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form id="checkoutForm" action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                <input type="hidden" name="tujuan_wisata" value="{{ $destination->name }}">
                
                <div class="grid lg:grid-cols-12 gap-8 items-start">
                    <div class="lg:col-span-7 space-y-6">
                        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-8">
                            <h2 class="text-xl font-bold mb-6">Informasi Pemesan</h2>
                            <div class="grid md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium mb-3">Nama Lengkap</label>
                                    <input type="text" name="full_name" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-3">Email</label>
                                    <input type="email" name="email" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-3">Nomor WhatsApp</label>
                                    <input type="tel" name="phone" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-3">NIK (Peserta 1)</label>
                                    <input type="text" name="nik[]" maxlength="16" required pattern="\d{16}" title="NIK harus 16 digit angka" class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                                </div>
                                <div id="additional-nik-container" class="md:col-span-2 grid md:grid-cols-2 gap-5"></div>
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-8">
                            <h2 class="text-xl font-bold mb-6">Detail Perjalanan</h2>
                            <div class="grid md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium mb-3">Tanggal Keberangkatan</label>
                                    <input type="date" name="departure_date" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-3">Jumlah Peserta (Max 5)</label>
                                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="5" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-3">Alamat Lengkap</label>
                                    <textarea name="address" rows="3" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none"></textarea>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-3">Asal Negara</label>
                                    <input type="text" name="country" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                                </div>
                                <div class="pt-4 mt-8 border-t border-slate-100 md:col-span-2">
                                    <h2 class="text-xl font-bold mb-6">Informasi Pembayaran (Kartu)</h2>
                                    <div class="grid md:grid-cols-2 gap-5">
                                        <input type="text" name="card_name" placeholder="Nama Pemilik Kartu" required class="md:col-span-2 w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                                        <input type="text" name="card_number" placeholder="Nomor Kartu (16 digit)" maxlength="16" required class="md:col-span-2 w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                                        <input type="text" name="card_expiry" placeholder="MM/YY" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                                        <input type="text" name="card_cvv" placeholder="CVV (3 digit)" maxlength="3" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-5">
                        <div class="bg-white rounded-3xl shadow-xl border border-slate-200 p-7 sticky top-24">
                            <h2 class="text-2xl font-bold mb-6">Ringkasan Pesanan</h2>
                            <img src="{{ $destination->image_url }}" class="w-full h-48 object-cover rounded-2xl mb-5">
                            <h3 class="text-xl font-bold">{{ $destination->name }}</h3>
                            <div class="space-y-5 mt-6">
                                <div class="flex justify-between"><span class="text-slate-500">Peserta</span><span id="jumlahPeserta" class="font-bold">1 Orang</span></div>
                                <div class="flex justify-between"><span class="text-slate-500">Harga Satuan</span><span class="font-bold">Rp {{ number_format($destination->price, 0, ',', '.') }}</span></div>
                            </div>
                            <div class="border-t mt-6 pt-6 flex justify-between items-center">
                                <span class="text-xl font-bold">Total</span>
                                <span id="totalHarga" class="text-2xl font-bold text-sky-600">Rp {{ number_format($destination->price, 0, ',', '.') }}</span>
                            </div>
                            <button type="button" onclick="confirmPayment()" class="w-full mt-7 bg-sky-600 hover:bg-sky-700 text-white py-4 rounded-2xl font-bold transition">
                                Bayar Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    @include('components.footer')

    <script>
        const quantityInput = document.getElementById('quantity');
        const jumlahPeserta = document.getElementById('jumlahPeserta');
        const totalHargaDisplay = document.getElementById('totalHarga');
        const nikContainer = document.getElementById('additional-nik-container');
        const pricePerItem = {{ $destination->price }};

        function updateForm() {
            let val = parseInt(quantityInput.value);
            if (val < 1) val = 1; if (val > 5) val = 5;
            quantityInput.value = val;
            jumlahPeserta.textContent = val + ' Orang';
            let total = val * pricePerItem;
            totalHargaDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');
            nikContainer.innerHTML = '';
            for (let i = 2; i <= val; i++) {
                nikContainer.innerHTML += `
                    <div class="mt-4">
                        <label class="block text-sm font-medium mb-3">NIK (Peserta ${i})</label>
                        <input type="text" name="nik[]" maxlength="16" required pattern="\\d{16}" class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>`;
            }
        }

        quantityInput.addEventListener('input', updateForm);
        updateForm();

        function confirmPayment() {
            const form = document.getElementById('checkoutForm');
            if (!form.checkValidity()) { form.reportValidity(); return; }

            Swal.fire({
                title: 'Konfirmasi Pembayaran',
                text: 'Pastikan data sudah benar sebelum melanjutkan.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0284c7',
                confirmButtonText: 'Ya, Bayar Sekarang'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (form.requestSubmit) { form.requestSubmit(); } else { form.submit(); }
                }
            });
        }
    </script>
</body>
</html>