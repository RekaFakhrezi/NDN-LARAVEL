    <x-admin-sidebar>
        <div class="mb-6 md:mb-8">
            <h2 class="text-2xl md:text-3xl font-serif font-bold text-gray-900">Kelola Breaking News</h2>
            <p class="text-sm text-gray-500 mt-1">Atur teks berita berjalan (running text) yang tampil secara real-time di bagian atas situs.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 font-bold text-sm shadow-sm flex items-center gap-2 max-w-3xl">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden p-6 md:p-8 max-w-3xl" x-data="{ mode: '{{ $breakingNews->mode }}' }">
            <form method="POST" action="{{ route('admin.breaking.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">Tipe Breaking News</label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="relative flex flex-col p-4 bg-gray-50 border rounded-xl cursor-pointer hover:bg-gray-100/50 transition duration-200" :class="mode === 'custom' ? 'border-[#bd2828] bg-red-50/10' : 'border-gray-200'">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="mode" value="custom" x-model="mode" class="text-[#bd2828] focus:ring-[#bd2828] border-gray-300">
                                <span class="font-bold text-sm text-gray-900">Teks Kustom Manual</span>
                            </div>
                            <span class="text-[11px] text-gray-500 mt-2 ml-7 leading-relaxed">Masukkan teks pengumuman atau berita secara manual dan bebas.</span>
                        </label>

                        <label class="relative flex flex-col p-4 bg-gray-50 border rounded-xl cursor-pointer hover:bg-gray-100/50 transition duration-200" :class="mode === 'article' ? 'border-[#bd2828] bg-red-50/10' : 'border-gray-200'">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="mode" value="article" x-model="mode" class="text-[#bd2828] focus:ring-[#bd2828] border-gray-300">
                                <span class="font-bold text-sm text-gray-900">Pilih dari Berita Populer</span>
                            </div>
                            <span class="text-[11px] text-gray-500 mt-2 ml-7 leading-relaxed">Pilih dari daftar berita yang sedang populer/hangat saat ini.</span>
                        </label>
                    </div>
                </div>

                <!-- Mode Teks Kustom -->
                <div x-show="mode === 'custom'" x-cloak x-transition:enter="transition duration-200 ease-out" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-2">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider">Isi Teks Kustom</label>
                    <textarea name="content" rows="4" class="w-full bg-gray-50 border border-gray-300 rounded-lg py-2.5 px-3 focus:border-[#bd2828] focus:ring-1 focus:ring-[#bd2828] text-sm text-gray-800" placeholder="Ketik breaking news di sini... Gunakan pemisah ' • ' untuk memisahkan antar berita.">{{ old('content', $breakingNews->content) }}</textarea>
                    <p class="text-[11px] text-gray-400 font-medium">Contoh: Ibukota Nusantara Siap Diresmikan Bulan Depan. • Nilai Tukar Rupiah Menguat. • NDN</p>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>

                <!-- Mode Artikel Terpilih -->
                <div x-show="mode === 'article'" x-cloak x-transition:enter="transition duration-200 ease-out" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-2">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider">Pilih Berita Utama / Populer</label>
                    <select name="article_id" class="w-full bg-gray-50 border border-gray-300 rounded-lg py-3 px-3.5 focus:border-[#bd2828] focus:ring-1 focus:ring-[#bd2828] text-sm text-gray-800 font-medium">
                        <option value="">-- Pilih Artikel Populer --</option>
                        @foreach($articles as $art)
                            <option value="{{ $art->id }}" {{ old('article_id', $breakingNews->article_id) == $art->id ? 'selected' : '' }}>
                                [{{ $art->category->name ?? 'BERITA' }}] {{ \Illuminate\Support\Str::limit($art->title, 60) }} (🔥 {{ $art->likes_count }} Suka • 👁️ {{ $art->view_count }} Views)
                            </option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-gray-400 font-medium">Berita populer diurutkan berdasarkan interaksi Like terbanyak. Judul berita terpilih akan otomatis tampil di running text navbar.</p>
                    <x-input-error :messages="$errors->get('article_id')" class="mt-2" />
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end">
                    <button type="submit" class="bg-[#bd2828] text-white px-6 py-2.5 rounded-lg font-bold text-sm hover:bg-red-800 transition shadow-md cursor-pointer flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </x-admin-sidebar>
