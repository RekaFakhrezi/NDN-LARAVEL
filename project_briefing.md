# Nusantara Daily News (NDN) — Project Technical & Functional Briefing

Dokumen ini berisi penjelasan lengkap mengenai alur kerja (*workflow*), arsitektur navigasi, fitur pengguna (*user*), panel administrator (*admin*), serta susunan teknologi (*tech stack*) yang digunakan pada platform portal berita **Nusantara Daily News (NDN)**.

---

## 🛠️ Tech Stack (Susunan Teknologi)

Aplikasi **Nusantara Daily News** dibangun menggunakan kombinasi teknologi modern dengan pendekatan performa tinggi, desain premium (*red/white clean theme*), serta fleksibilitas penyimpanan cloud.

| Layer | Teknologi | Peran / Deskripsi |
| :--- | :--- | :--- |
| **Backend Framework** | **Laravel 11** (PHP 8.2+) | Engine utama MVC, mengelola routing, keamanan middleware, autentikasi, model ORM (Eloquent), dan restrukturisasi database. |
| **Frontend Framework** | **Blade Templating & Alpine.js** | Blade mengelola layouting dan komponen reusable (seperti sidebar, navigasi, dan modal). Alpine.js menangani interaksi frontend yang ringan dan reaktif secara instan. |
| **Styling & Design** | **Tailwind CSS** | Menyajikan visual premium dengan palet warna harmonis (merah tua jurnalisme `#bd2828` dan putih bersih `#fafafa`), tipografi serif elegan untuk artikel, serta transisi mikro-animasi yang halus. |
| **Database** | **MySQL / PostgreSQL** | Menyimpan data terelasi secara terstruktur (Tabel Users, Articles, Categories, Comments, Likes, dan Notifications). |
| **Cloud Storage** | **Cloudflare R2 (S3-Compatible)** | Digunakan di server produksi (Laravel Cloud) untuk penyimpanan gambar artikel berkinerja tinggi, aman, dan tanpa biaya bandwidth keluar. |
| **Local Storage Dev** | **Supabase Storage (S3 API)** | Digunakan untuk mengunggah dan membaca aset media selama proses pengembangan lokal. |
| **Image Manipulation** | **Cropper.js** | Pustaka Javascript di sisi klien untuk memotong (*crop*) foto artikel secara presisi sebelum diunggah ke bucket storage. |

---

## 👥 Alur Kerja Pengguna Biasa (User / Author Workflow)

Ketika pengunjung biasa membuka Nusantara Daily News, berikut adalah alur interaksi dan kapabilitas yang mereka miliki:

```
[Pengunjung Umum]
       │
       ├─► Buka Web ──► [Halaman Utama / Home]
       │                       │
       │                       ├─► Pencarian / Kategori ──► [Filter Berita]
       │                       │
       │                       └─► Klik Artikel ──► [Halaman Detail Artikel]
       │
       └─► Login / Register ──► [Autentikasi User]
                                       │
                                       ├─► Kirim Berita ──► [Halaman Kirim Berita / Submit] ──► [Crop Gambar & Kirim] ──► [Menunggu Moderasi]
                                       │
                                       └─► Kelola Artikel ──► [Halaman Artikel Saya]
```

### 1. Halaman Utama (Beranda / Home)
*   **Breaking News Ticker:** Berada di bawah header utama, berupa teks bergerak (*running text*) berwarna merah menyala untuk memberikan kesan urgensi informasi.
*   **Pencarian Berita:** User dapat mengetik kata kunci pada bar pencarian untuk memfilter berita secara instan.
*   **Featured Article:** Menyorot satu berita utama paling penting dengan desain kartu berukuran besar di bagian atas beranda.
*   **Grid Berita Terkini:** Daftar artikel berita terbaru yang dilengkapi informasi:
    *   *Badge* Kategori (dengan warna label dinamis sesuai setingan admin).
    *   Nama Penulis (*Author*).
    *   Estimasi waktu baca (misal: `~2 Min Baca`).
    *   Jumlah *views* dan tanggal rilis.
    *   Tombol **"Baca Selengkapnya"** yang mengarahkan pembaca ke halaman detail artikel.
*   **Sidebar Terpopuler:** Menampilkan daftar 5 berita terpopuler yang diurutkan berdasarkan jumlah pembaca (*views count*) terbanyak.

### 2. Halaman Detail Artikel (`/artikel/{id}`)
*   **Header Hero Visual:** Foto artikel ditampilkan dalam ukuran besar dengan efek gradien transparan yang menyatu dengan latar belakang putih.
*   **Metadata Lengkap:** Informasi profil penulis (termasuk foto profil avatar), tanggal terbit, kategori, dan tombol kembali ke beranda.
*   **Sistem Interaksi:**
    *   **Like (Suka):** User dapat menekan ikon hati untuk menyukai berita. Sistem pencatatan menggunakan AJAX (Fetch API) sehingga jumlah *likes* bertambah secara instan tanpa memuat ulang seluruh halaman (*no reload*).
    *   **Kolom Komentar Dinamis:** Pembaca dapat mengirimkan komentar serta membalas komentar orang lain (*nested reply system*). Balasan komentar akan menjorok ke dalam secara visual agar alur diskusi rapi.

### 3. Halaman Kirim Berita (`/submit`)
*   Hanya dapat diakses oleh pengguna yang sudah melakukan login (terlindungi oleh middleware `auth`).
*   **Formulir Penulisan Berita:**
    1.  **Judul Berita:** Input teks dengan batas karakter aman.
    2.  **Kategori:** Dropdown dinamis yang bersumber dari database kategori.
    3.  **Isi Konten:** Textarea luas untuk menuliskan detail berita.
    4.  **Upload & Crop Gambar:** Ketika user memilih file gambar, preview gambar akan muncul di dalam modal interaktif menggunakan **Cropper.js**. User dapat memotong/menyesuaikan gambar ke rasio landscape yang ideal sebelum dikirim ke server dalam bentuk base64 aman.
*   **Status Awal:** Artikel yang dikirim tidak langsung tayang di beranda, melainkan berstatus `pending` untuk masuk ke antrean verifikasi admin.

### 4. Halaman Artikel Saya (`/my-articles`)
*   Menampilkan tabel ringkasan berita yang pernah dikirim oleh user tersebut beserta status aktualnya (`pending`, `approved`, `unpublished`, atau `trashed` / ditolak).

### 5. Pusat Notifikasi (`/notifications`)
*   Setiap kali ada kejadian penting, pengguna akan mendapatkan notifikasi real-time di database:
    *   Notifikasi jika artikel buatannya **Disetujui** (*Approved*) oleh Admin.
    *   Notifikasi jika artikel buatannya **Ditolak** (*Rejected*) atau **Diturunkan** (*Unpublished*).
    *   Notifikasi jika artikel buatannya **Disukai** oleh pengguna lain.
*   Badge angka jumlah notifikasi belum terbaca (*unread count*) akan berkedip (*animate-bounce*) di navbar utama.

---

## 👑 Alur Kerja Administrator (Admin Workflow & Panel)

Ketika user yang login memiliki status administrator (`is_admin = true` di database), sistem secara otomatis membuka akses penuh ke panel kontrol.

```
[User dengan is_admin = true] ──► [Tombol ADMIN PANEL Terbuka di Navbar]
                                               │
                                               ▼
                                  [Dashboard Overview /admin]
                                               │
             ┌───────────────────┬─────────────┴──────┬──────────────────┐
             ▼                   ▼                    ▼                  ▼
      [Antrean Moderasi]  [Manajemen Artikel]    [Kategori]       [Tempat Sampah]
       /admin/pending     /admin/published    /admin/categories     /admin/trash
```

### 1. Membuka Akses Admin Panel
*   Di pojok kanan atas navigasi utama, tombol **ADMIN PANEL** dengan warna merah tua elegan akan ter-unlock.
*   Tombol tersebut mengarah ke URL `/admin` yang dilindungi oleh middleware ganda `['auth', 'admin']` demi memastikan keamanan level tinggi.

### 2. Halaman Ringkasan Dashboard (`/admin`)
Menyajikan visualisasi data statistik menyeluruh tentang kesehatan portal berita:
*   **Statistik Utama (KPI Cards):** Total Seluruh Berita, Total Berita Tayang, Antrean Berita Tertunda, Total Akun Pengguna, Total Suka, dan Total Views Pembaca.
*   **Tabel Aktivitas Cepat:** Menampilkan 5 Berita Terbaru dan 5 Berita Paling Populer untuk dipantau secara kilat oleh admin.

### 3. Antrean Moderasi (`/admin/pending`)
Ini adalah jantung dari kontrol kualitas konten NDN. Menampilkan list artikel buatan author yang sedang menunggu persetujuan:
*   **Tombol Approve (Setujui):** Mengubah status artikel menjadi `approved`. Berita langsung tayang secara instan di beranda utama dan sistem otomatis mengirimkan notifikasi sukses ke akun author bersangkutan.
*   **Tombol Tolak (Reject):** Memindahkan artikel ke Tempat Sampah (*Trash*) dengan status `trashed` dan alasan penolakan `rejected`. Sistem otomatis mengirimkan notifikasi ke author bahwa beritanya ditolak.

### 4. Manajemen Artikel (`/admin/published` & `/admin/unpublished`)
Mengelola seluruh artikel yang sudah lolos kurasi:
*   **Set/Unset Featured:** Admin dapat memilih satu berita khusus untuk dijadikan "Featured Article" di bagian paling atas beranda (sistem otomatis menonaktifkan featured pada artikel lama).
*   **Toggle Spotlight:** Mengaktifkan berita masuk ke daftar sorotan utama.
*   **Unpublish (Turunkan Berita):** Menurunkan berita yang sedang tayang kembali menjadi draft privat jika kontennya bermasalah di kemudian hari.
*   **Pindahkan ke Trash:** Menghapus berita secara soft-delete ke tempat sampah.

### 5. Manajemen Kategori (`/admin/categories`)
*   Menyajikan fitur CRUD (Create, Read, Update, Delete) kategori.
*   **Color Picker Badge:** Admin bisa memilih warna spesifik (HEX Code) untuk label kategori baru. Warna ini akan otomatis ter-render pada badge artikel di halaman utama web tanpa perlu mengganti kode stylesheet CSS.

### 6. Tempat Sampah / Trash (`/admin/trash`)
*   Menampung semua artikel yang dihapus atau ditolak selama moderasi.
*   **Tombol Restore (Pulihkan):** Mengembalikan artikel ke status pending / approved.
*   **Tombol Permanent Delete:** Menghapus artikel beserta aset gambarnya secara permanen dan selamanya dari database dan Cloud Storage Bucket.
