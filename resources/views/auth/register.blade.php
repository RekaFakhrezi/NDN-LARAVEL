<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - {{ config('app.name', 'NDN') }}</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800;900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">

    <div class="min-h-screen flex flex-col md:flex-row font-sans bg-white">

        <div class="hidden md:flex md:w-5/12 lg:w-1/2 bg-[#a31d1d] text-white p-12 lg:p-16 flex-col justify-center relative overflow-hidden">
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1455390582262-044cdead27d8?q=80&w=800" alt="Jurnalisme Mesin Tik" class="w-full h-full object-cover opacity-20 mix-blend-multiply" />
            </div>
            <div class="absolute inset-0 bg-[#a31d1d]/90"></div>

            <div class="z-10 text-center">
                <div class="flex items-center justify-center gap-2 mb-2">
                    <span class="font-serif text-5xl font-bold tracking-wider">NDN</span>
                </div>
                <h3 class="font-bold text-lg tracking-wide mb-8">Nusantara Daily News</h3>
                
                <div class="w-16 h-1 bg-white mx-auto mb-8 rounded"></div>

                <p class="text-red-50 max-w-md mx-auto leading-relaxed text-base font-medium">
                    Bergabunglah dengan platform jurnalisme terpercaya. Suara Rakyat, Kebanggaan Bangsa.
                </p>
            </div>

            <div class="absolute bottom-8 left-12 right-12 flex justify-between text-[10px] text-red-200 opacity-80 z-10">
                <span>© {{ date('Y') }} NDN Editorial Team</span>
                <span>Jakarta, Indonesia</span>
            </div>
        </div>

        <div class="w-full md:w-7/12 lg:w-1/2 flex flex-col justify-center items-center p-6 sm:p-8 md:p-12 lg:p-24 relative bg-white">

            <div class="md:hidden w-full mb-6 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-2 text-[#a31d1d]">
                    <span class="font-serif text-2xl font-bold tracking-wider">NDN</span>
                </a>
                <a href="{{ route('home') }}" class="text-xs font-bold text-gray-400 hover:text-gray-700">← Kembali</a>
            </div>

            <div class="max-w-md w-full">
                <div class="mb-8">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-2 md:mb-3 tracking-tight">
                        Buat Akun NDN
                    </h2>
                    <p class="text-xs md:text-sm text-gray-500">
                        Lengkapi detail di bawah untuk memulai perjalanan Anda.
                    </p>
                </div>

                @if ($errors->any())
                    <div class="p-3 md:p-4 rounded-md text-xs md:text-sm font-semibold mb-6 border bg-red-50 text-red-700 border-red-200">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-4 md:space-y-5">
                    @csrf

                    <div>
                        <label class="block text-[10px] md:text-[11px] font-bold text-gray-600 uppercase tracking-widest mb-1.5">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap" class="w-full bg-white border @error('name') border-red-500 @else border-gray-300 @enderror rounded p-3 pl-10 md:pl-11 text-sm text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#bd2828] focus:border-[#bd2828] transition" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] md:text-[11px] font-bold text-gray-600 uppercase tracking-widest mb-1.5">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="contoh@domain.com" class="w-full bg-white border @error('email') border-red-500 @else border-gray-300 @enderror rounded p-3 pl-10 md:pl-11 text-sm text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#bd2828] focus:border-[#bd2828] transition" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] md:text-[11px] font-bold text-gray-600 uppercase tracking-widest mb-1.5">Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 karakter" class="w-full bg-white border @error('password') border-red-500 @else border-gray-300 @enderror rounded p-3 pl-10 md:pl-11 text-sm text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#bd2828] focus:border-[#bd2828] transition" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] md:text-[11px] font-bold text-gray-600 uppercase tracking-widest mb-1.5">Konfirmasi Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" class="w-full bg-white border border-gray-300 rounded p-3 pl-10 md:pl-11 text-sm text-gray-800 focus:outline-none focus:ring-1 focus:ring-[#bd2828] focus:border-[#bd2828] transition" />
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#a31d1d] text-white py-3 md:py-3.5 rounded font-bold text-sm hover:bg-red-800 transition shadow cursor-pointer mt-6 flex justify-center items-center gap-2">
                        Daftar Sekarang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>

                <div class="text-center text-[11px] md:text-xs text-gray-500 mt-8">
                    Sudah memiliki akun? 
                    <a href="{{ route('login') }}" class="text-[#a31d1d] font-bold hover:underline">
                        Masuk di sini
                    </a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>