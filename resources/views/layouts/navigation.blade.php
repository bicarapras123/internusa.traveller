<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LEFT --}}
            <div class="flex">

                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                {{-- DESKTOP MENU --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    @auth

                        {{-- ADMIN --}}
                        @if(auth()->user()->role === 'admin')

                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                Kelola Destinations
                            </x-nav-link>

                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                Kelola Pesanan
                            </x-nav-link>

                        @else

                            {{-- USER --}}
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                Destinations
                            </x-nav-link>


                        @endif

                    @else

                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            Destinations
                        </x-nav-link>

                    @endauth

                </div>
            </div>

            {{-- RIGHT USER --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                                {{ Auth::user()->name }}
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-gray-900 underline">
                        Login
                    </a>
                @endauth

            </div>

            {{-- MOBILE BUTTON --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open}" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open}" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            @auth

                @if(auth()->user()->role === 'admin')

                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Kelola Destinations
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        Kelola Pesanan
                    </x-responsive-nav-link>

                @else

                    <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        Destinations
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                        Pesanan Saya
                    </x-responsive-nav-link>

                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </x-responsive-nav-link>
                </form>

            @else

                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                    Destinations
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('login')">
                    Login
                </x-responsive-nav-link>

            @endauth

        </div>
    </div>
</nav>