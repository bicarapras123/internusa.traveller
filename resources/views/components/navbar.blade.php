<nav x-data="{ open: false }" 
     class="w-full bg-gradient-to-b from-[#fcfcf9] to-white/90 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-50">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-24">
            
            <!-- Logo Section -->
            <div class="flex items-center space-x-3 shrink-0">
                <div class="w-12 h-12 bg-sky-600 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-xl">IN</span>
                </div>
                <div class="leading-none">
                    <span class="block text-slate-900 font-bold text-xl tracking-widest uppercase">INTERNUSA</span>
                    <span class="block text-sky-600 text-[10px] font-semibold tracking-widest uppercase mt-1">Jelajahi Dunia Dengan Aman & Nyaman.</span>
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-8 text-[11px] font-bold tracking-widest uppercase text-slate-800">
                <a href="{{ route('home') }}" class="hover:text-sky-600 transition duration-300">Beranda</a>
                <a href="#" class="hover:text-sky-600 transition duration-300">Destinasi</a>
                <a href="#" class="hover:text-sky-600 transition duration-300">Paket Wisata</a>
                <a href="#" class="hover:text-sky-600 transition duration-300">Hubungi Kami</a>
                                
                <div class="pl-4 border-l border-gray-200">
                    <a href="{{ route('login') }}" class="bg-sky-600 hover:bg-sky-700 text-white px-6 py-2.5 rounded-lg transition duration-300 shadow-lg">Login</a>
                </div>
            </div>

            <!-- Mobile Toggle -->
            <div class="lg:hidden">
                <button @click="open = ! open" class="text-slate-900 p-2">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden bg-white border-b border-gray-100 px-4 pt-2 pb-6 text-center text-xs font-bold tracking-widest uppercase text-slate-800">
        <a href="{{ route('home') }}" class="block py-4 border-b border-gray-50">Beranda</a>
        <a href="#" class="hover:text-sky-600 transition duration-300">Destinasi</a>
        <a href="#" class="hover:text-sky-600 transition duration-300">Paket Wisata</a>
        <a href="#" class="hover:text-sky-600 transition duration-300">Hubungi Kami</a>
        <a href="{{ route('login') }}" class="block w-full bg-sky-600 text-white py-3 mt-4 rounded-lg">Login</a>
    </div>
</nav>