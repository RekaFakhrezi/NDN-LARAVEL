<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Nusantara Daily News — Portal berita warga terpercaya. Baca berita terkini, opini, budaya, dan laporan mendalam.">

    <title>{{ config('app.name', 'Nusantara Daily News') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#fafafa] text-gray-900 min-h-screen flex flex-col">

    @include('layouts.navigation')

    <main class="flex-1">
        {{ $slot }}

        @if(session('success') || session('login_success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="translate-y-12 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed bottom-6 right-6 z-[100] bg-white border border-gray-200 shadow-xl rounded-xl p-4 flex items-center gap-4 max-w-sm">
                <div
                    class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-sm font-black text-gray-900 mb-0.5">
                        {{ session('login_success') ? 'Login Berhasil!' : 'Sukses!' }}</h4>
                    <p class="text-xs text-gray-500">{{ session('success') ?? session('login_success') }}</p>
                </div>
                <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition-colors flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        @endif
    </main>

    <footer class="w-full mt-12">
        <div class="bg-[#1a1a1a] border-t-4 border-t-[#bd2828] pt-10 pb-8 md:pt-14 md:pb-12 px-4 md:px-6">
            <div
                class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-8 md:gap-6 lg:gap-8 text-white">

                <div class="sm:col-span-2 md:col-span-4 space-y-4">
                    <h2 class="text-lg md:text-xl font-serif font-bold tracking-wide">NDN: Nusantara Daily News</h2>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-md pr-2">
                        Sumber berita terpercaya yang menyajikan informasi mendalam dari seluruh pelosok Nusantara.
                    </p>
                    <div class="flex gap-3 pt-2">
                        <button
                            class="w-9 h-9 rounded border border-gray-600 flex items-center justify-center hover:bg-gray-700 hover:text-white text-gray-400 transition cursor-pointer">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </button>
                        <button
                            class="w-9 h-9 rounded border border-gray-600 flex items-center justify-center hover:bg-gray-700 hover:text-white text-gray-400 transition cursor-pointer">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="sm:col-span-1 md:col-span-2">
                    <h3 class="text-[11px] font-bold text-[#d44c4c] tracking-[0.15em] mb-4 uppercase">Informasi</h3>
                    <ul class="text-sm space-y-2.5 text-gray-300 font-medium">
                        <li><a href="#" class="hover:text-white transition">About NDN</a></li>
                        <li><a href="#" class="hover:text-white transition">Editorial Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Career</a></li>
                    </ul>
                </div>

                <div class="sm:col-span-1 md:col-span-2">
                    <h3 class="text-[11px] font-bold text-[#d44c4c] tracking-[0.15em] mb-4 uppercase">Bantuan</h3>
                    <ul class="text-sm space-y-2.5 text-gray-300 font-medium">
                        <li><a href="#" class="hover:text-white transition">Privacy</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                    </ul>
                </div>

                <div class="sm:col-span-2 md:col-span-4 space-y-3">
                    <h3 class="text-[11px] font-bold text-[#d44c4c] tracking-[0.15em] mb-2 uppercase">Newsletter</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">Dapatkan ringkasan berita terbaik setiap pagi.</p>
                    <form action="#" method="POST" class="flex h-[42px] max-w-md">
                        @csrf
                        <input type="email" placeholder="Email Anda"
                            class="bg-[#2c2c2c] text-white px-4 text-sm w-full outline-none rounded-l-md border border-transparent focus:border-red-500 transition focus:ring-0">
                        <button type="button"
                            class="bg-[#bd2828] text-white px-6 text-sm font-bold hover:bg-red-800 transition rounded-r-md cursor-pointer shrink-0 border-0">
                            Ikuti
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <div class="bg-[#0a0a0a] py-5 px-4 md:px-6">
            <div
                class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center text-[11px] md:text-[11.5px] text-gray-500 font-medium tracking-wide text-center md:text-left gap-3 md:gap-0">
                <p>© {{ date('Y') }} Nusantara Daily News. Suara Rakyat, Kebanggaan Bangsa.</p>
                <div class="flex gap-6 sm:gap-8">
                    <a href="#" class="hover:text-gray-300 transition">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-gray-300 transition">Kebijakan Cookie</a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>