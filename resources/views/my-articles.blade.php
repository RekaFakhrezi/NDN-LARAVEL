<x-app-layout>
    <div class="min-h-screen bg-[#fafafa] pb-20 pt-6 md:pt-8 font-sans relative" x-data="{ 
            activeTab: 'semua',
            editModalOpen: false,
            editData: { id: '', title: '', category_id: '', content: '' }
         }">

        <div class="max-w-5xl mx-auto px-4 sm:px-6">

            <div class="text-[10px] md:text-xs text-gray-500 mb-2 md:mb-3 tracking-wide">
                Dashboard / <span class="font-bold text-[#bd2828]">Artikel Saya</span>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6 md:mb-8">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-serif font-bold text-gray-900">
                    <span class="border-b-4 border-[#bd2828] pb-1">Artikel</span> yang Saya Kirim
                </h1>
                <a href="{{ route('artikel.create') }}"
                    class="bg-[#a31d1d] text-white px-5 py-3 md:py-2.5 rounded-md font-bold text-sm flex items-center justify-center sm:justify-start gap-2 hover:bg-red-800 transition shadow-sm w-full sm:w-max">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Submit Berita Baru
                </a>
            </div>

            <div
                class="flex overflow-x-auto whitespace-nowrap sm:flex-wrap items-center gap-2 md:gap-3 mb-6 md:mb-8 pb-2 sm:pb-0 no-scrollbar">
                <button @click="activeTab = 'semua'"
                    :class="activeTab === 'semua' ? 'bg-[#a31d1d] text-white border-[#a31d1d]' : 'bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200'"
                    class="px-4 py-1.5 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold transition shadow-sm border cursor-pointer shrink-0">
                    Semua
                </button>
                <button @click="activeTab = 'pending'"
                    :class="activeTab === 'pending' ? 'bg-[#a31d1d] text-white border-[#a31d1d]' : 'bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200'"
                    class="px-4 py-1.5 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold transition shadow-sm border cursor-pointer shrink-0">
                    Pending
                </button>
                <button @click="activeTab = 'dipublikasikan'"
                    :class="activeTab === 'dipublikasikan' ? 'bg-[#a31d1d] text-white border-[#a31d1d]' : 'bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200'"
                    class="px-4 py-1.5 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold transition shadow-sm border cursor-pointer shrink-0">
                    Dipublikasikan
                </button>
                <button @click="activeTab = 'ditolak'"
                    :class="activeTab === 'ditolak' ? 'bg-[#a31d1d] text-white border-[#a31d1d]' : 'bg-gray-100 text-gray-600 border-transparent hover:bg-gray-200'"
                    class="px-4 py-1.5 md:px-6 md:py-2 rounded-full text-xs md:text-sm font-bold transition shadow-sm border cursor-pointer shrink-0">
                    Ditolak
                </button>
            </div>

            @if($articles->count() === 0)
                <div class="bg-white border-2 border-dashed border-gray-300 rounded-xl p-8 md:p-12 text-center">
                    <p class="text-gray-500 text-sm md:text-base font-medium">Kamu belum menulis berita apapun. Mulai
                        bagikan ceritamu!</p>
                </div>
            @else
                <div class="space-y-4 md:space-y-6">
                    @foreach($articles as $article)
                        @php
                            // Mapping Status Database ke Status UI
                            $uiStatus = 'PENDING';
                            $tabGroup = 'pending';
                            $statusColor = 'bg-orange-100 text-orange-700';

                            if ($article->status === 'approved') {
                                $uiStatus = 'DIPUBLIKASIKAN';
                                $tabGroup = 'dipublikasikan';
                                $statusColor = 'bg-green-100 text-green-700';
                            } elseif (in_array($article->status, ['trashed', 'rejected', 'unpublished'])) {
                                $uiStatus = 'DITOLAK';
                                $tabGroup = 'ditolak';
                                $statusColor = 'bg-red-100 text-red-700';
                            }
                        @endphp

                        <div x-show="activeTab === 'semua' || activeTab === '{{ $tabGroup }}'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-4"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            class="bg-white border border-gray-200 rounded-xl p-4 md:p-5 flex flex-col md:flex-row gap-4 md:gap-6 shadow-sm hover:shadow-md transition"
                            style="display: none;">

                            <div
                                class="w-full md:w-72 h-40 md:h-44 shrink-0 rounded-lg overflow-hidden border border-gray-100 bg-gray-50 flex items-center justify-center">
                                @if($article->image)
                                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                        class="w-full h-full object-cover" />
                                @else
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                @endif
                            </div>

                            <div class="flex-1 flex flex-col justify-between py-1 min-w-0">
                                <div>
                                    <div class="flex flex-wrap justify-between items-start gap-2 mb-2 md:mb-3">
                                        <span
                                            class="text-[9px] md:text-[10px] font-extrabold px-2 py-0.5 md:px-2.5 md:py-1 rounded tracking-widest {{ $statusColor }}">
                                            {{ $uiStatus }}
                                        </span>
                                        <span class="text-[10px] md:text-xs text-gray-500 font-medium shrink-0">
                                            {{ $article->created_at?->format('d M Y') ?? 'Belum ada tanggal' }}
                                        </span>
                                    </div>
                                    <h3
                                        class="text-lg md:text-xl font-serif font-bold text-gray-900 leading-snug line-clamp-2 md:pr-4">
                                        {{ $article->title }}</h3>
                                </div>

                                <div
                                    class="flex flex-col xl:flex-row xl:justify-between xl:items-end mt-4 md:mt-6 border-t border-gray-100 pt-3 md:pt-4 gap-4">

                                    <div
                                        class="flex items-center gap-3 md:gap-4 text-[11px] md:text-xs font-medium text-gray-500">
                                        @if($uiStatus === 'DIPUBLIKASIKAN')
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                {{ $article->view_count ?? 0 }} Pembaca
                                            </span>
                                        @elseif($uiStatus === 'PENDING')
                                            <span class="flex items-center gap-1.5 text-orange-600">
                                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6v6l4 2"></path>
                                                </svg>
                                                Menunggu review admin
                                            </span>
                                        @elseif($uiStatus === 'DITOLAK')
                                            <span class="flex items-center gap-1.5 text-red-600">
                                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Ditolak editorial / Dihapus
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex flex-wrap items-center gap-2 md:gap-3 w-full xl:w-auto">
                                        @if($uiStatus === 'DIPUBLIKASIKAN')
                                            <a href="{{ route('artikel.show', $article->id) }}"
                                                class="text-[#a31d1d] font-bold text-xs flex items-center justify-center gap-1 hover:underline w-full sm:w-auto py-2 sm:py-0 border sm:border-0 border-[#a31d1d] rounded sm:rounded-none transition">
                                                Lihat Artikel <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                </svg>
                                            </a>
                                        @endif

                                        @if($uiStatus === 'PENDING' || $uiStatus === 'DITOLAK')
                                            <button @click="editData = { 
                                                                    id: '{{ $article->id }}', 
                                                                    title: '{{ addslashes($article->title) }}', 
                                                                    category_id: '{{ $article->category_id }}', 
                                                                    content: `{{ addslashes($article->content) }}` 
                                                                }; editModalOpen = true"
                                                class="flex-1 sm:flex-none justify-center text-gray-700 font-bold text-[11px] md:text-xs flex items-center gap-1.5 hover:text-[#a31d1d] cursor-pointer bg-gray-100 px-3 py-2 md:py-1.5 rounded transition">
                                                Edit {{ $uiStatus === 'DITOLAK' ? 'Ulang' : 'Draft' }}
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                    </path>
                                                </svg>
                                            </button>

                                            <form action="{{ route('admin.destroy', $article->id) }}" method="POST"
                                                class="flex-1 sm:flex-none m-0"
                                                onsubmit="return confirm('Yakin ingin menghapus draf ini selamanya?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-full flex-1 sm:flex-none justify-center text-red-600 font-bold text-[10px] md:text-xs flex items-center gap-1 hover:bg-red-100 cursor-pointer bg-red-50 px-2 md:px-3 py-2 md:py-1.5 rounded border border-red-200 transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
            @endif

        </div>

        <div x-show="editModalOpen" style="display: none;"
            class="fixed inset-0 z-[100] flex items-center justify-center p-3 sm:p-6">
            <div x-show="editModalOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="absolute inset-0 bg-black/60 backdrop-blur-sm"
                @click="editModalOpen = false"></div>

            <div x-show="editModalOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="relative bg-white w-full max-w-3xl max-h-[90vh] md:max-h-[85vh] rounded-xl shadow-2xl flex flex-col overflow-hidden">

                <div class="flex justify-between items-center p-4 md:p-5 border-b border-gray-100 bg-gray-50">
                    <h2 class="text-lg md:text-xl font-serif font-bold text-gray-900">Revisi Artikel</h2>
                    <button @click="editModalOpen = false"
                        class="text-gray-400 hover:text-red-500 transition cursor-pointer p-1">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-4 md:p-6 overflow-y-auto flex-1 custom-scrollbar">
                    <div
                        class="bg-blue-50 text-blue-800 text-[11px] md:text-xs p-3 rounded mb-4 md:mb-5 border border-blue-200 flex items-start sm:items-center gap-2 leading-relaxed">
                        <svg class="w-4 h-4 md:w-5 md:h-5 shrink-0 mt-0.5 sm:mt-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Menyimpan perubahan akan mengembalikan status artikel menjadi "Pending" untuk ditinjau
                            ulang.</span>
                    </div>

                    <form id="editForm" :action="`/admin/artikel/${editData.id}`" method="POST"
                        class="space-y-4 md:space-y-5">
                        @csrf
                        @method('PUT') <div>
                            <label
                                class="block text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 md:mb-2">Judul
                                Berita</label>
                            <input type="text" name="title" x-model="editData.title"
                                class="w-full bg-white border border-gray-300 rounded-md py-2.5 md:py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#bd2828]"
                                required />
                        </div>
                        <div>
                            <label
                                class="block text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 md:mb-2">Kategori</label>
                            <select name="category_id" x-model="editData.category_id"
                                class="w-full bg-white border border-gray-300 rounded-md py-2.5 md:py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[#bd2828]"
                                required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories ?? [] as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 md:mb-2">Isi
                                Konten Berita</label>
                            <textarea name="content" rows="8" x-model="editData.content"
                                class="w-full bg-white border border-gray-300 rounded-md py-3 px-3.5 md:px-4 text-sm focus:outline-none focus:ring-1 focus:ring-[#bd2828] resize-y min-h-[150px] md:min-h-[200px]"
                                required></textarea>
                        </div>
                    </form>
                </div>

                <div
                    class="p-4 md:p-5 border-t border-gray-100 bg-white flex flex-col-reverse sm:flex-row justify-end gap-2 md:gap-3">
                    <button type="button" @click="editModalOpen = false"
                        class="w-full sm:w-auto px-5 py-2.5 md:py-2 text-sm font-bold text-gray-600 hover:bg-gray-100 rounded transition cursor-pointer text-center">
                        Batal
                    </button>
                    <button form="editForm" type="submit"
                        onclick="this.innerHTML='Menyimpan...'; this.classList.add('opacity-50')"
                        class="w-full sm:w-auto px-5 py-2.5 md:py-2 text-sm font-bold bg-[#a31d1d] text-white hover:bg-red-800 rounded transition shadow cursor-pointer flex items-center justify-center gap-2">
                        Simpan & Ajukan Ulang
                    </button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>