<nav x-data="{ open: false }" 
     class="w-full bg-gradient-to-b from-[#fcfcf9] to-white/90 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-0 z-50">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 lg:h-24">
            
            <div class="flex items-center space-x-3 shrink-0">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-sky-600 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-lg lg:text-xl">IN</span>
                </div>
                <div class="leading-none">
                    <span class="block text-slate-900 font-bold text-lg lg:text-xl tracking-widest uppercase">INTERNUSA</span>
                    <span class="block text-sky-600 text-[9px] lg:text-[10px] font-semibold tracking-widest uppercase mt-0.5">Jelajahi Dunia Dengan Aman & Nyaman.</span>
                </div>
            </div>

            <div class="hidden lg:flex items-center gap-8 text-[11px] font-bold tracking-widest uppercase text-slate-800">
                <a href="{{ route('home') }}" class="hover:text-sky-600 transition duration-300">Home</a>
                <a href="{{ route('destinations.index') }}" class="hover:text-sky-600 transition duration-300">Destination</a>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-sky-600 transition duration-300">Dashboard Admin</a>
                    @else
                        <a href="{{ route('orders.index') }}" class="hover:text-sky-600 transition duration-300">Order</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="hover:text-sky-600 transition duration-300">Order</a>
                @endauth

                <a href="{{ route('contact.index') }}" class="hover:text-sky-600 transition duration-300">Contact Us</a>
                
                <div class="pl-4 border-l border-gray-200">
                    @guest
                        <a href="{{ route('login') }}" class="bg-sky-600 hover:bg-sky-700 text-white px-6 py-2.5 rounded-lg transition duration-300 shadow-lg">Login</a>
                    @else
                        <div class="flex items-center gap-4">
                            <span class="text-[10px] text-slate-600">{{ auth()->user()->name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-red-600 hover:text-red-800 transition">Logout</button>
                            </form>
                        </div>
                    @endguest
                </div>
            </div>

            <div class="lg:hidden">
                <button @click="open = ! open" class="text-slate-900 p-2 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" class="lg:hidden bg-white border-b border-gray-100 px-4 py-4 space-y-2 text-center text-xs font-bold tracking-widest uppercase text-slate-800">
        <a href="{{ route('home') }}" class="block py-3 hover:bg-gray-50 rounded-lg">Home</a>
        <a href="{{ route('destinations.index') }}" class="block py-3 hover:bg-gray-50 rounded-lg">Destination</a>
        
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="block py-3 hover:bg-gray-50 rounded-lg">Dashboard Admin</a>
            @else
                <a href="{{ route('orders.index') }}" class="block py-3 hover:bg-gray-50 rounded-lg">Order</a>
            @endif
        @else
            <a href="{{ route('login') }}" class="block py-3 hover:bg-gray-50 rounded-lg">Order</a>
        @endauth
        
        <a href="{{ route('contact.index') }}" class="block py-3 hover:bg-gray-50 rounded-lg">Contact Us</a>
        
        <div class="pt-2">
            @guest
                <a href="{{ route('login') }}" class="block w-full bg-sky-600 text-white py-3 rounded-lg shadow-md hover:bg-sky-700">Login</a>
            @else
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full bg-red-600 text-white py-3 rounded-lg shadow-md hover:bg-red-700">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>