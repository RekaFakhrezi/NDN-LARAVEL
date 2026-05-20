<header class="sticky top-0 z-50 w-full shadow-md" x-data="{ openMenu: false }">
    <nav class="bg-[#bd2828] text-white px-4 md:px-6 py-3">
        <div class="max-w-7xl mx-auto flex items-center justify-between">

            <a href="{{ route('home') }}" class="flex flex-col shrink-0 group">
                <span
                    class="text-xl md:text-2xl font-serif font-bold leading-none tracking-wider group-hover:text-red-100 transition-colors">
                    NDN
                    <span class="text-xs md:text-sm font-sans ml-2 font-normal opacity-90 tracking-normal inline-block">
                        Nusantara<br class="hidden md:inline" /> Daily News
                    </span>
                </span>
            </a>

            <form action="{{ route('home') }}" method="GET" class="hidden md:flex flex-1 max-w-md mx-8 relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita di NDN..."
                    class="w-full bg-[#a31d1d] text-white placeholder-red-300 text-sm rounded-md py-2 px-10 focus:outline-none focus:ring-1 focus:ring-white/50 border border-[#a31d1d]">
                <svg class="w-4 h-4 absolute left-3 top-2.5 text-red-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </form>

            <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                <a href="{{ route('home') }}" class="hover:text-red-200 transition">Home</a>



                @auth
                    <a href="{{ route('artikel.create') }}" class="hover:text-red-200 transition">Submit News</a>
                    <a href="{{ route('artikel.my-articles') ?? '#' }}" class="hover:text-red-200 transition">My
                        Articles</a>
                @endauth

                <a href="{{ auth()->check() ? route('notifications.index') : route('login') }}"
                    class="hover:text-red-200 cursor-pointer relative p-1 transition" title="Pusat Notifikasi">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                    @auth
                        @php $unreadCount = Auth::user()->unreadNotificationsCount(); @endphp
                        @if($unreadCount > 0)
                            <span
                                class="absolute -top-1.5 -right-1.5 bg-white text-[#bd2828] text-[9px] font-black w-4 h-4 rounded-full flex items-center justify-center border border-[#bd2828] animate-bounce shadow-sm">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    @endauth
                </a>

                @auth
                    <div class="flex items-center gap-3">
                        @if(Auth::user()->is_admin)
                            <a href="{{ url('/admin') }}"
                                class="bg-red-900 text-white px-4 py-2 rounded-full font-bold hover:bg-red-800 transition shadow-sm border border-red-700 text-xs tracking-wider uppercase">Admin
                                Panel</a>
                        @endif
                        <a href="{{ route('profile.show', Auth::id()) }}"
                            class="bg-white text-center text-[#bd2828] px-4 py-2.5 rounded-md font-bold shadow-sm">
                            Profil Saya
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" title="Keluar"
                                class="text-red-200 hover:text-white transition cursor-pointer p-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-white text-[#bd2828] px-5 py-2 rounded-full font-bold hover:bg-gray-100 transition shadow-sm">Mulai
                        Menulis</a>
                @endauth
            </div>

            <div class="flex items-center gap-4 md:hidden">
                <a href="{{ auth()->check() ? route('notifications.index') : route('login') }}"
                    class="hover:text-red-200 relative p-1 transition" title="Pusat Notifikasi">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                    @auth
                        @php $unreadCount = Auth::user()->unreadNotificationsCount(); @endphp
                        @if($unreadCount > 0)
                            <span
                                class="absolute top-0 right-0 bg-white text-[#bd2828] text-[9px] font-black w-4 h-4 rounded-full flex items-center justify-center border border-[#bd2828] shadow-sm">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    @endauth
                </a>

                <button @click="openMenu = !openMenu"
                    class="p-1 focus:outline-none text-white hover:text-red-200 transition" aria-label="Toggle Menu">
                    <svg x-show="!openMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="openMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

        </div>

        <div x-show="openMenu" x-cloak x-transition.opacity.duration.200ms
            class="md:hidden bg-[#bd2828] border-t border-red-700/50 px-4 pt-2 pb-4 mt-3 flex flex-col gap-3 text-sm font-medium">
            <form action="{{ route('home') }}" method="GET" class="relative w-full my-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita di NDN..."
                    class="w-full bg-[#a31d1d] text-white placeholder-red-300 text-xs rounded-md py-2.5 pl-10 pr-4 focus:outline-none border border-[#a31d1d]">
                <svg class="w-4 h-4 absolute left-3 top-3 text-red-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </form>

            <a href="{{ route('home') }}" class="hover:bg-red-700/40 px-3 py-2 rounded transition">Home</a>



            @auth
                <a href="{{ route('artikel.create') }}" class="hover:bg-red-700/40 px-3 py-2 rounded transition">Submit
                    News</a>
                <a href="{{ route('artikel.my-articles') ?? '#' }}"
                    class="hover:bg-red-700/40 px-3 py-2 rounded transition">My Articles</a>

                <div class="border-t border-red-700/30 pt-2 flex flex-col gap-2 mt-1">
                    @if(Auth::user()->is_admin)
                        <a href="{{ url('/admin') }}"
                            class="bg-red-900 text-center text-white px-4 py-2.5 rounded-md font-bold text-xs tracking-wider uppercase">
                            Admin Panel
                        </a>
                    @endif
                    <a href="{{ route('profile.edit') }}"
                        class="bg-white text-center text-[#bd2828] px-4 py-2.5 rounded-md font-bold shadow-sm">
                        Profil Saya
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                            class="w-full text-red-100 hover:text-white text-center bg-red-800/40 py-2.5 rounded-md font-bold mt-1">
                            Keluar Akun
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="bg-white text-center text-[#bd2828] px-4 py-2.5 rounded-md font-bold shadow-sm mt-1">
                    Mulai Menulis
                </a>
            @endauth
        </div>
    </nav>

    @if(request()->routeIs('home'))
    <div class="bg-[#991b1b] text-white text-[10px] md:text-xs py-2 px-4 md:px-6 flex items-center">
        <div class="max-w-7xl mx-auto w-full flex items-center gap-3 md:gap-4 overflow-hidden">
            <span class="font-bold bg-[#7f1d1d] px-2 py-0.5 rounded shrink-0 tracking-wide">BREAKING:</span>
            <div class="truncate opacity-90 whitespace-nowrap">
                @if($breakingNewsShared->mode === 'article' && $breakingNewsShared->article)
                    <a href="{{ route('artikel.show', $breakingNewsShared->article_id) }}" class="hover:underline hover:text-red-200 transition font-bold">
                        🔥 {{ $breakingNewsShared->article->title }} • Klik di sini untuk membaca selengkapnya. • NDN
                    </a>
                @else
                    {{ $breakingNewsShared->content }}
                @endif
            </div>
        </div>
    </div>
    @endif
</header>