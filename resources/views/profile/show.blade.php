<x-app-layout>
    <div class="min-h-screen bg-[#fafafa] pb-20 font-sans">

        <div class="w-full h-48 md:h-64 bg-gradient-to-r from-[#8a1818] to-[#bd2828] relative">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="absolute inset-0 opacity-10"
                style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 24px 24px;">
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 -mt-16 md:-mt-24 relative z-10">

            <div
                class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8 flex flex-col md:flex-row gap-6 items-center md:items-start justify-between text-center md:text-left mb-10">
                <div class="flex flex-col md:flex-row gap-6 items-center md:items-start">

                    <div
                        class="w-24 h-24 md:w-32 md:h-32 rounded-full border-4 border-white shadow-md bg-gray-100 overflow-hidden shrink-0 flex items-center justify-center">
                        @if(isset($user) && $user->avatar)
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <span class="text-4xl md:text-5xl font-black text-[#bd2828]">
                                {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                            </span>
                        @endif
                    </div>

                    <div class="pt-2">
                        <div class="flex flex-col md:flex-row md:items-center gap-2 md:gap-3 mb-1">
                            <h1 class="text-2xl md:text-3xl font-serif font-bold text-gray-900">
                                {{ $user->name ?? 'Nama Penulis' }}</h1>
                            @if(isset($user) && $user->is_admin)
                                <span
                                    class="bg-gray-900 text-white text-[10px] font-bold px-2 py-0.5 rounded tracking-wider uppercase">Tim
                                    Editorial</span>
                            @else
                                <span
                                    class="bg-[#bd2828]/10 text-[#bd2828] text-[10px] font-bold px-2 py-0.5 rounded tracking-wider uppercase">Jurnalis
                                    Warga</span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-500 mb-4">Bergabung sejak
                            {{ isset($user) ? $user->created_at->format('M Y') : 'Sekarang' }}</p>
                        <p class="text-sm text-gray-700 leading-relaxed max-w-lg">
                            {{ $user->bio ?? 'Berkomitmen menyajikan berita faktual dan mendalam. Fokus pada isu-isu sosial, teknologi, dan perkembangan terkini di Nusantara.' }}
                        </p>
                    </div>
                </div>

                @auth
                    @if(auth()->id() === ($user->id ?? 0))
                        <a href="{{ route('profile.edit') }}"
                            class="shrink-0 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-5 py-2.5 rounded-md text-sm font-bold transition shadow-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Pengaturan Akun
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Tab Switcher dengan Alpine.js -->
            <div x-data="{ activeTab: 'karya' }">
                @if(auth()->check() && auth()->id() === $user->id)
                    <div class="flex items-center gap-6 border-b border-gray-200 mb-8">
                        <button @click="activeTab = 'karya'" class="pb-3 text-lg font-serif font-bold transition focus:outline-none relative border-b-2" :class="activeTab === 'karya' ? 'border-[#bd2828] text-gray-900' : 'border-transparent text-gray-400 hover:text-gray-600'">
                            Karya Tulis ({{ $articles->count() ?? 0 }})
                        </button>
                        <button @click="activeTab = 'liked'" class="pb-3 text-lg font-serif font-bold transition focus:outline-none relative border-b-2" :class="activeTab === 'liked' ? 'border-[#bd2828] text-gray-900' : 'border-transparent text-gray-400 hover:text-gray-600'">
                            Berita Disukai ({{ $likedArticles->count() ?? 0 }})
                        </button>
                    </div>
                @else
                    <div class="mb-6 border-b border-gray-200 pb-2">
                        <h2 class="text-xl font-serif font-bold text-gray-900 border-l-4 border-[#bd2828] pl-3">Karya Tulis ({{ $articles->count() ?? 0 }})</h2>
                    </div>
                @endif

                <!-- Konten Tab Karya Tulis -->
                <div x-show="activeTab === 'karya'" x-transition:enter="transition duration-150 ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    @if(isset($articles) && $articles->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($articles as $article)
                                <a href="{{ route('artikel.show', $article->id) }}"
                                    class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300 flex flex-col overflow-hidden group">
                                    <div class="relative h-48 overflow-hidden bg-gray-100 shrink-0">
                                        @if($article->image)
                                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                        @endif
                                        <span
                                            class="absolute top-3 left-3 bg-white/90 text-[#a31d1d] text-[9px] font-extrabold px-2.5 py-1 rounded uppercase tracking-widest shadow-sm">
                                            {{ $article->category->name ?? 'BERITA' }}
                                        </span>
                                    </div>
                                    <div class="p-4 md:p-5 flex-1 flex flex-col justify-between">
                                        <div>
                                            <h3
                                                class="font-serif font-bold text-lg text-gray-900 leading-snug line-clamp-2 group-hover:text-[#a31d1d] transition mb-2">
                                                {{ $article->title }}</h3>
                                        </div>
                                        <div class="flex justify-between items-center border-t border-gray-50 pt-3 mt-3">
                                            <span
                                                class="text-[10px] md:text-[11px] font-bold text-gray-400">{{ $article->created_at->format('d M Y') }}</span>
                                            <span class="text-gray-400 text-xs flex items-center gap-1"><svg
                                                    class="w-3.5 h-3.5 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                                </svg> {{ $article->likes_count ?? 0 }}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16 bg-white border border-gray-200 rounded-xl px-4">
                            <p class="text-gray-400 text-sm font-medium">Penulis ini belum memiliki artikel yang dipublikasikan.</p>
                        </div>
                    @endif
                </div>

                <!-- Konten Tab Berita Disukai -->
                @if(auth()->check() && auth()->id() === $user->id)
                    <div x-show="activeTab === 'liked'" x-cloak x-transition:enter="transition duration-150 ease-out" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                        @if(isset($likedArticles) && $likedArticles->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($likedArticles as $article)
                                    <a href="{{ route('artikel.show', $article->id) }}"
                                        class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300 flex flex-col overflow-hidden group">
                                        <div class="relative h-48 overflow-hidden bg-gray-100 shrink-0">
                                            @if($article->image)
                                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                            @endif
                                            <span
                                                class="absolute top-3 left-3 bg-white/90 text-[#a31d1d] text-[9px] font-extrabold px-2.5 py-1 rounded uppercase tracking-widest shadow-sm">
                                                {{ $article->category->name ?? 'BERITA' }}
                                            </span>
                                        </div>
                                        <div class="p-4 md:p-5 flex-1 flex flex-col justify-between">
                                            <div>
                                                <h3
                                                    class="font-serif font-bold text-lg text-gray-900 leading-snug line-clamp-2 group-hover:text-[#a31d1d] transition mb-2">
                                                    {{ $article->title }}</h3>
                                            </div>
                                            <div class="flex justify-between items-center border-t border-gray-50 pt-3 mt-3">
                                                <span
                                                    class="text-[10px] md:text-[11px] font-bold text-gray-400">{{ $article->created_at->format('d M Y') }}</span>
                                                <span class="text-gray-400 text-xs flex items-center gap-1"><svg
                                                        class="w-3.5 h-3.5 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                                    </svg> {{ $article->likes_count ?? 0 }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-16 bg-white border border-gray-200 rounded-xl px-4">
                                <p class="text-gray-400 text-sm font-medium">Anda belum menyukai artikel berita apa pun.</p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>