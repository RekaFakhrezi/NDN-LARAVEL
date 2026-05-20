<x-admin-sidebar>

        <h2 class="text-2xl md:text-3xl font-serif font-bold text-gray-900 mb-6">Berita Diturunkan</h2>

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

 

        @forelse($articles as $article)
            <div class="glass-card rounded-2xl p-5 mb-4 hover:shadow-card-hover transition-all">
                <h3 class="text-lg md:text-xl font-serif font-bold text-gray-900 mb-1">{{ $article->title }}</h3>
                <p class="text-ink-muted text-xs mb-2">
                    {{ $article->user->name ?? 'Unknown' }} • Diturunkan: {{ $article->updated_at->format('d M Y H:i') }}
                </p>
                <p class="text-ink-light text-sm line-clamp-2 mb-3">{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 150) }}</p>
                <div class="flex flex-wrap gap-2">
                    <form action="{{ route('admin.republish', $article->id) }}" method="POST" class="inline">
                        @csrf
                        <button class="bg-emerald-500 hover:bg-emerald-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold transition-colors" onclick="return confirm('Publish ulang?')">Publish Ulang</button>
                    </form>
                    <a href="{{ route('admin.edit', $article->id) }}" class="bg-surface hover:bg-surface-2 text-ink px-3 py-1.5 rounded-xl text-xs font-bold transition-colors border border-border-light">Edit</a>
                    <form action="{{ route('admin.destroy', $article->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-xl text-xs font-bold transition-colors" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="glass-card rounded-2xl p-12 text-center">
                <p class="text-ink-muted">Tidak ada berita yang diturunkan.</p>
            </div>
        @endforelse

    </x-admin-sidebar>
