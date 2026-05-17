<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Workspace - NDN</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800;900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-[#fafafa]">
    <div class="flex h-screen overflow-hidden bg-[#fafafa]" x-data="{ isMobileMenuOpen: false }">

        <div x-show="isMobileMenuOpen" class="fixed inset-0 bg-black/50 z-30 md:hidden backdrop-blur-sm"
            @click="isMobileMenuOpen = false" style="display: none;"></div>

        <aside :class="isMobileMenuOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-40 w-64 bg-[#bd2828] text-white flex flex-col shadow-2xl shrink-0 transform md:translate-x-0 md:static transition-transform duration-300 ease-in-out">
            <div class="p-6 pb-8 border-b border-red-800/30 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-serif font-bold tracking-wide">NDN: Admin</h1>
                    <p class="text-[10px] tracking-[0.2em] font-bold text-red-200 mt-1 uppercase">Workspace</p>
                </div>
                <button class="md:hidden text-red-200 hover:text-white p-1" @click="isMobileMenuOpen = false">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <nav class="flex-1 py-6 px-4 space-y-2 overflow-y-auto custom-scrollbar">
                <a href="{{ route('admin.dashboard') }}"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg font-medium text-sm transition {{ request()->routeIs('admin.dashboard') ? 'bg-white text-[#bd2828] font-bold shadow-sm' : 'text-red-100 hover:bg-red-800/50 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v10a2 2 0 01-2 2h-2a2 2 0 01-2-2v-10z">
                            </path>
                        </svg>
                        Dashboard
                    </div>
                </a>

                <a href="{{ route('admin.verifikasi') }}"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg font-medium text-sm transition {{ request()->routeIs('admin.verifikasi') ? 'bg-white text-[#bd2828] font-bold shadow-sm' : 'text-red-100 hover:bg-red-800/50 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Antrean Moderasi
                    </div>
                </a>

                <a href="{{ route('admin.published') }}"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg font-medium text-sm transition {{ request()->routeIs('admin.published') ? 'bg-white text-[#bd2828] font-bold shadow-sm' : 'text-red-100 hover:bg-red-800/50 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                        Manajemen Artikel
                    </div>
                </a>

                <a href="{{ route('admin.categories') }}"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg font-medium text-sm transition {{ request()->routeIs('admin.categories') ? 'bg-white text-[#bd2828] font-bold shadow-sm' : 'text-red-100 hover:bg-red-800/50 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                            </path>
                        </svg>
                        Kategori
                    </div>
                </a>

                <a href="{{ route('admin.trash') ?? '#' }}"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg font-medium text-sm transition {{ request()->routeIs('admin.trash') ? 'bg-white text-[#bd2828] font-bold shadow-sm' : 'text-red-100 hover:bg-red-800/50 hover:text-white' }}">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Tempat Sampah
                    </div>
                </a>
            </nav>

            <div class="p-4 border-t border-red-800/30">
                <a href="{{ route('home') }}"
                    class="w-full flex items-center justify-center md:justify-start gap-3 text-red-200 hover:text-white px-4 py-2.5 rounded-lg font-bold text-sm transition cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Keluar Dashboard
                </a>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-hidden relative w-full">

            <header
                class="h-[60px] md:h-[72px] bg-white border-b border-gray-200 flex items-center px-4 md:px-8 shrink-0 z-10 justify-between">
                <div class="flex items-center gap-3">
                    <button @click="isMobileMenuOpen = true"
                        class="md:hidden p-2 text-gray-600 hover:text-gray-900 bg-gray-50 rounded-md border border-gray-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <span
                        class="text-[11px] md:text-xs font-bold text-gray-500 uppercase tracking-widest hidden md:inline-block">Admin
                        Workspace</span>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden md:flex relative w-64">
                        <input type="text" placeholder="Cari artikel, user..."
                            class="w-full bg-gray-50 border border-gray-200 rounded-md py-1.5 pl-9 pr-3 text-xs focus:outline-none focus:border-[#bd2828] focus:ring-1 focus:ring-[#bd2828]">
                        <svg class="w-4 h-4 absolute left-3 top-2 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <div
                        class="w-8 h-8 rounded-full bg-[#bd2828] text-white flex items-center justify-center text-xs font-bold shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto bg-[#fafafa]">
                <div class="p-4 sm:p-6 md:p-8 max-w-7xl mx-auto space-y-6 md:space-y-8">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</body>

</html>