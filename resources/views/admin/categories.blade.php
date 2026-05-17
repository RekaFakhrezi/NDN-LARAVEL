<x-admin-sidebar>
    <div class="mb-6 md:mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-serif font-bold text-gray-900">Manajemen Kategori</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola label kategori untuk mengelompokkan artikel berita.</p>
        </div>

        <button x-data x-on:click.prevent="$dispatch('open-modal', 'create-category')"
            class="bg-[#bd2828] text-white px-5 py-2.5 rounded-md font-bold text-sm hover:bg-red-800 transition shadow-sm flex items-center justify-center gap-2 w-full md:w-max">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Kategori
        </button>
    </div>

    @if(session('error'))
        <div
            class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md mb-6 font-bold text-sm flex justify-between items-center shadow-sm">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div
            class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md mb-6 font-bold text-sm flex justify-between items-center shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto no-scrollbar">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Nama Kategori
                        </th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider text-center">
                            Warna Label</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider text-center">
                            Total Berita</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-gray-500 uppercase tracking-wider text-right">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-6 py-4 font-bold text-gray-900 text-sm">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-gray-400 text-sm font-mono">
                                {{ $category->slug ?? Str::slug($category->name) }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="w-4 h-4 rounded border border-gray-200 shadow-sm"
                                        style="background-color: {{ $category->color ?? '#bd2828' }}"></span>
                                    <span
                                        class="text-[10px] text-gray-500 font-mono font-bold">{{ $category->color ?? '#bd2828' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-gray-100 text-gray-700 text-xs font-bold px-2.5 py-1 rounded-md">
                                    {{ $category->articles_count ?? $category->articles()->count() ?? 0 }} Berita
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Hapus kategori ini? Pastikan tidak ada berita yang masih menggunakan kategori ini.')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-red-50 text-red-600 hover:bg-red-100 px-3 py-1.5 rounded text-[10px] md:text-xs font-bold border border-red-200 transition-colors opacity-0 group-hover:opacity-100 focus:opacity-100">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm font-medium">Belum ada
                                kategori yang ditambahkan di dalam sistem.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <x-modal name="create-category" focusable>
        <form method="post" action="{{ route('admin.categories.store') }}"
            class="p-6 bg-white rounded-xl shadow-xl border border-gray-100">
            @csrf
            <h2 class="text-xl font-serif font-bold text-gray-900 mb-4 border-b border-gray-100 pb-3">Tambah Kategori
                Baru</h2>

            <div class="space-y-5">
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nama
                        Kategori</label>
                    <input type="text" name="name"
                        class="w-full bg-gray-50 border border-gray-300 rounded-md shadow-sm py-2.5 px-3 focus:border-[#bd2828] focus:ring-1 focus:ring-[#bd2828] text-sm text-gray-900"
                        placeholder="Misal: Politik, Ekonomi, Budaya..." required>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Warna
                        Kategori (Badge)</label>
                    <div class="flex items-center gap-3">
                        <input type="color" name="color" value="#bd2828"
                            class="w-12 h-10 rounded cursor-pointer border border-gray-300 p-0.5 bg-white shadow-sm">
                        <span class="text-xs font-medium text-gray-500">Warna ini akan digunakan pada badge/label
                            artikel di beranda.</span>
                    </div>
                    <x-input-error :messages="$errors->get('color')" class="mt-2" />
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3 pt-4 border-t border-gray-50">
                <button type="button" x-on:click="$dispatch('close')"
                    class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md font-bold text-xs transition">Batal</button>
                <button type="submit"
                    class="px-5 py-2.5 bg-[#bd2828] text-white hover:bg-red-800 rounded-md font-bold text-xs shadow-sm transition">Simpan
                    Kategori</button>
            </div>
        </form>
    </x-modal>

</x-admin-sidebar>