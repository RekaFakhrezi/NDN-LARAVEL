<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\BreakingNews;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Categories
        $categoriesData = [
            ['name' => 'Teknologi', 'slug' => 'teknologi', 'color' => '#2563eb'],
            ['name' => 'Lingkungan', 'slug' => 'lingkungan', 'color' => '#16a34a'],
            ['name' => 'Pendidikan', 'slug' => 'pendidikan', 'color' => '#ca8a04'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'color' => '#db2777'],
            ['name' => 'Olahraga', 'slug' => 'olahraga', 'color' => '#dc2626'],
        ];

        $categories = [];
        foreach ($categoriesData as $catData) {
            $categories[$catData['name']] = Category::firstOrCreate(
                ['slug' => $catData['slug']],
                $catData
            );
        }

        // 2. Seed exactly 1 Admin account
        $admin = User::firstOrCreate(
            ['email' => 'admin@wargapost.com'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'bio' => 'Administrator Utama Nusantara Daily News.',
                'avatar' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=150&h=150&q=80',
            ]
        );

        // 3. Seed exactly 3 Author accounts
        $authors = [];
        
        $authors[] = User::firstOrCreate(
            ['email' => 'author1@example.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'bio' => 'Jurnalis senior bidang sains dan teknologi.',
                'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=150&h=150&q=80',
            ]
        );

        $authors[] = User::firstOrCreate(
            ['email' => 'author2@example.com'],
            [
                'name' => 'Siti Aminah',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'bio' => 'Pecinta lingkungan dan penulis esai sosial budaya.',
                'avatar' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=150&h=150&q=80',
            ]
        );

        $authors[] = User::firstOrCreate(
            ['email' => 'author3@example.com'],
            [
                'name' => 'Ahmad Pratama',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'bio' => 'Pengamat dunia pendidikan dan gaya hidup urban.',
                'avatar' => 'https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?auto=format&fit=crop&w=150&h=150&q=80',
            ]
        );

        // 4. Seed 3 Articles for Budi Santoso (Author 0)
        Article::create([
            'user_id' => $authors[0]->id,
            'category_id' => $categories['Teknologi']->id,
            'title' => 'Inovasi Nusantara EV-1: Mobil Listrik Pintar Buatan Indonesia',
            'content' => 'Perkembangan industri mobil listrik tanah air mencapai tonggak sejarah baru dengan diperkenalkannya Nusantara EV-1. Mobil listrik berdesain aerodinamis ini sepenuhnya dirancang oleh insinyur muda lokal dengan efisiensi baterai yang mampu bertahan hingga jarak 400 kilometer. Kehadiran kendaraan ini diharapkan mempercepat transisi energi bersih nasional.',
            'status' => 'approved',
            'view_count' => rand(300, 1000),
            'featured' => true,
            'spotlight' => false,
            'image' => 'https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=800&q=80',
            'created_at' => now()->subDays(2),
        ]);

        Article::create([
            'user_id' => $authors[0]->id,
            'category_id' => $categories['Teknologi']->id,
            'title' => 'Peran AI (Kecerdasan Buatan) dalam Transformasi Industri Kreatif',
            'content' => 'Kecerdasan buatan bukan lagi sekadar fiksi ilmiah. Di Indonesia, AI mulai diadopsi secara luas di sektor desain grafis, penulisan kreatif, hingga produksi musik. Para profesional kreatif diajak beradaptasi dengan memanfaatkan AI sebagai asisten produktivitas, bukan melihatnya sebagai ancaman yang akan menggantikan peran manusia.',
            'status' => 'approved',
            'view_count' => rand(100, 600),
            'featured' => false,
            'spotlight' => false,
            'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80',
            'created_at' => now()->subDays(5),
        ]);

        Article::create([
            'user_id' => $authors[0]->id,
            'category_id' => $categories['Olahraga']->id,
            'title' => 'Olahraga Lari Menjadi Tren Gaya Hidup Sehat di Perkotaan',
            'content' => 'Dalam beberapa tahun terakhir, ajang lari maraton dan komunitas lari bermunculan di berbagai kota besar di Indonesia. Olahraga yang sederhana dan murah ini terbukti tidak hanya meningkatkan kebugaran jasmani warga, namun juga mempererat solidaritas sosial antar warga di tengah rutinitas perkotaan yang padat.',
            'status' => 'approved',
            'view_count' => rand(200, 800),
            'featured' => false,
            'spotlight' => false,
            'image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=800&q=80',
            'created_at' => now()->subDays(8),
        ]);

        // 5. Seed 3 Articles for Siti Aminah (Author 1)
        Article::create([
            'user_id' => $authors[1]->id,
            'category_id' => $categories['Lingkungan']->id,
            'title' => 'Gerakan Zero-Waste: Solusi Mandiri Mengurangi Sampah Plastik Rumah Tangga',
            'content' => 'Penumpukan sampah plastik masih menjadi tantangan ekologis terbesar di Indonesia. Menjawab hal tersebut, gerakan zero-waste kini mulai merambah tingkat rumah tangga. Dengan memilah sampah organik untuk kompos serta membatasi penggunaan kantong plastik sekali pakai, masyarakat berkontribusi nyata menjaga kelestarian bumi.',
            'status' => 'approved',
            'view_count' => rand(150, 700),
            'featured' => false,
            'spotlight' => false,
            'image' => 'https://images.unsplash.com/photo-1500485035595-cbe6f645feb1?auto=format&fit=crop&w=800&q=80',
            'created_at' => now()->subDays(3),
        ]);

        Article::create([
            'user_id' => $authors[1]->id,
            'category_id' => $categories['Lingkungan']->id,
            'title' => 'Hutan Mangrove: Benteng Alami Penjaga Pesisir Nusantara',
            'content' => 'Ekosistem mangrove di sepanjang pantai utara Jawa dan wilayah kepulauan lainnya memainkan peran krusial dalam menahan abrasi air laut. Upaya penanaman kembali bibit mangrove terus digalakkan oleh berbagai komunitas pencinta alam berkolaborasi dengan pemerintah demi menjaga kelestarian ekosistem biota laut.',
            'status' => 'approved',
            'view_count' => rand(300, 900),
            'featured' => false,
            'spotlight' => false,
            'image' => 'https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=800&q=80',
            'created_at' => now()->subDays(6),
        ]);

        Article::create([
            'user_id' => $authors[1]->id,
            'category_id' => $categories['Pendidikan']->id,
            'title' => 'Sistem Pendidikan Merdeka Belajar Menumbuhkan Kreativitas Siswa',
            'content' => 'Kurikulum Merdeka Belajar yang berfokus pada pengembangan karakter dan minat bakat siswa mulai menunjukkan dampak positif. Siswa tidak lagi dituntut menghafal materi pelajaran, melainkan diajak berpikir kritis melalui proyek kolaboratif yang relevan dengan kehidupan sehari-hari mereka.',
            'status' => 'approved',
            'view_count' => rand(120, 500),
            'featured' => false,
            'spotlight' => false,
            'image' => 'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?auto=format&fit=crop&w=800&q=80',
            'created_at' => now()->subDays(10),
        ]);

        // 6. Seed 3 Articles for Ahmad Pratama (Author 2)
        Article::create([
            'user_id' => $authors[2]->id,
            'category_id' => $categories['Lifestyle']->id,
            'title' => 'Gaya Hidup Minimalis: Menemukan Kedamaian di Tengah Konsumerisme',
            'content' => 'Minimalisme bukan sekadar tentang estetika rumah yang bersih dan rapi, melainkan sebuah filosofi hidup untuk menyederhanakan pikiran. Dengan mengurangi konsumsi barang-barang yang tidak esensial, seseorang dapat memfokuskan energi dan finansialnya pada hal-hal yang lebih bermakna seperti kesehatan dan hubungan keluarga.',
            'status' => 'approved',
            'view_count' => rand(250, 1100),
            'featured' => false,
            'spotlight' => false,
            'image' => 'https://images.unsplash.com/photo-1511556532299-8f662fc26c06?auto=format&fit=crop&w=800&q=80',
            'created_at' => now()->subDays(4),
        ]);

        Article::create([
            'user_id' => $authors[2]->id,
            'category_id' => $categories['Lifestyle']->id,
            'title' => 'Eksplorasi Kuliner Lokal Nusantara Go Internasional',
            'content' => 'Rempah-rempah asli Indonesia kembali merebut perhatian dunia kuliner global. Restoran berkonsep fine dining lokal di kota-kota besar dunia mulai menyajikan rendang, sate, dan soto dengan presentasi modern yang premium. Ini menjadi ajang diplomasi budaya yang sangat efektif memperkenalkan identitas bangsa.',
            'status' => 'approved',
            'view_count' => rand(400, 1500),
            'featured' => false,
            'spotlight' => false,
            'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=800&q=80',
            'created_at' => now()->subDays(7),
        ]);

        Article::create([
            'user_id' => $authors[2]->id,
            'category_id' => $categories['Pendidikan']->id,
            'title' => 'Metode Belajar Efektif di Era Informasi Digital',
            'content' => 'Di tengah membanjirnya informasi di internet, kemampuan menyaring dan menyerap ilmu secara terarah menjadi kompetensi wajib generasi muda. Metode active recall dan spaced repetition terbukti sangat membantu pelajar menguasai materi baru secara cepat, terstruktur, dan bertahan lama dalam memori.',
            'status' => 'approved',
            'view_count' => rand(150, 450),
            'featured' => false,
            'spotlight' => false,
            'image' => 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=800&q=80',
            'created_at' => now()->subDays(12),
        ]);

        // 7. Seed initial Breaking News item
        BreakingNews::firstOrCreate(
            ['id' => 1],
            [
                'mode' => 'custom',
                'content' => 'Ibukota Nusantara Siap Diresmikan Bulan Depan. • Presiden Kunjungi Papua Untuk Proyek Strategis. • Kurs Rupiah Menguat Terhadap Dollar AS. • NDN'
            ]
        );
    }
}
