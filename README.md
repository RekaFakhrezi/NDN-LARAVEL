<div align="center">

# 🗞️ Nusantara Daily News (NDN)
**Portal Berita Kolaboratif Premium Berbasis Laravel 11**

[![Laravel 11](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP 8.2+](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)

*Suara Rakyat, Berita Terpercaya. Platform Jurnalisme Warga dengan Estetika Visual Kelas Dunia.*

</div>

---

## 📖 Tentang Proyek

**Nusantara Daily News (NDN)** adalah platform portal berita kolaboratif modern yang memberdayakan masyarakat untuk menjadi jurnalis warga (*citizen journalist*). Pengguna dapat menulis dan mengirimkan berita secara langsung, yang kemudian akan ditinjau dan dimoderasi oleh tim administrator sebelum diterbitkan secara luas di beranda utama.

Aplikasi ini dirancang dengan standar visual **Premium & Elegan** — memadukan keindahan tipografi klasik Playfair Display (Serif), modernitas Inter (Sans-serif), serta skema warna jurnalistik prestisius Merah Nusantara (`#bd2828`) dan Charcoal Gelap.

---

## ✨ Fitur Unggulan

### 👥 Untuk Penulis & Pembaca (Jurnalis Warga)
- 📰 **Beranda Dinamis & Interaktif** — Dilengkapi breaking news ticker, artikel utama pilihan (Featured), daftar berita terbaru, pencarian instan, dan filter kategori.
- 📝 **Tulis Berita (Cropper.js)** — Editor berita modern yang dilengkapi dengan fitur *upload* & *crop* gambar secara real-time sebelum dikirimkan.
- 💬 **Komentar Bersarang (*Nested Comments*)** — Sistem diskusi dua tingkat yang interaktif untuk memfasilitasi opini pembaca.
- ❤️ **Real-time AJAX Likes** — Menyukai artikel favorit secara instan tanpa perlu memuat ulang halaman (*zero page refresh*).
- 🔔 **Pusat Notifikasi Interaktif** — Notifikasi real-time untuk pembaruan status artikel (Disetujui/Ditolak beserta alasan feedback admin) dan notifikasi apresiasi suka (*likes*).
- 📋 **Ruang Penulis (Dashboard Saya)** — Kelola dan pantau status moderasi setiap artikel yang telah dikirimkan secara transparan.

### 👑 Untuk Administrator (Admin Panel Premium)
- 📊 **Dashboard Analitik (Overview)** — Kartu KPI interaktif untuk memantau performa situs: total berita, total tayangan (*views*), jumlah pembaca menyukai, total pengguna terdaftar, dan jumlah antrean moderasi aktif.
- ✅ **Antrean Moderasi Efektif** — Sistem tinjau artikel satu pintu yang memungkinkan admin menyetujui secara instan atau menolak dengan memberikan catatan feedback yang konstruktif kepada penulis.
- 📁 **Manajemen Berita Premium (Horizontal Card Row)** — Layout card baris modern yang rapi dan responsif pada menu *Published*, *Diturunkan*, dan *Tempat Sampah*.
- ☆ **Toggle Featured Unggulan** — Menetapkan berita utama terpilih hanya dengan sekali klik pada ikon bintang (★) premium yang melayang manis di atas gambar thumbnail artikel.
- 🏷️ **Manajemen Kategori Fleksibel** — CRUD kategori berita lengkap dengan picker warna hex badge dinamis untuk mempercantik klasifikasi topik.
- 🗑️ **Tempat Sampah (Trash Recovery)** — Fitur keamanan untuk memulihkan artikel yang tidak sengaja terhapus atau menghapusnya secara permanen sekaligus membersihkan sisa aset gambar di cloud.
- 📡 **Running Breaking News Ticker** — Kelola teks berjalan breaking news di halaman utama langsung dari dashboard.

---

## 🛠️ Tech Stack & Integrasi

| Komponen | Teknologi | Keterangan |
|---|---|---|
| **Backend Framework** | Laravel 11 | Framework PHP modern berkinerja tinggi |
| **Bahasa Pemrograman** | PHP 8.2+ | Dukungan fitur pengetikan kuat dan efisien |
| **Frontend Utilities** | Blade + Alpine.js | Reaktivitas antarmuka ringan dan cepat |
| **Desain & Styling** | Tailwind CSS 3 | Skema warna kustom HSL & transisi interaksi halus |
| **Database** | MySQL / PostgreSQL | Penyimpanan relasional terstruktur |
| **Cloud Storage** | Supabase Storage (S3 API) | Hosting media gambar artikel secara aman di cloud |
| **Pustaka Pemotong Gambar** | Cropper.js | Interaksi crop gambar yang presisi di sisi klien |
| **Tipografi** | Playfair Display & Inter | Perpaduan font serif editorial premium dan sans modern |

---

## 🗄️ Struktur Basis Data

Aplikasi ini menggunakan relasi database terstruktur untuk performa optimal:
- `users`: Menyimpan informasi pengguna (Jurnalis warga dan Administrator).
- `articles`: Menyimpan konten berita beserta status publikasinya (`pending`, `approved`, `unpublished`, `trashed`).
- `categories`: Menyimpan daftar kategori berita dengan warna badge kustom.
- `article_likes`: Relasi pivot *many-to-many* untuk mencatat apresiasi pengguna terhadap artikel.
- `comments`: Menyimpan komentar publik dan balasan bersarang (*parent-child relationship*).
- `notifications`: Menyimpan rekaman notifikasi in-app untuk interaksi pengguna.
- `breaking_news`: Menyimpan konfigurasi teks berjalan di beranda.

---

## 📁 Struktur Direktori Penting

Berikut adalah direktori utama yang mengontrol logika dan tampilan aplikasi:

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/                       # Manajemen Auth (Login, Register, dsb.)
│   │   ├── ArticleController.php       # Logika CRUD & Status Filter Artikel
│   │   ├── CategoryController.php      # Manajemen Kategori Berita
│   │   ├── CommentController.php       # Logika Komentar & Nested Reply
│   │   ├── HomeController.php          # Logika Render Beranda Utama & Breaking News
│   │   ├── NotificationController.php  # Pengendali Notifikasi In-App
│   │   ├── ProfileController.php       # Edit Profil & Informasi Penulis
│   │   └── AdminBreakingNewsController.php # Manajemen Ticker Breaking News
│   └── Middleware/
│       └── AdminMiddleware.php        # Proteksi hak akses Admin Panel
└── Models/
    ├── Article.php                     # Model Artikel (Fitur scopeSearch & scopeCategory)
    ├── Category.php                    # Model Kategori
    ├── Comment.php                     # Model Komentar
    ├── Notification.php                # Model Notifikasi
    ├── ArticleLike.php                 # Model Likes Pivot
    └── User.php                        # Model Pengguna & Relasi Hak Akses

resources/views/
├── admin/                              # Sub-halaman dashboard khusus Admin
│   ├── overview.blade.php              # KPI Analytics & Statistik Ringkas
│   ├── published.blade.php             # Berita Publish (Layout Baris Premium + Bintang Melayang)
│   ├── unpublished.blade.php           # Berita Diturunkan (Layout Baris Premium)
│   ├── trash.blade.php                 # Tempat Sampah (Layout Baris Premium + Bulk Action)
│   ├── categories.blade.php            # CRUD Kategori & Color Badge Preview
│   ├── breaking.blade.php              # Konfigurasi Teks Breaking News Ticker
│   └── edit.blade.php                  # Form Edit Artikel Khusus Admin
├── layouts/                            # Template struktur utama halaman
│   ├── navigation.blade.php            # Navbar utama yang simetris & responsif
│   ├── admin-sidebar.blade.php         # Sidebar khusus navigasi Admin Panel
│   └── guest.blade.php                 # Layout minimalis untuk Login/Register
├── components/                         # Komponen UI modular
│   └── app-layout.blade.php            # Wrapper layout portal utama publik
├── auth/                               # Form otentikasi pengguna
├── profile/                            # Pengaturan detail akun pengguna
├── home.blade.php                      # Beranda utama publik
├── detail.blade.php                    # Detail artikel berita lengkap + Form komentar
├── kirim.blade.php                     # Form tulis & upload berita (Fitur Cropper.js)
├── my-articles.blade.php               # Ruang kelola artikel jurnalis warga
├── notifications.blade.php             # Kotak masuk notifikasi pengguna
└── admin.blade.php                     # Antrean Moderasi Artikel (Reviewer Panel)

routes/
├── web.php                             # Jalur routing utama aplikasi & Admin
└── auth.php                            # Jalur routing otentikasi bawaan Laravel
```

---

## 🚀 Panduan Instalasi Lokal

### Prasyarat System
- PHP >= 8.2 (Pastikan ekstensi `gd` atau `imagick` aktif untuk pemrosesan gambar)
- Composer
- Node.js & NPM
- MySQL / MariaDB / PostgreSQL
- Bucket Supabase Storage yang telah dikonfigurasi secara publik

### Langkah-langkah Instalasi

1. **Unduh Repositori**
   ```bash
   git clone https://github.com/RekaFakhrezi/NDN-LARAVEL.git
   cd NDN-LARAVEL
   ```

2. **Pasang Dependensi PHP**
   ```bash
   composer install
   ```

3. **Pasang Dependensi Frontend**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   Salin berkas konfigurasi template ke `.env`:
   ```bash
   cp .env.example .env
   ```
   Buka berkas `.env` dan sesuaikan koneksi database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ndn_laravel
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   Masukkan kredensial Supabase Storage untuk meng-hosting berkas gambar:
   ```env
   SUPABASE_URL=https://your-project.supabase.co
   SUPABASE_KEY=your-service-role-api-key
   SUPABASE_BUCKET=ndn-storage
   ```

5. **Generate Kunci Aplikasi**
   ```bash
   php artisan key:generate
   ```

6. **Jalankan Migrasi & Database Seeder**
   ```bash
   php artisan migrate
   ```
   Isi database dengan data dummy awal (Artikel, User, Komentar, Kategori) untuk memudahkan testing:
   ```bash
   php artisan db:seed --class=DatabaseSeeder
   ```

7. **Kompilasi Aset Frontend**
   ```bash
   # Untuk development mode (hot-reloads)
   npm run dev
   
   # Untuk kompilasi siap produksi
   npm run build
   ```

8. **Nyalakan Server Lokal**
   ```bash
   php artisan serve
   ```
   Buka peramban browser Anda di alamat `http://localhost:8000`.

---

## 👑 Hak Akses Administrator

Untuk menguji fitur-fitur premium di Admin Panel, Anda harus memiliki akun berstatus admin. Daftarkan akun baru di menu Register, kemudian ubah perannya menjadi administrator dengan salah satu cara berikut:

### Opsi A: Menggunakan Laravel Tinker (Sangat Direkomendasikan)
Jalankan perintah ini di terminal proyek Anda:
```bash
php artisan tinker
```
Setelah console Tinker terbuka, jalankan perintah berikut (ganti email sesuai dengan akun yang Anda daftarkan):
```php
\App\Models\User::where('email', 'admin@example.com')->update(['is_admin' => true, 'role' => 'admin']);
```

### Opsi B: Mengubah Langsung Melalui Database Client
Buka phpMyAdmin, DBeaver, atau Navicat Anda, lalu masuk ke tabel `users` dan ubah nilai kolom `is_admin` menjadi `1` dan kolom `role` menjadi `admin`.

---

## 💡 Solusi Penanganan Error 419 (Page Expired) di Cloud Deployments

Jika Anda menemui kendala **Error 419 (Page Expired)** saat mencoba login/register ketika aplikasi di-deploy ke layanan cloud hosting (seperti **Laravel Cloud, Heroku, Cloudflare Pages, atau AWS**), hal tersebut disebabkan oleh ketidaksesuaian deteksi protokol HTTPS oleh server di balik proxy load balancer.

Kami telah menerapkan solusi permanen ini secara langsung di dalam core sistem:

1. **Proxy Trust Otomatis (Laravel 11)**
   Di dalam file `bootstrap/app.php`, kami telah mendaftarkan instruksi `trustProxies(at: '*')` sehingga aplikasi mempercayai header SSL yang diteruskan oleh sistem Cloud Proxy:
   ```php
   ->withMiddleware(function (Middleware $middleware) {
       $middleware->trustProxies(at: '*'); // Solusi Anti-Error 419
       $middleware->alias([
           'admin' => AdminMiddleware::class,
       ]);
   })
   ```

2. **Pemaksaan Skema HTTPS di Produksi**
   Di dalam `app/Providers/AppServiceProvider.php`, aplikasi secara cerdas akan memaksa semua URL dan Cookie menggunakan enkripsi aman HTTPS ketika mendeteksi lingkungan produksi (`production` mode):
   ```php
   if (config('app.env') === 'production') {
       URL::forceScheme('https');
   }
   ```

3. **Pengaturan Tambahan pada File `.env` Produksi**
   Pastikan Anda menambahkan baris berikut pada berkas `.env` di server hosting Anda:
   ```env
   APP_ENV=production
   APP_URL=https://nama-aplikasi-anda.laravel.cloud
   SESSION_SECURE_COOKIE=true
   ```

---

<div align="center">

**Nusantara Daily News** — Dibuat dengan dedikasi penuh dan ❤️ menggunakan Laravel.

</div>