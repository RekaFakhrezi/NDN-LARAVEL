<x-admin-sidebar>
    <div class="mb-8">
        <h2 class="text-2xl md:text-4xl font-serif font-bold text-gray-900 flex items-center gap-2">
            Selamat datang, Admin <span class="text-3xl">👋</span>
        </h2>
        <p class="text-sm text-gray-500 mt-2">Berikut adalah ringkasan performa portal berita NDN hari ini.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-10">
        <div class="bg-white rounded-xl p-5 border-l-4 border-l-[#bd2828] shadow-sm flex flex-col justify-between h-32">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Total Artikel</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl md:text-4xl font-black text-gray-900">{{ number_format($stats['published_articles'] ?? 0) }}</h3>
                <span class="text-[10px] font-bold text-green-600 mb-1">+ Aktif</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 border-l-4 border-l-[#eab308] shadow-sm flex flex-col justify-between h-32">
            <div class="flex justify-between items-start">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Menunggu Review</p>
                @if(($stats['pending_articles'] ?? 0) > 0)
                    <span class="bg-amber-100 text-amber-800 text-[9px] px-1.5 py-0.5 rounded font-bold">URGENT</span>
                @endif
            </div>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl md:text-4xl font-black text-gray-900">{{ number_format($stats['pending_articles'] ?? 0) }}</h3>
                <span class="text-amber-500 font-bold text-lg">!</span>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 border-l-4 border-l-[#22c55e] shadow-sm flex flex-col justify-between h-32">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Total Views</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl md:text-4xl font-black text-gray-900">{{ number_format($stats['total_views'] ?? 0) }}</h3>
                <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600 mb-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 border-l-4 border-l-[#3b82f6] shadow-sm flex flex-col justify-between h-32">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Total Pengguna</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl md:text-4xl font-black text-gray-900">{{ number_format($stats['total_users'] ?? 0) }}</h3>
                <svg class="w-6 h-6 text-blue-500 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden w-full">
        <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
            <h3 class="font-serif font-bold text-lg text-gray-900">Aktivitas Artikel Terbaru</h3>
            <a href="{{ route('admin.published') }}" class="text-[11px] md:text-xs font-bold text-[#bd2828] hover:underline flex items-center gap-1">
                Lihat Semua <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        <div class="overflow-x-auto no-scrollbar w-full">
            <table class="w-full text-left border-collapse min-w-[700px]">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-200">
                        <th class="px-5 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider w-2/5">Judul Artikel</th>
                        <th class="px-5 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Penulis</th>
                        <th class="px-5 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider text-center">Status</th>
                        <th class="px-5 py-3 text-[10px] font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentArticles as $article)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-5 py-4">
                                <p class="text-sm font-bold text-gray-900 truncate max-w-[250px] md:max-w-sm" title="{{ $article->title }}">{{ $article->title }}</p>
                                <p class="text-[10px] text-gray-400 mt-1">{{ $article->created_at ? $article->created_at->diffForHumans() : 'Baru saja' }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center text-[10px] font-bold shrink-0">
                                        {{ strtoupper(substr($article->user->name ?? 'A', 0, 1)) }}
                                    </div>
                                    <span class="text-xs font-medium text-gray-700">{{ $article->user->name ?? 'Anonim' }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-center">
                                @if($article->status === 'approved' || $article->status === 'published')
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Tayang
                                    </span>
                                @elseif($article->status === 'pending')
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-amber-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[10px] font-bold text-red-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Turun
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('artikel.show', $article->id) }}" class="px-3 py-1.5 bg-gray-100 text-gray-700 hover:text-black hover:bg-gray-200 text-[10px] md:text-xs font-bold rounded transition">Lihat</a>
                                    <a href="{{ route('admin.edit', $article->id) }}" class="px-3 py-1.5 bg-[#bd2828] text-white hover:bg-red-800 text-[10px] md:text-xs font-bold rounded transition shadow-sm">Edit</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-10 text-center">
                                <p class="text-sm text-gray-400 font-medium">Belum ada aktivitas berita terbaru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-sidebar>