<x-app-layout>

    <div class="relative w-full h-[35vh] md:h-[45vh] bg-black overflow-hidden">
        @if($article->image)
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover opacity-75">
        @else
            <div class="w-full h-full bg-gray-800"></div>
        @endif
        
        <div class="absolute inset-0 bg-gradient-to-t from-[#fafafa] via-black/40 to-transparent"></div>

        <div class="absolute bottom-4 md:bottom-6 left-0 w-full px-4 sm:px-6 z-10">
            <div class="max-w-7xl mx-auto flex flex-col items-start">
                <a href="{{ route('home') }}" class="hidden md:inline-flex items-center text-white/80 hover:text-white font-bold text-sm mb-4 transition-colors group">
                    <svg class="w-4 h-4 mr-1.5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Kembali ke Beranda
                </a>

                @if($article->category)
                    <span class="bg-[#bd2828] text-white text-[10px] md:text-xs font-extrabold px-2.5 py-0.5 md:py-1 rounded tracking-wider uppercase mb-2 md:mb-3 inline-block shadow-sm">
                        {{ $article->category->name }}
                    </span>
                @endif
                <h1 class="text-xl sm:text-3xl md:text-5xl font-serif font-bold text-white drop-shadow-md leading-tight max-w-4xl">
                    {{ $article->title }}
                </h1>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 mt-6 md:mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-10 pb-16">

        <div class="lg:col-span-2 space-y-6 md:space-y-8">

            <a href="{{ route('home') }}" class="md:hidden inline-flex items-center text-[#bd2828] font-bold text-sm mb-2 transition-colors group">
                <svg class="w-4 h-4 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Kembali
            </a>

            <div class="bg-white p-4 border border-gray-200 rounded-xl shadow-sm flex flex-col sm:flex-row sm:items-center gap-4 justify-between">
                <div class="flex items-center gap-3">
                    @if($article->user && $article->user->avatar)
                        <img src="{{ asset('storage/' . $article->user->avatar) }}" class="w-10 h-10 rounded-full object-cover border border-gray-200 shrink-0">
                    @else
                        <div class="w-10 h-10 rounded-full bg-[#bd2828] text-white flex items-center justify-center font-bold text-sm shrink-0 select-none">
                            {{ strtoupper(substr($article->user->name ?? 'K', 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $article->user->name ?? 'Kontributor NDN' }}</p>
                        <p class="text-xs text-gray-400">Jurnalis Warga</p>
                    </div>
                </div>
                <div class="flex sm:flex-col justify-between sm:text-right text-xs text-gray-500 font-medium border-t sm:border-t-0 border-gray-100 pt-2 sm:pt-0 gap-1">
                    <p class="flex items-center gap-1 sm:justify-end">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $article->created_at->format('d M Y') }}
                    </p>
                    <p class="flex items-center gap-1 sm:justify-end">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        ~{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} Menit Baca
                    </p>
                </div>
            </div>

            <article class="bg-white p-5 sm:p-6 md:p-8 border border-gray-200 rounded-xl shadow-sm">
                <div class="prose prose-sm sm:prose-base max-w-none font-serif text-gray-800 leading-relaxed">
                    {!! $article->content !!}
                </div>
            </article>

            <div class="bg-white p-5 border border-gray-200 rounded-xl shadow-sm flex flex-col sm:flex-row gap-4 items-center justify-between text-center sm:text-left">
                <div class="space-y-1">
                    <h4 class="text-sm font-bold text-gray-800">Bagaimana menurut Anda berita ini?</h4>
                    <p class="text-xs text-gray-400">Suara Anda membantu kami meningkatkan kualitas jurnalisme.</p>
                </div>
                
                @auth
                    <button id="likeBtn" onclick="toggleLike({{ $article->id }})" class="flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-2.5 rounded-full font-bold text-sm transition shadow-sm border cursor-pointer shrink-0 {{ $article->isLikedBy(auth()->user()) ? 'bg-red-50 text-[#bd2828] border-[#bd2828]' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                        <span id="likeIcon" class="text-lg">{{ $article->isLikedBy(auth()->user()) ? '❤️' : '🤍' }}</span>
                        <span id="likeText"><span id="likeCountNum">{{ $article->likes_count }}</span> Likes</span>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-2.5 rounded-full font-bold text-sm transition shadow-sm border cursor-pointer shrink-0 bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100">
                        <span class="text-lg">🤍</span>
                        <span>{{ $article->likes_count }} Likes</span>
                    </a>
                @endauth
            </div>

            <div class="flex items-center gap-3 pt-2">
                <span class="text-xs font-bold text-gray-500 uppercase tracking-wider mr-2">Bagikan:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-200 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 0C4.477 0 0 4.484 0 10.017c0 4.905 3.692 8.997 8.716 9.529v-6.992h-2.736V12.47h2.736V9.717c0-2.706 1.612-4.204 4.064-4.204 1.176 0 2.388.223 2.388.223v2.624h-1.346c-1.326 0-1.738.823-1.738 1.669v2.008h2.958l-.472 2.997h-2.486v6.992C16.308 19.014 20 15.013 20 10.017 20 4.484 15.523 0 10 0z"></path></svg>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($article->title) }}" target="_blank" class="w-8 h-8 rounded-full bg-sky-100 text-sky-500 flex items-center justify-center hover:bg-sky-200 transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M19 4.74a7.981 7.981 0 01-2.357.646 4.11 4.11 0 001.804-2.27 8.049 8.049 0 01-2.606.996 4.022 4.022 0 00-7.34 2.748c0 .316.036.623.106.917A11.414 11.414 0 012.557 2.61a4.02 4.02 0 001.245 5.369A3.976 3.976 0 012 7.73v.052a4.019 4.019 0 003.22 3.938 4.008 4.008 0 01-1.815.069 4.03 4.03 0 003.756 2.791A8.073 8.073 0 010 8.557a11.372 11.372 0 006.167 1.81c7.4 0 11.435-6.145 11.435-11.465 0-.175-.004-.348-.013-.52a8.151 8.151 0 002.007-2.084z"></path></svg>
                </a>
                <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Tautan berhasil disalin!')" class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center hover:bg-gray-300 transition-colors" title="Salin Tautan">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                </button>
            </div>

            <div class="bg-white p-5 sm:p-6 border border-gray-200 rounded-xl shadow-sm space-y-6 mt-8" id="comments">
                <h3 class="font-serif font-bold text-base sm:text-lg text-gray-900 border-b border-gray-100 pb-3">
                    💬 Kolom Komentar ({{ $article->comments()->count() }})
                </h3>

                <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                    @forelse($article->comments()->whereNull('parent_id')->latest()->get() as $comment)
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-100 relative group">
                            <div class="flex justify-between items-center gap-2 mb-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-gray-800">{{ $comment->user->name }}</span>
                                    @if($comment->user_id === $article->user_id)
                                        <span class="bg-[#bd2828]/10 text-[#bd2828] text-[9px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wider">Penulis</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] text-gray-400 shrink-0">{{ $comment->created_at ? $comment->created_at->diffForHumans() : 'Baru saja' }}</span>
                                    @auth
                                        @if(auth()->id() === $comment->user_id || auth()->user()->is_admin)
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Hapus komentar ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-[10px] text-red-500 hover:text-red-700 font-bold">Hapus</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <p class="text-xs sm:text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $comment->content }}</p>

                            @auth
                                <button onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.toggle('hidden')" class="mt-2 text-[10px] font-bold text-gray-400 hover:text-[#bd2828] transition-colors flex items-center gap-1">
                                    Balas Tanggapan
                                </button>
                                <form id="reply-form-{{ $comment->id }}" action="{{ route('comments.store', $article->id) }}" method="POST" class="hidden mt-3 flex gap-2">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <input type="text" name="content" class="w-full bg-white border border-gray-300 rounded-md px-3 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-[#bd2828]" placeholder="Balas komentar {{ $comment->user->name }}..." required>
                                    <button type="submit" class="bg-gray-800 text-white px-3 py-1.5 rounded-md font-bold text-xs hover:bg-black transition">Kirim</button>
                                </form>
                            @endauth

                            @if($comment->replies->count() > 0)
                                <div class="mt-3 space-y-3 pl-4 border-l-2 border-gray-200">
                                    @foreach($comment->replies as $reply)
                                        <div class="bg-white p-3 rounded border border-gray-100 relative group">
                                            <div class="flex justify-between items-center mb-1">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-xs font-bold text-gray-800">{{ $reply->user->name }}</span>
                                                    @if($reply->user_id === $article->user_id)
                                                        <span class="bg-[#bd2828]/10 text-[#bd2828] text-[9px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wider">Penulis</span>
                                                    @endif
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[9px] text-gray-400">{{ $reply->created_at ? $reply->created_at->diffForHumans() : 'Baru saja' }}</span>
                                                    @auth
                                                        @if(auth()->id() === $reply->user_id || auth()->user()->is_admin)
                                                            <form action="{{ route('comments.destroy', $reply) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity" onsubmit="return confirm('Hapus balasan ini?')">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="text-[9px] text-red-500 hover:text-red-700 font-bold">Hapus</button>
                                                            </form>
                                                        @endif
                                                    @endauth
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-600 leading-relaxed">{{ $reply->content }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 italic text-center py-6 border border-dashed border-gray-200 rounded-lg bg-gray-50/50">Belum ada tanggapan. Jadilah yang pertama memberikan opini!</p>
                    @endforelse
                </div>

                <div class="mt-4 pt-4 border-t border-gray-100">
                    @auth
                        <form action="{{ route('comments.store', $article->id) }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                            @csrf
                            <input type="text" name="content" placeholder="Tulis opini atau tanggapan Anda..." class="w-full bg-white border border-gray-300 rounded-md px-4 py-2.5 text-sm focus:outline-none focus:ring-1 focus:ring-[#bd2828]" required>
                            <button type="submit" class="w-full sm:w-auto bg-[#bd2828] text-white px-6 py-2.5 rounded-md font-bold text-xs uppercase hover:bg-red-800 transition cursor-pointer shrink-0 text-center">Kirim</button>
                        </form>
                    @else
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                            <p class="text-sm text-gray-500 mb-3">Anda harus login untuk ikut berdiskusi.</p>
                            <a href="{{ route('login') }}" class="inline-block bg-[#bd2828] text-white px-5 py-2 rounded-md font-bold text-xs hover:bg-red-800 transition">Masuk Akun</a>
                        </div>
                    @endauth
                </div>
            </div>

            @php
                $relatedQuery = \App\Models\Article::where('id', '!=', $article->id)->where('status', 'approved');
                if ($article->category_id) {
                    $relatedQuery->where('category_id', $article->category_id);
                }
                $relatedArticles = $relatedQuery->latest()->limit(3)->get();
                if ($relatedArticles->count() < 3 && $article->category_id) {
                    $moreIds = $relatedArticles->pluck('id')->push($article->id)->toArray();
                    $more = \App\Models\Article::whereNotIn('id', $moreIds)->where('status', 'approved')->latest()->limit(3 - $relatedArticles->count())->get();
                    $relatedArticles = $relatedArticles->merge($more);
                }
            @endphp

            @if($relatedArticles->count() > 0)
                <div class="pt-8 border-t border-gray-200 mt-10">
                    <h3 class="font-serif font-bold text-xl text-gray-900 mb-6 flex items-center gap-2">
                        <span class="w-1 h-6 bg-[#bd2828] rounded"></span> Berita Terkait
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        @foreach($relatedArticles as $related)
                            <a href="{{ route('artikel.show', $related->id) }}" class="bg-white rounded-lg overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition group flex flex-col">
                                <div class="h-32 overflow-hidden bg-gray-100 shrink-0">
                                    @if($related->image)
                                        <img src="{{ $related->image_url }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @endif
                                </div>
                                <div class="p-4 flex-1 flex flex-col justify-between">
                                    <div>
                                        <span class="text-[9px] font-extrabold text-[#bd2828] uppercase tracking-wider block mb-1">{{ $related->category->name ?? 'UMUM' }}</span>
                                        <h4 class="font-bold text-sm text-gray-900 group-hover:text-[#bd2828] transition-colors line-clamp-2 leading-snug">{{ $related->title }}</h4>
                                    </div>
                                    <p class="text-[10px] text-gray-400 font-medium mt-3">{{ $related->created_at->format('d M Y') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

        <div class="w-full space-y-6">
            
            <div class="lg:sticky lg:top-24 space-y-6">
                
                <div class="bg-[#fafafa] p-5 md:p-6 rounded-xl border border-gray-200 shadow-sm">
                    <h3 class="font-serif font-bold text-base sm:text-lg text-gray-900 border-b border-gray-200 pb-3 mb-4">📌 Populer Hari Ini</h3>
                    
                    @php
                        // Query langsung untuk mengambil artikel terpopuler berdasarkan jumlah likes.
                        $popularArticles = \App\Models\Article::where('status', 'approved')
                            ->withCount('likes')
                            ->orderByDesc('likes_count')
                            ->orderByDesc('created_at')
                            ->limit(3)
                            ->get();
                    @endphp

                    <div class="divide-y divide-gray-100 space-y-4">
                        @forelse($popularArticles as $idx => $popArt)
                            <div class="pt-4 first:pt-0 group">
                                <div class="flex gap-4 items-start">
                                    <span class="text-2xl sm:text-3xl font-bold font-serif text-gray-200 group-hover:text-[#bd2828] transition leading-none shrink-0">0{{ $idx + 1 }}</span>
                                    <div class="min-w-0 flex-1">
                                        <span class="text-[9px] font-extrabold text-[#bd2828] uppercase block mb-0.5 tracking-wider">{{ $popArt->category->name ?? 'NASIONAL' }}</span>
                                        <a href="{{ route('artikel.show', $popArt->id) }}" class="font-serif font-bold text-xs sm:text-sm text-gray-900 line-clamp-2 hover:text-[#bd2828] transition leading-snug">{{ $popArt->title }}</a>
                                        <span class="text-[10px] text-gray-400 font-medium block mt-1">🕒 {{ $popArt->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-gray-400 italic">Belum ada data artikel populer.</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-[#bd2828] p-5 md:p-6 rounded-xl shadow-sm text-white">
                    <h3 class="font-serif font-bold text-lg mb-2">Tetap Terinformasi</h3>
                    <p class="text-xs text-red-100 mb-4 leading-relaxed">Dapatkan rangkuman berita terbaik langsung di email Anda setiap pagi.</p>
                    <form action="#" method="POST" class="space-y-3">
                        @csrf
                        <input type="email" placeholder="Alamat Email Anda" class="w-full bg-white text-gray-900 border-none rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-white/50" required>
                        <button type="button" class="w-full bg-white text-[#bd2828] font-bold text-xs uppercase tracking-wider py-2.5 rounded-md hover:bg-gray-100 transition">
                            Berlangganan
                        </button>
                    </form>
                </div>
                
            </div>

        </div>

    </div>

    <script>
        function toggleLike(articleId) {
            fetch(`/artikel/${articleId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
            })
            .then(r => r.json())
            .then(data => {
                const btn = document.getElementById('likeBtn');
                const icon = document.getElementById('likeIcon');
                const countNum = document.getElementById('likeCountNum');
                
                if (data.liked) {
                    btn.className = 'flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-2.5 rounded-full font-bold text-sm transition shadow-sm border cursor-pointer shrink-0 bg-red-50 text-[#bd2828] border-[#bd2828]';
                    icon.textContent = '❤️';
                } else {
                    btn.className = 'flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-2.5 rounded-full font-bold text-sm transition shadow-sm border cursor-pointer shrink-0 bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100';
                    icon.textContent = '🤍';
                }
                countNum.textContent = data.count;
            })
            .catch(err => {
                console.error("Gagal memproses like:", err);
                alert('Terjadi kesalahan saat memproses like.');
            });
        }
    </script>

</x-app-layout>