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

                <div class="relative flex items-center my-6 md:my-8">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="flex-shrink mx-3 md:mx-4 text-[9px] md:text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                        ATAU DAFTAR DENGAN
                    </span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>

                <div class="flex gap-3 md:gap-4">
                    <button type="button" class="flex-1 flex items-center justify-center gap-1.5 md:gap-2 bg-white border border-gray-300 rounded py-2.5 text-[11px] md:text-xs font-bold text-gray-700 hover:bg-gray-50 transition shadow-sm">
                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" /><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" /><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" /><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" /></svg>
                        Google
                    </button>
                    <button type="button" class="flex-1 flex items-center justify-center gap-1.5 md:gap-2 bg-[#1877F2] rounded py-2.5 text-[11px] md:text-xs font-bold text-white hover:bg-blue-600 transition shadow-sm">
                        <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" /></svg>
                        Facebook
                    </button>
                </div>

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