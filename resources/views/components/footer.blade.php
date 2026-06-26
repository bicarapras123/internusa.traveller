<footer class="bg-white border-t border-slate-100 py-16 mt-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            
            {{-- Brand Section --}}
            <div class="col-span-1 md:col-span-2 space-y-4">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl overflow-hidden shadow-sm border border-slate-200 bg-white p-1">
                        <img src="{{ asset('images/logointernusa.jpeg') }}" 
                            alt="Logo Internusa" 
                            class="w-full h-full object-contain">
                    </div>
                    <span class="text-2xl font-black text-slate-950 tracking-tighter">
                        INTER<span class="text-sky-600">NUSA</span>
                    </span>
                </a>
                
                <p class="text-slate-500 text-sm max-w-sm leading-relaxed font-medium">
                    Jelajahi keajaiban dunia bersama kami. Kami berkomitmen memberikan pengalaman wisata yang tak terlupakan dengan layanan terbaik.
                </p>
            </div>

            {{-- Menu Section --}}
            <div>
                <h3 class="font-bold text-slate-900 uppercase tracking-widest text-[11px] mb-6">Navigasi</h3>
                <ul class="space-y-4 text-slate-600 text-sm font-medium">
                    <li><a href="{{ route('home') }}" class="hover:text-sky-600 transition">Beranda</a></li>
                    <li><a href="#" class="hover:text-sky-600 transition">Destinasi</a></li>
                    <li><a href="#" class="hover:text-sky-600 transition">Paket Wisata</a></li>
                    <li><a href="#" class="hover:text-sky-600 transition">Hubungi Kami</a></li>
                </ul>
            </div>

            {{-- Contact Section --}}
            <div>
                <h3 class="font-bold text-slate-900 uppercase tracking-widest text-[11px] mb-6">Hubungi Kami</h3>
                <ul class="space-y-4 text-slate-600 text-sm font-medium">
                    <li>Jl. Pesanggrahan No.33 10 5 RT.010/RW.005 Meruya Utara Jakbar</li>
                    <li class="text-sky-600 font-bold">cs@internusa.com</li>
                </ul>
            </div>
        </div>
        
        {{-- Copyright Bar --}}
        <div class="mt-16 pt-8 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center text-slate-400 text-[11px] font-bold uppercase tracking-widest">
            <p>&copy; {{ date('Y') }} INTERNUSA TRAVEL. All rights reserved.</p>
            <div class="flex space-x-8 mt-4 md:mt-0">
                <a href="#" class="hover:text-sky-600 transition">Privasi</a>
                <a href="#" class="hover:text-sky-600 transition">Ketentuan</a>
            </div>
        </div>
    </div>
</footer>