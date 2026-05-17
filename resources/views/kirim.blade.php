<x-app-layout>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <div class="min-h-screen bg-[#fafafa] pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 md:py-10">

            <h1 class="text-2xl md:text-3xl font-serif font-bold text-[#bd2828] mb-2 text-center md:text-left">
                Bagikan Cerita Anda Hari Ini
            </h1>

            <div class="bg-red-50 border-l-4 border-[#bd2828] p-3 md:p-4 rounded-r-md mb-6 flex items-start gap-3">
                <span class="text-[#bd2828] font-bold text-base md:text-lg">ℹ</span>
                <div class="text-xs md:text-sm text-gray-700">
                    <p class="font-bold text-[#bd2828]">Artikel Anda akan ditinjau oleh tim editorial kami sebelum diterbitkan.</p>
                    <p class="opacity-90 mt-0.5">Proses moderasi biasanya memakan waktu 2-4 jam kerja. Pastikan berita Anda akurat dan objektif.</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-200 text-red-800 p-4 rounded-md mb-6 shadow-sm text-sm">
                    <p class="font-bold mb-2">Mohon perbaiki kesalahan berikut:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">

                <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data" class="lg:col-span-2 bg-white p-4 sm:p-6 rounded-xl border border-gray-200 shadow-sm space-y-5 md:space-y-6">
                    @csrf

                    <div>
                        <label class="block text-[11px] md:text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 md:mb-2">Judul Berita *</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Masukkan judul berita yang informatif dan menarik..." class="w-full bg-white border border-gray-300 rounded-md py-2.5 px-3 md:px-4 text-sm focus:outline-none focus:ring-1 focus:ring-[#bd2828] focus:border-[#bd2828]" required>
                    </div>

                    <div>
                        <label class="block text-[11px] md:text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 md:mb-2">Kategori Berita *</label>
                        <select name="category_id" class="w-full bg-white border border-gray-300 rounded-md py-2.5 px-3 md:px-4 text-sm focus:outline-none focus:ring-1 focus:ring-[#bd2828] focus:border-[#bd2828] text-gray-700" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories ?? [] as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] md:text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 md:mb-2">Unggah Gambar Utama (Opsional)</label>
                        <div class="relative border-2 border-dashed border-gray-300 rounded-md bg-gray-50 hover:bg-gray-100 transition cursor-pointer flex flex-col items-center justify-center p-4 sm:p-6 min-h-[140px] overflow-hidden text-center group">
                            <input type="file" id="imageInput" accept="image/png, image/jpeg, image/jpg" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                            <input type="hidden" name="cropped_image" id="croppedImage" value="{{ old('cropped_image') }}">

                            <div id="previewArea" class="hidden flex-col items-center z-10 w-full h-full">
                                <img id="finalPreview" src="" alt="Preview" class="h-32 sm:h-40 w-auto object-contain rounded mb-3 shadow-sm border border-gray-200">
                                <span class="text-[10px] md:text-xs font-bold text-[#bd2828] bg-white border border-gray-200 px-3 py-1 rounded-full shadow-sm group-hover:bg-gray-50 transition">Ganti Gambar</span>
                            </div>

                            <div id="placeholderArea" class="flex flex-col items-center text-gray-500 z-10 pointer-events-none">
                                <svg class="w-8 h-8 md:w-10 md:h-10 mb-2 md:mb-3 text-[#bd2828] opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="text-xs md:text-sm font-bold text-gray-800">Tarik & Lepas Gambar ke Sini</p>
                                <p class="text-[10px] md:text-xs mt-1 text-gray-500">Atau klik untuk memilih file (Maks. 2MB, format JPG/PNG)</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] md:text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5 md:mb-2">Isi Berita *</label>
                        
                        <div class="border border-gray-300 rounded-t-md bg-gray-50 p-2.5 flex items-center gap-3 md:gap-4 border-b-0 text-xs md:text-sm font-bold text-gray-700">
                            <button type="button" class="hover:text-[#bd2828] px-1 font-black">B</button>
                            <button type="button" class="hover:text-[#bd2828] px-1 font-serif italic">I</button>
                            <button type="button" class="hover:text-[#bd2828] px-1 underline">U</button>
                            <span class="text-gray-300">|</span>
                            <button type="button" class="hover:text-[#bd2828] px-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                            </button>
                            <button type="button" class="hover:text-[#bd2828] px-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.658 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            </button>
                        </div>
                        
                        <textarea name="content" rows="12" placeholder="Tuliskan berita lengkap Anda di sini secara objektif dan mendalam..." class="w-full bg-white border border-gray-300 rounded-b-md py-3 px-4 text-sm focus:outline-none focus:ring-1 focus:ring-[#bd2828] focus:border-[#bd2828] resize-y" required>{{ old('content') }}</textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full md:w-auto inline-flex justify-center items-center gap-2 bg-[#bd2828] text-white px-8 py-3 rounded-md hover:bg-red-800 transition font-bold text-sm shadow-sm cursor-pointer">
                            Kirim Berita 
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </div>

                </form>

                <div class="space-y-4 md:space-y-6">
                    <div class="bg-red-50/30 p-4 md:p-5 rounded-xl border border-red-100 shadow-sm">
                        <h3 class="font-serif font-bold text-base md:text-lg text-[#bd2828] border-b border-red-100 pb-2 md:pb-3 mb-3 md:mb-4 flex items-center gap-2">
                            📖 Panduan Penulisan
                        </h3>
                        <ol class="text-[11px] md:text-xs text-gray-700 space-y-3 md:space-y-4 list-decimal pl-4 md:pl-5 leading-relaxed">
                            <li><strong class="text-gray-900">5W+1H:</strong> Pastikan berita mengandung Unsur What, Who, When, Where, Why, dan How.</li>
                            <li><strong class="text-gray-900">Verifikasi:</strong> Selalu cek fakta dari minimal dua sumber independen yang kredibel.</li>
                            <li><strong class="text-gray-900">Bahasa:</strong> Gunakan Bahasa Indonesia yang baik dan benar sesuai PUEBI.</li>
                        </ol>
                    </div>

                    <div class="bg-red-50/30 p-4 md:p-5 rounded-xl border border-red-100 shadow-sm">
                        <h3 class="font-serif font-bold text-base md:text-lg text-[#bd2828] border-b border-red-100 pb-2 md:pb-3 mb-3 md:mb-4 flex items-center gap-2">
                            🛡️ Etika Jurnalistik
                        </h3>
                        <p class="text-[11px] md:text-xs italic text-gray-600 mb-3 md:mb-4 leading-relaxed font-serif">
                            "Kebebasan pers harus disertai dengan tanggung jawab moral kepada masyarakat."
                        </p>
                        <ul class="text-[11px] md:text-xs text-gray-700 space-y-2 md:space-y-2.5">
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-[#bd2828] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Tidak memuat konten SARA atau hoaks.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-[#bd2828] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Menghormati privasi narasumber.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-[#bd2828] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Objektif dan tidak memihak.</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="cropperModal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-sm z-50 p-4 flex items-center justify-center">
        <div class="bg-white max-w-3xl w-full rounded-xl p-5 md:p-6 shadow-2xl">
            <h3 class="text-xl font-serif font-bold text-gray-900 mb-1">Potong & Atur Gambar</h3>
            <p class="text-xs text-gray-500 mb-4">Posisikan gambar dengan rasio 2:1 agar tampil optimal di halaman beranda.</p>
            
            <div class="w-full h-[50vh] bg-gray-100 rounded-lg overflow-hidden border border-gray-200 flex items-center justify-center">
                <img id="cropImage" class="block max-w-full max-h-full">
            </div>
            
            <div class="mt-5 flex justify-end gap-3">
                <button type="button" id="cancelCropBtn" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-5 py-2.5 rounded-md text-sm font-bold transition">Batal</button>
                <button type="button" id="cropBtn" class="bg-[#bd2828] text-white hover:bg-red-800 px-5 py-2.5 rounded-md text-sm font-bold transition shadow-sm">Terapkan Gambar</button>
            </div>
        </div>
    </div>

    <script>
        let cropper = null;
        const imageInput = document.getElementById('imageInput');
        const croppedImageInput = document.getElementById('croppedImage');
        
        const previewArea = document.getElementById('previewArea');
        const placeholderArea = document.getElementById('placeholderArea');
        const finalPreview = document.getElementById('finalPreview');

        const cropperModal = document.getElementById('cropperModal');
        const cropImage = document.getElementById('cropImage');
        const cropBtn = document.getElementById('cropBtn');
        const cancelCropBtn = document.getElementById('cancelCropBtn');

        // Jika ada old('cropped_image') dari validasi yang gagal, tampilkan previewnya
        if (croppedImageInput.value) {
            finalPreview.src = croppedImageInput.value;
            placeholderArea.classList.add('hidden');
            previewArea.classList.remove('hidden');
            previewArea.classList.add('flex');
        }

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validasi ukuran maks 2MB (opsional, sebagai pengaman frontend)
                if (file.size > 2 * 1024 * 1024) {
                    alert("Ukuran gambar maksimal 2MB!");
                    this.value = "";
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(event) {
                    cropImage.src = event.target.result;
                    cropImage.style.display = 'block';
                    cropImage.style.maxWidth = '100%';
                    
                    cropperModal.classList.remove('hidden');
                    if (cropper) cropper.destroy();
                    
                    // Inisialisasi CropperJS
                    cropper = new Cropper(cropImage, { 
                        aspectRatio: 2/1, 
                        autoCropArea: 0.9, 
                        viewMode: 1,
                        background: false,
                        zoomable: true,
                        scalable: false,
                        responsive: true 
                    });
                };
                reader.readAsDataURL(file);
            }
        });

        // Saat Tombol Terapkan di Modal di-klik
        cropBtn.addEventListener('click', function() {
            if (cropper) {
                // Konversi hasil crop ke Base64 (Kualitas 0.8)
                const canvas = cropper.getCroppedCanvas({ maxWidth: 1200, maxHeight: 600 });
                const base64Image = canvas.toDataURL('image/jpeg', 0.8);
                
                // Simpan ke input hidden untuk dikirim ke backend
                croppedImageInput.value = base64Image;
                
                // Tampilkan di area preview drag & drop
                finalPreview.src = base64Image;
                placeholderArea.classList.add('hidden');
                previewArea.classList.remove('hidden');
                previewArea.classList.add('flex');

                // Tutup Modal
                cropperModal.classList.add('hidden');
            }
        });

        // Saat Batal Crop
        cancelCropBtn.addEventListener('click', function() {
            cropperModal.classList.add('hidden');
            imageInput.value = '';
            if (cropper) { cropper.destroy(); cropper = null; }
        });
    </script>
</x-app-layout>