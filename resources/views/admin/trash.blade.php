<x-admin-sidebar>

    <!-- Form Bulk Destroy (Hapus Permanen) -->
    <form action="{{ route('admin.bulkDestroy') }}" method="POST" id="bulkDestroyForm">
        @csrf
        @method('DELETE')
    </form>

    <!-- Header Halaman dengan Pilih Semua & Aksi Massal di Kanan -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl md:text-3xl font-serif font-bold text-gray-900">Tempat Sampah (Trash)</h2>
            <p class="text-xs text-gray-500 mt-1">Daftar artikel yang telah ditolak atau dihapus secara manual.</p>
        </div>
        
        <div class="flex items-center gap-3 self-end sm:self-auto">
            <label class="flex items-center gap-2 cursor-pointer bg-white border border-gray-200 px-4 py-2.5 rounded-xl shadow-sm hover:bg-gray-50 transition-all">
                <input type="checkbox" id="selectAll" class="w-4 h-4 rounded border-gray-300 text-[#bd2828] focus:ring-[#bd2828] transition-all cursor-pointer">
                <span class="text-xs font-bold text-gray-700 select-none">Pilih Semua</span>
            </label>
            <button type="submit" form="bulkDestroyForm" id="bulkActionBtn" class="hidden items-center gap-1.5 bg-red-50 hover:bg-red-600 text-red-600 hover:text-white px-4 py-2.5 rounded-xl text-xs uppercase tracking-wider font-bold transition-all border border-red-200 hover:border-red-500 shadow-sm" onclick="return confirm('HAPUS PERMANEN semua berita terpilih? Tindakan ini tidak dapat dibatalkan!')">
                <svg class="w-4 h-4 text-current" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Hapus Permanen (<span id="selectedCount">0</span>)
            </button>
        </div>
    </div>

    <!-- Filter & Pencarian Kontrol -->
    <div class="bg-white border border-gray-200 rounded-xl p-4 mb-6 shadow-sm">
        <form action="{{ route('admin.trash') }}" method="GET" class="flex flex-col sm:flex-row gap-3 items-center w-full">
            <div class="relative flex-1 w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari di tempat sampah..." class="w-full bg-gray-50 border border-gray-200 rounded-xl py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-[#bd2828] focus:ring-1 focus:ring-[#bd2828] focus:bg-white transition-all">
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
                <a href="{{ route('admin.trash') }}" class="text-xs font-bold text-[#bd2828] hover:underline whitespace-nowrap px-2">Reset Filter</a>
            @endif
        </form>
    </div>

    <!-- List Tempat Sampah (Card Horizontal) -->
    <div class="space-y-4">
        @forelse($articles as $article)
            <div class="bg-white border border-gray-200 rounded-xl p-5 md:p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col sm:flex-row gap-5 relative group border-l-4"
                 style="border-left-color: {{ $article->trashed_reason === 'rejected' ? '#ef4444' : '#f59e0b' }};">
                
                <!-- Checkbox Pemilihan Bulk di Kiri Card -->
                <div class="absolute top-5 left-5 sm:static sm:flex sm:items-center sm:shrink-0 z-10">
                    <input type="checkbox" name="ids[]" value="{{ $article->id }}" form="bulkDestroyForm" class="article-checkbox w-4 h-4 rounded border-gray-300 text-[#bd2828] focus:ring-[#bd2828] transition-all cursor-pointer bg-white">
                </div>

                <!-- Thumbnail Gambar di Kiri -->
                <div class="w-full sm:w-40 h-28 shrink-0 rounded-lg overflow-hidden bg-gray-100 border border-gray-200 relative ml-8 sm:ml-0">
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
                <div class="flex-1 min-w-0 ml-8 sm:ml-0">
                    <div class="flex items-center gap-2 mb-2">
                        @if($article->category)
                            <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider text-white shadow-sm" style="background: {{ $article->category->color }}dd;">
                                {{ $article->category->name }}
                            </span>
                        @endif
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider text-white shadow-sm"
                              style="background: {{ $article->trashed_reason === 'rejected' ? '#ef4444' : '#f59e0b' }};">
                            {{ $article->trashed_reason === 'rejected' ? 'REJECTED' : 'DELETED' }}
                        </span>
                        <span class="text-xs font-bold text-gray-400">{{ $article->updated_at->format('d M Y H:i') }}</span>
                    </div>

                    <h3 class="text-base md:text-lg font-serif font-bold text-gray-900 mb-1.5 group-hover:text-[#bd2828] transition-colors line-clamp-1" title="{{ $article->title }}">
                        <a href="{{ route('artikel.show', $article->id) }}">{{ $article->title }}</a>
                    </h3>

                    <p class="text-xs text-gray-500 font-medium mb-3">
                        Oleh: <span class="font-bold text-gray-700">{{ $article->user->name ?? 'Anonim' }}</span>
                        <span class="mx-2 text-gray-300">|</span>
                        ❤️ {{ $article->likes_count ?? $article->likes()->count() }} Likes
                        <span class="mx-2 text-gray-300">|</span>
                        👁️ {{ number_format($article->view_count ?? 0) }} Views
                    </p>

                    <p class="text-xs md:text-sm text-gray-600 line-clamp-2 leading-relaxed">
                        {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 180) }}
                    </p>
                </div>

                <!-- Tombol Aksi di Kanan -->
                <div class="flex flex-row sm:flex-col gap-2 shrink-0 w-full sm:w-32 justify-end sm:justify-start pt-4 sm:pt-0 border-t sm:border-t-0 sm:border-l border-gray-100 sm:pl-5 ml-8 sm:ml-0">
                    <form action="{{ route('admin.restore', $article->id) }}" method="POST" class="flex-1 sm:flex-none">
                        @csrf
                        <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-2 rounded-lg text-xs font-bold transition-all shadow-sm" onclick="return confirm('Pulihkan berita ini?')">
                            Pulihkan
                        </button>
                    </form>
                    <a href="{{ route('admin.edit', $article->id) }}" class="flex-1 sm:flex-none text-center bg-gray-50 hover:bg-gray-100 text-gray-700 border border-gray-200 px-3 py-2 rounded-lg text-xs font-bold transition-all" title="Edit">
                        Edit
                    </a>
                    <form action="{{ route('admin.permanentDelete', $article->id) }}" method="POST" class="flex-1 sm:flex-none">
                        @csrf
                        @method('DELETE')
                        <button class="w-full bg-red-50 hover:bg-red-500 text-red-600 hover:text-white px-3 py-2 rounded-lg text-xs font-bold transition-all border border-red-200 hover:border-red-500" onclick="return confirm('HAPUS PERMANEN berita ini?')">
                            Hapus Permanen
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="bg-white border-2 border-dashed border-gray-300 rounded-xl p-16 text-center flex flex-col items-center justify-center shadow-sm">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-50 border border-gray-200 mb-5 shadow-sm">
                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l6 6v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 4v6h6"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2 font-serif">Belum Ada Berita</h3>
                <p class="text-gray-500 max-w-sm mx-auto text-sm">Tempat sampah kosong atau tidak ada berita yang cocok dengan filter pencarian saat ini.</p>
            </div>
        @endforelse
    </div>

    <!-- Script Handling Select All & Bulk Action -->
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
                    bulkActionBtn.classList.add('inline-flex');
                    selectedCount.textContent = checkedList.length;
                } else {
                    bulkActionBtn.classList.add('hidden');
                    bulkActionBtn.classList.remove('inline-flex');
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
