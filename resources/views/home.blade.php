<x-app-layout>

    <div class="min-h-screen bg-[#fafafa] font-sans pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 pt-6 md:pt-8">

            @if(!empty($featured))
                <div class="relative w-full h-[48vh] sm:h-[60vh] md:h-[70vh] rounded-2xl overflow-hidden shadow-xl mb-8 md:mb-12 group">
                    @if($featured->image)
                        <img src="{{ $featured->image_url }}" alt="{{ $featured->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" />
                    @else
                        <div class="absolute inset-0 w-full h-full bg-gray-800"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/50 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 p-5 sm:p-8 md:p-12 w-full md:w-3/4 text-white">
                        <span class="bg-[#bd2828] text-white text-[10px] md:text-xs font-bold px-2.5 py-0.5 md:py-1 rounded mb-3 md:mb-4 inline-block uppercase tracking-wider">
                            {{ $featured->category->name ?? 'BERITA UTAMA' }}
                        </span>

                        <h1 class="text-xl sm:text-3xl md:text-5xl font-serif font-bold leading-tight mb-3 md:mb-4 line-clamp-3 md:line-clamp-none">
                            {{ $featured->title }}
                        </h1>

                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs md:text-sm text-gray-300 font-medium mb-4 md:mb-6">
                            <span>By {{ $featured->user->name ?? 'Admin NDN' }}</span>
                            <span class="hidden sm:inline">•</span>
                            <span class="flex items-center gap-1">⏱️ ~{{ ceil(str_word_count(strip_tags($featured->content)) / 200) }} Min Baca</span>
                            <span>•</span>
                            <span>{{ $featured->created_at->format('d M Y') }}</span>
                        </div>
                        <a href="{{ route('artikel.show', $featured->id) }}" class="bg-[#a31d1d] text-white px-4 py-2 md:px-6 md:py-3 rounded text-xs md:text-sm font-bold hover:bg-[#8a1818] transition shadow-lg inline-block">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            @endif

            <form method="GET" action="{{ route('home') }}" id="filterForm">
                <div class="bg-white border border-gray-200 rounded-2xl p-4 sm:p-6 shadow-sm mb-8 space-y-4 md:space-y-6">
                    
                    <div class="relative w-full max-w-xl">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berita di NDN..." class="w-full bg-gray-50 border border-gray-300 rounded-lg py-2.5 md:py-3 pl-10 pr-4 text-sm focus:outline-none focus:ring-1 focus:ring-[#bd2828] focus:border-[#bd2828] text-gray-800 transition">
                        <svg class="w-4 h-4 md:w-5 md:h-5 absolute left-3.5 top-3 md:top-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center justify-between border-t border-gray-100 pt-3 md:pt-4 gap-3">
                        <!-- Dropdown Kategori Beranda -->
                        <div class="relative w-full md:w-auto" x-data="{ openCat: false }">
                            <button @click="openCat = !openCat" @click.away="openCat = false" type="button" class="flex items-center justify-between gap-3 px-5 py-2.5 bg-gray-50 border border-gray-200 hover:border-gray-300 rounded-xl text-xs md:text-sm font-bold text-gray-700 shadow-sm hover:bg-gray-100 focus:outline-none transition min-w-[200px] w-full md:w-auto">
                                <span class="flex items-center gap-2">
                                    @if(request('category'))
                                        @php $currentCat = $categories->firstWhere('id', request('category')); @endphp
                                        <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $currentCat->color ?? '#bd2828' }}"></span>
                                        <span>Kategori: {{ $currentCat->name }}</span>
                                    @else
                                        <span class="w-2.5 h-2.5 rounded-full bg-gray-400"></span>
                                        <span>Semua Kategori</span>
                                    @endif
                                </span>
                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="openCat ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="openCat" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute left-0 mt-2 w-full md:w-60 rounded-xl bg-white border border-gray-150 shadow-lg z-50 py-1.5 focus:outline-none max-h-64 overflow-y-auto custom-scrollbar">
                                <a href="{{ route('home', array_merge(request()->except('category', 'page'))) }}" class="flex items-center gap-2 px-4 py-2 text-xs md:text-sm font-semibold {{ !request('category') ? 'bg-red-50 text-[#bd2828]' : 'text-gray-700 hover:bg-gray-50' }} transition">
                                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                                    Semua Kategori
                                </a>
                                @foreach($categories as $cat)
                                    <a href="{{ route('home', array_merge(request()->except('page'), ['category' => $cat->id])) }}" class="flex items-center gap-2 px-4 py-2 text-xs md:text-sm font-semibold {{ request('category') == $cat->id ? 'bg-red-50 text-[#bd2828]' : 'text-gray-700 hover:bg-gray-50' }} transition">
                                        <span class="w-2 h-2 rounded-full" style="background-color: {{ $cat->color ?? '#bd2828' }}"></span>
                                        {{ $cat->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <span class="text-[11px] md:text-xs font-bold text-gray-400 uppercase tracking-wider">Urutkan:</span>
                            <select name="sort" onchange="this.form.submit()" class="text-[#a31d1d] text-xs font-bold bg-transparent border-none focus:ring-0 cursor-pointer p-0 uppercase hover:text-[#8a1818] transition-colors outline-none">
                                <option value="terbaru" {{ request('sort', 'terbaru') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                <option value="terpopuler" {{ request('sort') == 'terpopuler' ? 'selected' : '' }}>Terpopuler</option>
                                <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>

            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                    @foreach($articles as $article)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300 flex flex-col overflow-hidden group relative">

                            <div class="relative h-44 md:h-48 overflow-hidden bg-gray-100 shrink-0">
                                @if($article->image)
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                    </div>
                                @endif
                                <span class="absolute top-3 left-3 bg-white/90 text-[#a31d1d] text-[9px] font-extrabold px-2.5 py-1 rounded uppercase tracking-widest shadow-sm backdrop-blur-sm">
                                    {{ $article->category->name ?? 'BERITA' }}
                                </span>
                            </div>

                            <div class="p-4 md:p-5 flex-1 flex flex-col justify-between space-y-4">
                                <div class="space-y-2">
                                    <h3 class="font-serif font-bold text-lg md:text-xl text-gray-900 leading-snug line-clamp-2 group-hover:text-[#a31d1d] transition">
                                        {{ $article->title }}
                                    </h3>
                                    <p class="text-xs md:text-sm text-gray-500 line-clamp-2 leading-relaxed">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}
                                    </p>
                                </div>

                                <div class="flex justify-between items-center border-t border-gray-50 pt-3 mt-2 shrink-0">
                                    <span class="text-[10px] md:text-[11px] font-bold text-gray-400">{{ $article->created_at->format('d M Y') }}</span>
                                    <a href="{{ route('artikel.show', $article->id) }}" class="text-[#a31d1d] text-[11px] font-bold flex items-center gap-1 hover:underline">
                                        Baca <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>
                                </div>
                            </div>

                            <a href="{{ route('artikel.show', $article->id) }}" class="absolute inset-0 z-10"></a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10 flex justify-center">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="text-center py-16 md:py-20 bg-white border border-gray-200 rounded-xl px-4 shadow-sm">
                    <p class="text-gray-400 text-sm md:text-base font-medium">Tidak ada artikel berita yang cocok dengan kata kunci atau kategori tersebut.</p>
                </div>
            @endif

            @if(isset($popularArticles) && $popularArticles->count() > 0 && !request('search'))
                <div class="mt-16 pt-8 border-t border-gray-200">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="text-2xl">🔥</span>
                        <h2 class="text-2xl font-serif font-bold text-gray-900">Terpopuler Minggu Ini</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($popularArticles->take(3) as $index => $pop)
                            <a href="{{ route('artikel.show', $pop->id) }}" class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm hover:shadow-md transition flex gap-4 items-center group">
                                <span class="text-3xl font-black text-gray-200 group-hover:text-[#a31d1d] transition-colors">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <div>
                                    <h4 class="font-bold text-sm text-gray-900 line-clamp-2 group-hover:text-[#a31d1d] transition">{{ $pop->title }}</h4>
                                    <div class="flex items-center gap-3 mt-2 text-[10px] text-gray-400 font-bold">
                                        <span class="flex items-center gap-1 text-red-400">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                            {{ $pop->likes_count }} Suka
                                        </span>
                                        <span>{{ $pop->created_at->format('d M') }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(!request('search') && !request('category') && !request('sort') && isset($categoryArticles))
                @foreach($categoryArticles as $catData)
                    <div class="mt-16">
                        <div class="flex items-center justify-between mb-6 border-b border-gray-200 pb-3">
                            <h2 class="text-2xl font-serif font-bold text-gray-900 border-l-4 border-[#bd2828] pl-3">
                                {{ $catData['category']->name }}
                            </h2>
                            <a href="{{ route('home', ['category' => $catData['category']->id]) }}" class="text-sm font-bold text-[#a31d1d] hover:underline">Lihat Semua →</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach($catData['articles'] as $catArticle)
                                <a href="{{ route('artikel.show', $catArticle->id) }}" class="bg-white rounded-lg overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition group">
                                    @if($catArticle->image)
                                        <div class="h-32 overflow-hidden">
                                            <img src="{{ $catArticle->image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                        </div>
                                    @endif
                                    <div class="p-4">
                                        <h3 class="text-sm font-bold text-gray-900 line-clamp-2 group-hover:text-[#a31d1d] transition">{{ $catArticle->title }}</h3>
                                        <p class="text-[10px] text-gray-400 font-bold mt-3">{{ $catArticle->created_at->format('d M Y') }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</x-app-layout>