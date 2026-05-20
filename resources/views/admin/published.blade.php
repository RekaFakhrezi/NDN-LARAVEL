<x-admin-sidebar>

        <form action="{{ route('admin.bulkTrash') }}" method="POST" id="bulkTrashForm">
            @csrf
        </form>

        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-gray-200 pb-4">
            <h2 class="text-2xl md:text-3xl font-serif font-bold text-gray-900">Berita Tayang</h2>
            
            <div class="flex items-center gap-3">
                <label class="flex items-center gap-2 cursor-pointer bg-white px-3 py-2 rounded-xl border border-gray-200 shadow-sm hover:bg-gray-50 hover:border-gray-300 transition-all">
                    <input type="checkbox" id="selectAll" class="w-4 h-4 rounded border-gray-300 text-ink focus:ring-ink transition-all cursor-pointer">
                    <span class="text-xs font-bold text-gray-700">Pilih Semua</span>
                </label>
                <button type="submit" form="bulkTrashForm" id="bulkActionBtn" class="hidden items-center gap-2 bg-red-50 hover:bg-red-500 text-red-600 hover:text-white px-4 py-2 rounded-xl text-xs uppercase tracking-wider font-black transition-colors border border-red-200 hover:border-red-500 shadow-sm" onclick="return confirm('Pindahkan berita yang dipilih ke Trash?')">
                    <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Trash <span id="selectedCount">0</span>
                </button>
            </div>
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

        @forelse($articles as $categoryName => $categoryArticles)
            <div class="mb-12 last:mb-0">
                <div class="flex items-center gap-3 mb-6">
                    <h3 class="text-lg md:text-xl font-serif font-bold text-gray-900">{{ $categoryName }}</h3>
                    <span class="bg-surface-2 text-ink-muted text-xs font-bold px-2.5 py-1 rounded-lg border border-border-light">{{ count($categoryArticles) }} Berita</span>
                    <div class="flex-1 h-px bg-border-light/50"></div>
                </div>

                <div class="space-y-4">
                    @foreach($categoryArticles as $article)
                        <div class="glass-card rounded-2xl overflow-hidden hover:shadow-card-hover transition-all duration-300 flex flex-col md:flex-row items-start md:items-center justify-between p-5 gap-4 border border-white/40">
                            <!-- Left: Select + Title + Metadata -->
                            <div class="flex items-start gap-4 flex-1 min-w-0">
                                <!-- Checkbox -->
                                <input type="checkbox" name="ids[]" value="{{ $article->id }}" form="bulkTrashForm" class="article-checkbox w-5 h-5 rounded border-2 border-border-light text-ink focus:ring-ink transition-all bg-white cursor-pointer mt-1 md:mt-0">
                                
                                <div class="flex-1 min-w-0">
                                    <!-- Badges & Metadata -->
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1.5 mb-2">
                                        @if($article->category)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-black shadow-sm" style="background: {{ $article->category->color }}dd; color: #fff;">{{ $article->category->name }}</span>
                                        @endif
                                        @if($article->featured)
                                            <span class="bg-emerald-500/90 text-white px-2 py-0.5 rounded text-[9px] uppercase tracking-wider font-black shadow-sm">★ Featured</span>
                                        @endif
                                        <span class="text-[11px] font-bold text-ink-muted flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                            {{ $article->user->name ?? 'Unknown' }}
                                        </span>
                                        <span class="text-[11px] font-bold text-ink-muted">•</span>
                                        <span class="text-[11px] font-bold text-ink-muted flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ $article->created_at->format('d M y') }}
                                        </span>
                                        <span class="text-[11px] font-bold text-red-500 flex items-center gap-0.5">
                                            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                                            {{ $article->likes_count ?? $article->likes()->count() }}
                                        </span>
                                    </div>
                                    
                                    <!-- Title -->
                                    <h4 class="text-base md:text-lg font-serif font-bold text-gray-900 leading-tight line-clamp-1" title="{{ $article->title }}">{{ $article->title }}</h4>
                                </div>
                            </div>

                            <!-- Right: Actions -->
                            <div class="flex flex-wrap sm:flex-nowrap items-center gap-2 w-full md:w-auto border-t md:border-t-0 border-border-light border-dashed pt-3 md:pt-0 shrink-0">
                                <a href="{{ route('artikel.show', $article->id) }}" class="flex-1 md:flex-none text-center bg-ink hover:bg-ink-dark text-surface px-4 py-2 rounded-xl text-xs font-black transition-colors" title="Lihat">Lihat</a>
                                <a href="{{ route('admin.edit', $article->id) }}" class="flex-1 md:flex-none text-center bg-surface hover:bg-surface-2 text-ink border border-border-light px-4 py-2 rounded-xl text-xs font-black transition-colors" title="Edit">Edit</a>
                                
                                @if($article->featured)
                                <div class="flex items-center justify-center bg-amber-50 text-amber-500 border border-amber-200 p-2.5 rounded-xl shrink-0 cursor-default" title="Artikel Utama (Featured)">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"></path>
                                    </svg>
                                </div>
                                @else
                                <form action="{{ route('admin.setFeatured', $article->id) }}" method="POST" class="flex-1 md:flex-none">
                                    @csrf
                                    <button class="w-full flex items-center justify-center bg-gray-50 hover:bg-amber-50 text-gray-400 hover:text-amber-500 border border-gray-200 hover:border-amber-300 p-2.5 rounded-xl transition-all" title="Set sebagai Featured" onclick="return confirm('Set sebagai featured?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.907c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.906a1 1 0 00.95-.69l1.519-4.674z"></path>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                                
                                <form action="{{ route('admin.destroy', $article->id) }}" method="POST" class="flex-1 md:flex-none">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-full bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white px-3 py-2 rounded-xl text-[10px] uppercase tracking-wider font-black transition-colors border border-amber-200 hover:border-amber-500" onclick="return confirm('Turunkan berita ini ke Tempat Sampah?')">Turunkan</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="glass-card rounded-3xl p-16 text-center border border-white/40 flex flex-col items-center justify-center">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-surface-2 border border-border-light mb-5 shadow-sm">
                    <svg class="w-10 h-10 text-ink-muted/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 4v6h6"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14h6"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 10h6"></path></svg>
                </div>
                <h3 class="text-xl font-black text-ink mb-2">Belum Ada Berita</h3>
                <p class="text-ink-muted max-w-sm mx-auto">Tidak ada satupun berita yang tayang saat ini. Berita yang sudah tayang akan muncul di sini.</p>
            </div>
        @endforelse

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectAll = document.getElementById('selectAll');
                const checkboxes = document.querySelectorAll('.article-checkbox');
                const bulkActionBtn = document.getElementById('bulkActionBtn');
                const selectedCount = document.getElementById('selectedCount');

                function updateBulkButton() {
                    const checkedList = document.querySelectorAll('.article-checkbox:checked');
                    if (checkedList.length > 0) {
                        bulkActionBtn.classList.remove('hidden');
                        bulkActionBtn.classList.add('flex');
                        selectedCount.textContent = checkedList.length;
                    } else {
                        bulkActionBtn.classList.add('hidden');
                        bulkActionBtn.classList.remove('flex');
                    }
                }

                if(selectAll) {
                    selectAll.addEventListener('change', function() {
                        checkboxes.forEach(cb => cb.checked = this.checked);
                        updateBulkButton();
                    });
                }

                checkboxes.forEach(cb => {
                    cb.addEventListener('change', function() {
                        if (!this.checked) selectAll.checked = false;
                        if (document.querySelectorAll('.article-checkbox:checked').length === checkboxes.length) selectAll.checked = true;
                        updateBulkButton();
                    });
                });
            });
        </script>

    </x-admin-sidebar>
