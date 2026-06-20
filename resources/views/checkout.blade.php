<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout | Internusa Travel </title>
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

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                <input type="hidden" name="tujuan_wisata" value="{{ $destination->name }}">
                <input type="hidden" id="price_per_item" value="{{ $destination->price }}">

                <div class="grid lg:grid-cols-12 gap-8 items-start">

                    {{-- KIRI: FORM --}}
                    <div class="lg:col-span-7 space-y-6">
                        {{-- INFORMASI PEMESAN --}}
                        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-8">
                            <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                                <svg class="w-6 h-6 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Informasi Pemesan
                            </h2>
                            <div class="grid md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium mb-3">Nama Lengkap</label>
                                    <input type="text" name="full_name" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-3">Email</label>
                                    <input type="email" name="email" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-3">Nomor WhatsApp</label>
                                    <input type="tel" name="phone" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-3">NIK (Peserta 1)</label>
                                    <input type="text" name="nik[]" maxlength="16" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                                </div>
                                <div id="additional-nik-container" class="md:col-span-2 grid md:grid-cols-2 gap-5"></div>
                            </div>
                        </div>

                        {{-- DETAIL PERJALANAN --}}
                        <div class="bg-white rounded-3xl shadow-lg border border-slate-200 p-8">
                            <h2 class="text-xl font-bold mb-6">Detail Perjalanan</h2>
                            <div class="grid md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium mb-3">Tanggal Keberangkatan</label>
                                    <input type="date" name="departure_date" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-3">Jumlah Peserta (Max 5)</label>
                                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="5" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-3">Alamat Lengkap</label>
                                    <textarea name="address" rows="3" required placeholder="Masukkan alamat lengkap Anda" class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none"></textarea>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium mb-3">Asal Negara</label>
                                    <input type="text" name="country" required placeholder="Contoh: Indonesia" class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                                </div>
                            </div>
                            
                            <div class="pt-4 mt-8 border-t border-slate-100">
                                <h2 class="text-xl font-bold mb-6">Informasi Pembayaran (Kartu)</h2>
                                <div class="grid md:grid-cols-2 gap-5">
                                    <input type="text" name="card_name" placeholder="Nama Pemilik Kartu" required class="md:col-span-2 w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                                    <input type="text" name="card_number" placeholder="Nomor Kartu (0000 0000 0000 0000)" required class="md:col-span-2 w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                                    <input type="text" name="card_expiry" placeholder="MM/YY" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                                    <input type="text" name="card_cvv" placeholder="CVV" required class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                                </div>
                            </div>
                        </div>
                    </div>

                {{-- KANAN RINGKASAN --}}
                <div class="lg:col-span-5">
                    <div class="bg-white rounded-3xl shadow-xl border border-slate-200 p-7 sticky top-24">
                        <h2 class="text-2xl font-bold mb-6 flex items-center gap-3">
                            <div class="bg-sky-100 p-3 rounded-2xl">
                                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                            Ringkasan Pesanan
                        </h2>

                        <img src="{{ $destination->image_url }}" class="w-full h-48 object-cover rounded-2xl mb-5">
                        <h3 class="text-xl font-bold">{{ $destination->name }}</h3>
                        <p class="text-sm text-slate-500 mt-2">{{ $destination->description }}</p>

                        {{-- FASILITAS --}}
                        <div class="grid grid-cols-4 gap-2 mt-6 mb-6">
                            <div class="flex flex-col items-center text-center">
                                <div class="p-2 bg-orange-50 text-orange-600 rounded-xl mb-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                </div>
                                <span class="text-[10px] font-medium text-slate-600">Makan</span>
                            </div>
                            <div class="flex flex-col items-center text-center">
                                <div class="p-2 bg-blue-50 text-blue-600 rounded-xl mb-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                </div>
                                <span class="text-[10px] font-medium text-slate-600">Minum</span>
                            </div>
                            <div class="flex flex-col items-center text-center">
                                <div class="p-2 bg-purple-50 text-purple-600 rounded-xl mb-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                </div>
                                <span class="text-[10px] font-medium text-slate-600">Tiket</span>
                            </div>
                            <div class="flex flex-col items-center text-center">
                                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-xl mb-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <span class="text-[10px] font-medium text-slate-600">Safety</span>
                            </div>
                        </div>

                        <div class="border-t my-6"></div>

                        <div class="space-y-5">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Peserta</span>
                                <span id="jumlahPeserta" class="font-bold">1 Orang</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Harga Satuan</span>
                                <span class="font-bold">Rp {{ number_format($destination->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="border-t mt-6 pt-6">
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold">Total</span>
                                <span id="totalHarga" class="text-2xl font-bold text-sky-600">Rp {{ number_format($destination->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button type="button" onclick="confirmPayment()" class="w-full mt-7 bg-sky-600 hover:bg-sky-700 text-white py-4 rounded-2xl font-bold transition">
                            Bayar Sekarang
                        </button>
                        <p class="text-xs text-center text-slate-400 mt-5">Dengan melanjutkan pembayaran, Anda menyetujui syarat dan ketentuan.</p>
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
        if (val < 1) val = 1; 
        if (val > 5) val = 5;
        quantityInput.value = val;
        
        // Update Text
        jumlahPeserta.textContent = val + ' Orang';
        
        // Update Total
        let total = val * pricePerItem;
        totalHargaDisplay.textContent = 'Rp ' + total.toLocaleString('id-ID');

        // Update Input NIK
        nikContainer.innerHTML = '';
        for (let i = 2; i <= val; i++) {
            nikContainer.innerHTML += `
                <div class="mt-4">
                    <label class="block text-sm font-medium mb-3">NIK (Peserta ${i})</label>
                    <input type="text" name="nik[]" maxlength="16" required pattern="\\d{16}" title="NIK harus 16 digit angka" class="w-full border-2 border-sky-300 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-sky-500 outline-none">
                </div>
            `;
        }
    }

    // 1. Jalankan saat user mengetik
    quantityInput.addEventListener('input', updateForm);

    // 2. JALANKAN SEKALI SAAT HALAMAN DILOAD (Agar default value 1 tetap jalan)
    updateForm();

    function confirmPayment() {
    const form = document.querySelector('form');
    
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const totalHarga = totalHargaDisplay.textContent;
    const jumlah = jumlahPeserta.textContent;

    Swal.fire({
        title: '<h2 class="text-xl font-bold text-slate-800">Konfirmasi Pembayaran</h2>',
        html: `
            <div class="text-left mt-6 space-y-4">
                <div class="flex items-center gap-4 p-4 bg-sky-50 rounded-xl border border-sky-100">
                    <div class="p-2 bg-sky-500 rounded-lg text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-sky-600 font-semibold">Total Peserta</p>
                        <p class="text-lg font-bold text-slate-800">${jumlah}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                    <div class="p-2 bg-emerald-500 rounded-lg text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zM12 2a10 10 0 100 20 10 10 0 000-20z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-emerald-600 font-semibold">Total Harga</p>
                        <p class="text-lg font-bold text-slate-800">${totalHarga}</p>
                    </div>
                </div>
                
                <p class="text-xs text-slate-400 text-center italic mt-4">Pastikan data di atas sudah sesuai sebelum melanjutkan.</p>
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0284c7',
        cancelButtonColor: '#94a3b8',
        confirmButtonText: 'Ya, Bayar Sekarang',
        cancelButtonText: 'Cek Kembali',
        buttonsStyling: true,
        customClass: {
            confirmButton: 'px-6 py-3 font-bold rounded-xl',
            cancelButton: 'px-6 py-3 font-bold rounded-xl'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
</body>
</html>