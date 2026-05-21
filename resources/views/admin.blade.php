<x-admin-sidebar>

    <!-- Header Halaman -->
    <div class="mb-6">
        <h2 class="text-2xl md:text-3xl font-serif font-bold text-gray-900">Antrean Moderasi</h2>
        <p class="text-xs text-gray-500 mt-1">Tinjau dan verifikasi artikel yang dikirim oleh jurnalis warga sebelum diterbitkan.</p>
    </div>

    <!-- Filter & Pencarian Kontrol -->
    <div class="bg-white border border-gray-200 rounded-xl p-4 mb-6 shadow-sm">
        <form action="{{ route('admin.verifikasi') }}" method="GET" class="flex flex-col sm:flex-row gap-3 items-center w-full">
            <div class="relative flex-1 w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari di antrean moderasi..." class="w-full bg-gray-50 border border-gray-200 rounded-xl py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-[#bd2828] focus:ring-1 focus:ring-[#bd2828] focus:bg-white transition-all">
                <svg class="w-4 h-4 absolute left-3.5 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <div class="w-full sm:w-64">
                <select name="category_id" onchange="this.form.submit()" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-2 px-3 text-sm focus:outline-none focus:border-[#bd2828] focus:ring-1 focus:ring-[#bd2828] focus:bg-white transition-all cursor-pointer">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @if(request()->filled('search') || request()->filled('category_id'))
                <a href="{{ route('admin.verifikasi') }}" class="text-xs font-bold text-[#bd2828] hover:underline whitespace-nowrap px-2">Reset Filter</a>
            @endif
        </form>
    </div>

    <!-- List Antrean Moderasi (Card Horizontal) -->
    <div class="space-y-4">
        @forelse($articles as $article)
            <div class="bg-white border border-gray-200 rounded-xl p-5 md:p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row gap-5 relative group">
                
                <!-- Thumbnail Gambar di Kiri -->
                <div class="w-full sm:w-40 h-28 shrink-0 rounded-lg overflow-hidden bg-gray-100 border border-gray-200 relative">
                    @if($article->image_url)
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center bg-gray-50 text-gray-400">
                            <svg class="w-8 h-8 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-[9px] uppercase tracking-wider font-bold mt-1 opacity-60">No Image</span>
                        </div>
                    @endif
                </div>

                <!-- Detail di Tengah -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-amber-100 text-amber-700 text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wider">
                            Menunggu Review
                        </span>
                        @if($article->category)
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider text-white shadow-sm" style="background: {{ $article->category->color }}dd;">
                                {{ $article->category->name }}
                            </span>
                        @endif
                        <span class="text-xs font-bold text-gray-400">{{ $article->created_at->format('d M Y H:i') }}</span>
                    </div>

                    <h3 class="text-base md:text-lg font-serif font-bold text-gray-900 mb-1.5 group-hover:text-[#bd2828] transition-colors line-clamp-1" title="{{ $article->title }}">
                        <a href="{{ route('admin.edit', $article->id) }}">{{ $article->title }}</a>
                    </h3>

                    <p class="text-xs text-gray-500 font-medium mb-3">
                        Oleh: <span class="font-bold text-gray-700">{{ $article->user->name ?? 'Anonim' }}</span>
                    </p>

                    <p class="text-xs md:text-sm text-gray-600 line-clamp-2 leading-relaxed">
                        {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 180) }}
                    </p>
                </div>

                <!-- Tombol Aksi di Kanan -->
                <div class="flex flex-row sm:flex-col gap-2 shrink-0 w-full sm:w-32 justify-end sm:justify-start pt-4 sm:pt-0 border-t sm:border-t-0 sm:border-l border-gray-100 sm:pl-5">
                    <form action="{{ route('admin.approve', $article->id) }}" method="POST" class="flex-1 sm:flex-none">
                        @csrf
                        <button class="w-full bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg text-xs font-bold transition-all shadow-sm flex items-center justify-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            Terima
                        </button>
                    </form>
                    <form action="{{ route('admin.reject', $article->id) }}" method="POST" class="flex-1 sm:flex-none" onsubmit="return confirm('Tolak dan kembalikan ke draf penulis?')">
                        @csrf
                        <button class="w-full bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-3 py-2 rounded-lg text-xs font-bold transition-all flex items-center justify-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Tolak
                        </button>
                    </form>
                    <a href="{{ route('admin.edit', $article->id) }}" class="flex-1 sm:flex-none text-center bg-gray-50 hover:bg-gray-100 text-gray-700 border border-gray-200 px-3 py-2 rounded-lg text-xs font-bold transition-all" title="Baca & Edit">
                        Baca & Edit
                    </a>
                </div>

            </div>
        @empty
            <div class="bg-white border-2 border-dashed border-gray-300 rounded-xl p-16 text-center flex flex-col items-center justify-center shadow-sm">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400 border border-gray-200">
                    <svg class="w-8 h-8 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2 font-serif">Antrean Kosong</h3>
                <p class="text-gray-500 max-w-sm mx-auto text-sm">Semua artikel telah selesai ditinjau atau tidak ada yang cocok dengan filter pencarian.</p>
            </div>
        @endforelse
    </div>

</x-admin-sidebar>