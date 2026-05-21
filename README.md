<div align="center">

    # 🗞️ Nusantara Daily News (NDN)
    **Portal Berita Kolaboratif Berbasis Laravel**

    [![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
    [![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
    [![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
    [![Alpine.js](https://img.shields.io/badge/Alpine.js-3-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)

    *Suara Rakyat, Berita Terpercaya*

</div>


---

## 📖 Tentang Proyek

**Nusantara Daily News (NDN)** adalah platform portal berita kolaboratif yang memungkinkan siapa saja menjadi jurnalis warga. Pembaca dapat mengirimkan berita, yang kemudian melewati sistem moderasi oleh tim admin sebelum tayang di beranda utama.

Dibangun dengan filosofi desain premium — tipografi serif elegan, palet warna jurnalistik merah-putih (`#bd2828` & `#fafafa`), dan antarmuka yang responsif di semua ukuran layar.

---

## ✨ Fitur Utama

### 👥 Untuk Pembaca & Penulis
- 📰 **Beranda Dinamis** — Featured article, berita terkini, filter kategori & pencarian
- 📝 **Submit Berita** — Form penulisan berita dengan upload & crop gambar via Cropper.js
- 💬 **Komentar & Balasan** — Sistem komentar bersarang (*nested reply*)
- ❤️ **Sistem Like** — Like artikel secara real-time tanpa reload halaman (AJAX)
- 🔔 **Pusat Notifikasi** — Notifikasi untuk approval, penolakan, dan likes artikel
- 📋 **Artikel Saya** — Pantau status artikel yang sudah dikirim
- 👤 **Profil Publik** — Halaman profil penulis yang bisa dikunjungi

### 👑 Untuk Administrator
- 📊 **Dashboard Overview** — KPI cards: total berita, views, likes, pengguna, dan antrian pending
- ✅ **Antrean Moderasi** — Approve atau tolak artikel dengan notifikasi otomatis ke penulis
- 📁 **Manajemen Artikel** — Filter per kategori, set featured, turunkan, atau trash artikel
- 🏷️ **Manajemen Kategori** — CRUD kategori dengan color picker badge dinamis
- 📡 **Breaking News** — Kelola ticker berita bergerak di halaman utama
- 🗑️ **Tempat Sampah** — Restore atau hapus permanen beserta aset gambarnya
- 🔍 **Pencarian Admin** — Cari artikel di semua halaman admin secara langsung
- ☆ **Toggle Featured** — Set artikel utama dengan ikon bintang premium

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|---|---|
| **Backend** | Laravel 11 (PHP 8.2+) |
| **Frontend** | Blade Templating + Alpine.js |
| **Styling** | Tailwind CSS 3 + Vite |
| **Database** | MySQL / PostgreSQL |
| **Cloud Storage** | Supabase Storage (S3-compatible) |
| **Image Crop** | Cropper.js |
| **Font** | Playfair Display (Serif) + Inter (Sans) |

---

## 🗄️ Struktur Database

```
users               — Akun pengguna & admin
articles            — Artikel berita (status: pending/approved/unpublished/trashed)
categories          — Kategori berita dengan warna badge
article_likes       — Relasi many-to-many likes
comments            — Komentar & balasan bersarang
notifications       — Notifikasi in-app per pengguna
breaking_news       — Konten ticker breaking news
```

---

## 🚀 Instalasi Lokal

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL atau PostgreSQL
- Akun Supabase (untuk storage gambar)

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/RekaFakhrezi/NDN-LARAVEL.git
cd NDN-LARAVEL

# 2. Install dependensi PHP
composer install

# 3. Install dependensi Node.js
npm install

# 4. Salin file environment
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Konfigurasi database di file .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=ndn_laravel
# DB_USERNAME=root
# DB_PASSWORD=

# 7. Konfigurasi Supabase Storage di .env
# SUPABASE_URL=https://xxxxx.supabase.co
# SUPABASE_KEY=your-service-role-key
# SUPABASE_BUCKET=your-bucket-name

# 8. Jalankan migrasi
php artisan migrate

# 9. (Opsional) Isi data dummy
php artisan db:seed --class=DatabaseSeeder

# 10. Build assets frontend
npm run build

# 11. Jalankan server
php artisan serve
```

Buka browser di `http://localhost:8000`

### Development Mode

```bash
# Jalankan server PHP dan Vite secara bersamaan
php artisan serve
npm run dev
```

---

## ⚙️ Konfigurasi `.env` Penting

```env
APP_NAME="Nusantara Daily News"
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_DATABASE=ndn_laravel

# Supabase Storage
SUPABASE_URL=https://your-project.supabase.co
SUPABASE_KEY=your-service-role-key
SUPABASE_BUCKET=ndn-storage
SUPABASE_REGION=ap-southeast-1
```

---

## 👑 Membuat Akun Admin

Setelah register, set kolom `is_admin = 1` di tabel `users` secara langsung via database, atau gunakan Tinker:

```bash
php artisan tinker

# Di dalam Tinker:
\App\Models\User::where('email', 'admin@email.com')->update(['is_admin' => true, 'role' => 'admin']);
```

---

## 📁 Struktur Direktori Penting

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/               # Login & Register
│   │   ├── ArticleController.php
│   │   ├── CategoryController.php
│   │   ├── CommentController.php
│   │   ├── HomeController.php
│   │   ├── NotificationController.php
│   │   ├── ProfileController.php
│   │   └── AdminBreakingNewsController.php
│   └── Middleware/
└── Models/
    ├── Article.php
    ├── Category.php
    ├── Comment.php
    ├── Notification.php
    ├── ArticleLike.php
    └── User.php

resources/views/
├── admin/                      # Semua halaman Admin Panel
│   ├── overview.blade.php
│   ├── published.blade.php
│   ├── unpublished.blade.php
│   ├── trash.blade.php
│   ├── categories.blade.php
│   ├── breaking.blade.php
│   └── edit.blade.php
├── components/
│   ├── admin-sidebar.blade.php # Layout utama admin
│   └── app-layout.blade.php    # Layout utama publik
├── auth/                       # Login & Register
├── profile/                    # Halaman profil user
├── home.blade.php
├── detail.blade.php
├── kirim.blade.php
└── my-articles.blade.php

routes/
├── web.php                     # Semua route aplikasi
└── auth.php                    # Route login/register/logout
```

---

## 🔐 Sistem Otorisasi

| Route | Middleware | Akses |
|---|---|---|
| `/` `/artikel/*` `/penulis/*` | — | Semua pengunjung |
| `/submit` `/my-articles` `/profile` | `auth` | User yang login |
| `/admin/*` | `auth` + `admin` | Admin saja |

---

## 📜 Lisensi

Proyek ini merupakan karya akademis/portofolio pribadi.

---

<div align="center">
  <b>Nusantara Daily News</b> — Dibuat dengan ❤️ menggunakan Laravel
</div>