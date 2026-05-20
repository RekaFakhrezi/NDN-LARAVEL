<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - {{ config('app.name', 'NDN') }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">

    <div class="min-h-screen flex flex-col md:flex-row font-sans bg-white">

        <div class="hidden md:flex md:w-5/12 lg:w-1/2 bg-[#a31d1d] text-white p-12 lg:p-16 flex-col justify-between relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-bl-full"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-black opacity-10 rounded-tr-full"></div>

            <a href="{{ route('home') }}" class="z-10 flex items-center gap-2 hover:opacity-80 transition cursor-pointer w-max">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                <span class="font-serif text-3xl font-bold tracking-wider">NDN</span>
            </a>

            <div class="z-10 mt-12 lg:mt-0">
                <h1 class="text-4xl lg:text-5xl font-serif font-bold mb-6 leading-[1.15]">
                    Suara Rakyat,<br />Berita Terpercaya
                </h1>
                <p class="text-red-100 mb-12 max-w-sm leading-relaxed text-sm">
                    Dedikasi untuk jurnalisme yang berintegritas, menyajikan informasi terkini dari seluruh pelosok Nusantara.
                </p>

                <div class="rounded-xl overflow-hidden shadow-2xl w-4/5 max-w-md bg-black border-4 border-white/10 transform -rotate-2 hover:rotate-0 transition-transform duration-500">
                    <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=800" alt="Jurnalisme" class="w-full h-auto opacity-90 mix-blend-luminosity hover:mix-blend-normal transition-all" />
                </div>
            </div>

            <div class="text-xs text-red-200 z-10 mt-12 opacity-80">
                © {{ date('Y') }} Nusantara Daily News. Semua Hak Dilindungi.
            </div>
        </div>

        <div class="w-full md:w-7/12 lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-8 md:p-12 lg:p-24 relative bg-white">

            <div class="md:hidden w-full mb-6 md:mb-8 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-[#a31d1d]">
                    <span class="font-serif text-2xl font-bold tracking-wider">NDN</span>
                </a>
                <a href="{{ route('home') }}" class="text-xs font-bold text-gray-400 hover:text-gray-700">← Kembali</a>
            </div>

            <div class="max-w-md w-full">
                <div class="mb-8 md:mb-10">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-2 md:mb-3 tracking-tight">
                        Masuk ke NDN
                    </h2>
                    <p class="text-xs md:text-sm text-gray-500">
                        Silakan masukkan detail akun Anda untuk melanjutkan membaca berita pilihan.
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />
                @if ($errors->any())
                    <div class="p-3 md:p-4 rounded-md text-xs md:text-sm font-semibold mb-6 border bg-red-50 text-red-700 border-red-200">
                        Email atau kata sandi yang Anda masukkan salah.
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4 md:space-y-5">
                    @csrf

                    <div>
                        <label class="block text-[10px] md:text-[11px] font-bold text-gray-600 uppercase tracking-widest mb-1.5">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nama@email.com" class="w-full bg-white border @error('email') border-red-500 @else border-gray-300 @enderror rounded p-3 pl-10 md:pl-11 text-sm text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#bd2828] focus:border-[#bd2828] transition" />
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label class="block text-[10px] md:text-[11px] font-bold text-gray-600 uppercase tracking-widest">Kata Sandi</label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" name="password" required autocomplete="current-password" placeholder="••••••••" class="w-full bg-white border border-gray-300 rounded p-3 pl-10 md:pl-11 text-sm text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#bd2828] focus:border-[#bd2828] transition" />
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-1">
                        <input type="checkbox" name="remember" id="remember" class="w-3.5 h-3.5 md:w-4 md:h-4 rounded border-gray-300 text-[#bd2828] focus:ring-[#bd2828] cursor-pointer" />
                        <label for="remember" class="text-[11px] md:text-xs text-gray-600 cursor-pointer">Ingat saya di perangkat ini</label>
                    </div>

                    <button type="submit" class="w-full bg-[#a31d1d] text-white py-3 md:py-3.5 rounded font-bold text-sm hover:bg-red-800 transition shadow cursor-pointer mt-4">
                        Masuk
                    </button>
                </form>

                <div class="text-center text-[11px] md:text-xs text-gray-500 mt-6">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-[#a31d1d] font-bold hover:underline">
                        Daftar sekarang
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>