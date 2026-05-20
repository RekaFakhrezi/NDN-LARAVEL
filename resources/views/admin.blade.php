<x-admin-sidebar>
    <div class="mb-6 md:mb-8">
        <h2 class="text-2xl md:text-3xl font-serif font-bold text-gray-900">Antrean Moderasi</h2>
        <p class="text-sm text-gray-500 mt-1">Tinjau dan verifikasi artikel yang dikirim oleh jurnalis warga sebelum
            diterbitkan.</p>
    </div>

    <!-- Categories Dropdown Filter -->
    <div class="mb-8 flex flex-wrap items-center bg-white p-3.5 rounded-2xl border border-gray-200/60 shadow-sm gap-3">
        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Filter Kategori:</span>
        
        <div class="relative min-w-[200px]">
            <select onchange="window.location.href=this.value" 
                    class="w-full bg-gray-50 border border-gray-200 rounded-xl py-2 pl-4 pr-10 text-xs font-bold text-gray-700 focus:outline-none focus:border-[#bd2828] focus:ring-1 focus:ring-[#bd2828] cursor-pointer appearance-none">
                <option value="{{ request()->fullUrlWithQuery(['category_id' => null]) }}" {{ !request('category_id') ? 'selected' : '' }}>
                    Semua Kategori
                </option>
                @foreach($categories as $cat)
                    <option value="{{ request()->fullUrlWithQuery(['category_id' => $cat->id]) }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        @forelse($articles as $article)
            <div
                class="bg-white border border-gray-200 rounded-xl p-5 md:p-6 shadow-sm hover:shadow-md transition-shadow flex flex-col xl:flex-row gap-5">

                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-2.5">
                        <span
                            class="bg-amber-100 text-amber-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">Menunggu
                            Review</span>
                        <span class="text-xs font-bold text-gray-400">•
                            {{ $article->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <h3 class="text-lg md:text-xl font-serif font-bold text-gray-900 mb-2 truncate"
                        title="{{ $article->title }}">
                        {{ $article->title }}
                    </h3>
                    <p class="text-sm text-gray-600 line-clamp-2 mb-4 leading-relaxed">
                        {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 180) }}
                    </p>

                    <div class="flex items-center gap-3 text-xs text-gray-500 font-medium">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 font-bold text-[10px] border border-gray-200">
                                {{ strtoupper(substr($article->user->name ?? 'A', 0, 1)) }}
                            </div>
                            <span class="font-bold text-gray-700">Oleh: {{ $article->user->name ?? 'Anonim' }}</span>
                        </div>
                        @if($article->category)
                            <span class="hidden sm:inline-block text-gray-300">|</span>
                            <span
                                class="px-2 py-1 rounded bg-gray-50 text-gray-600 border border-gray-100 font-bold text-[10px] uppercase tracking-wider">
                                {{ $article->category->name }}
                            </span>
                        @endif
                    </div>
                </div>

                <div
                    class="flex flex-row xl:flex-col gap-2 shrink-0 w-full xl:w-36 justify-center xl:justify-start mt-2 xl:mt-0 border-t xl:border-t-0 xl:border-l border-gray-100 pt-4 xl:pt-0 xl:pl-5">
                    <form action="{{ route('admin.approve', $article->id) }}" method="POST" class="flex-1 xl:flex-none">
                        @csrf
                        <button
                            class="w-full bg-green-600 hover:bg-green-700 text-white px-3 py-2.5 rounded-md text-xs font-bold transition-colors shadow-sm text-center flex items-center justify-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Terima
                        </button>
                    </form>
                    <form action="{{ route('admin.reject', $article->id) }}" method="POST" class="flex-1 xl:flex-none"
                        onsubmit="return confirm('Tolak dan kembalikan ke draf penulis?')">
                        @csrf
                        <button
                            class="w-full bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-3 py-2.5 rounded-md text-xs font-bold transition-colors text-center flex items-center justify-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Tolak
                        </button>
                    </form>
                    <a href="{{ route('admin.edit', $article->id) }}"
                        class="flex-1 xl:flex-none bg-gray-50 hover:bg-gray-100 text-gray-700 border border-gray-200 px-3 py-2.5 rounded-md text-xs font-bold transition-colors text-center flex items-center justify-center gap-1">
                        Baca & Edit
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-white border-2 border-dashed border-gray-300 rounded-xl p-12 text-center">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-gray-900 font-bold text-lg mb-1">Antrean Kosong</h3>
                <p class="text-gray-500 text-sm">Semua artikel telah selesai ditinjau. Kerja bagus!</p>
            </div>
        @endforelse
    </div>
</x-admin-sidebar>