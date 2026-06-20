<footer class="bg-gradient-to-b from-white to-sky-50 border-t border-sky-100 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            
            <div class="col-span-1 md:col-span-2">
                <span class="text-slate-950 font-bold text-xl uppercase tracking-widest">INTERNUSA</span>
                <p class="mt-4 text-slate-600 text-sm max-w-xs leading-relaxed">
                    Jelajahi keajaiban dunia bersama kami. Kami berkomitmen memberikan pengalaman wisata yang tak terlupakan dengan layanan terbaik.
                </p>
            </div>

            <div>
                <h3 class="font-bold text-slate-950 uppercase tracking-widest text-[11px] mb-6">Menu</h3>
                <ul class="space-y-4 text-slate-600 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-sky-600 transition duration-300">Beranda</a></li>
                    <a href="#" class="hover:text-sky-600 transition duration-300">Destinasi</a>
                    <a href="#" class="hover:text-sky-600 transition duration-300">Paket Wisata</a>
                    <a href="#" class="hover:text-sky-600 transition duration-300">Hubungi Kami</a>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-slate-950 uppercase tracking-widest text-[11px] mb-6">Hubungi Kami</h3>
                <ul class="space-y-4 text-slate-600 text-sm">
                    <li>Jl. Wisata Indah No. 7</li>
                    <li>Jakarta, Indonesia</li>
                    <li class="text-sky-600 font-semibold underline underline-offset-4 cursor-pointer hover:text-sky-700 transition">info@gotravel.com</li>
                </ul>
            </div>
        </div>
        
        <div class="mt-16 pt-8 border-t border-sky-100 flex flex-col md:flex-row justify-between items-center text-slate-500 text-[10px] uppercase tracking-widest">
            <p>&copy; {{ date('Y') }} GO TRAVEL. Hak Cipta Dilindungi.</p>
            <div class="flex space-x-8 mt-4 md:mt-0">
                <a href="#" class="hover:text-sky-600 transition duration-300">Privasi</a>
                <a href="#" class="hover:text-sky-600 transition duration-300">Ketentuan</a>
            </div>
        </div>
    </div>
</footer>