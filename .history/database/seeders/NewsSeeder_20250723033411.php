<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Generate reliable placeholder image URLs
     */
    private function generatePlaceholderImage($text, $color = '10b981')
    {
        // Use Picsum Photos for reliable placeholder images
        $imageId = rand(1, 1000);
        return "https://picsum.photos/800/600?random={$imageId}";
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get news categories for mapping
        $museumNews = NewsCategory::where('slug', 'berita-museum')->first();
        $exhibitionEvent = NewsCategory::where('slug', 'pameran-event')->first();
        $workshopEducation = NewsCategory::where('slug', 'workshop-edukasi')->first();
        $digitalTech = NewsCategory::where('slug', 'teknologi-digital')->first();
        $culture = NewsCategory::where('slug', 'kebudayaan')->first();
        $announcement = NewsCategory::where('slug', 'pengumuman')->first();

        $news = [
            [
                'title' => 'Pembukaan Museum BDARU',
                'content' => 'Museum BDARU resmi dibuka untuk umum pada tanggal 15 Januari 2024. Museum ini menyimpan koleksi budaya yang berharga dan menjadi pusat pembelajaran budaya Indonesia. Museum ini didirikan dengan tujuan melestarikan dan memperkenalkan warisan budaya Indonesia kepada generasi muda dan masyarakat luas.',
                'excerpt' => 'Museum BDARU resmi dibuka untuk umum dengan koleksi budaya yang berharga dan menjadi pusat pembelajaran budaya Indonesia.',
                'image_path' => $this->generatePlaceholderImage('Pembukaan Museum', '10b981'),
                'type' => 'news',
                'news_category_id' => $museumNews->id, // Berita Museum
                'is_published' => true,
                'is_featured' => true,
                'view_count' => 1250,
                'published_at' => now()->subDays(30)
            ],
            [
                'title' => 'Workshop Membatik Tradisional',
                'content' => 'Museum BDARU mengadakan workshop membatik tradisional untuk pelajar dan masyarakat umum. Workshop ini mengajarkan teknik membatik dengan canting dan pewarna alami. Peserta akan belajar langsung dari para pembatik profesional dan mendapatkan sertifikat keahlian.',
                'excerpt' => 'Workshop membatik tradisional untuk pelajar dan masyarakat umum dengan teknik canting dan pewarna alami.',
                'image_path' => $this->generatePlaceholderImage('Workshop Batik', '0d9488'),
                'type' => 'activity',
                'news_category_id' => $workshopEducation->id, // Workshop & Edukasi
                'event_date' => now()->addDays(7),
                'location' => 'Museum BDARU, Ruang Workshop',
                'is_published' => true,
                'is_featured' => true,
                'view_count' => 890,
                'published_at' => now()->subDays(5)
            ],
            [
                'title' => 'Pameran Senjata Tradisional',
                'content' => 'Pameran khusus senjata tradisional Indonesia akan digelar selama bulan Februari. Pameran ini menampilkan berbagai jenis senjata tradisional dari berbagai daerah di Indonesia, termasuk keris, pedang, tombak, dan senjata tradisional lainnya.',
                'excerpt' => 'Pameran senjata tradisional Indonesia dengan koleksi dari berbagai daerah selama bulan Februari.',
                'image_path' => $this->generatePlaceholderImage('Pameran Senjata', '14b8a6'),
                'type' => 'event',
                'news_category_id' => $exhibitionEvent->id, // Pameran & Event
                'event_date' => now()->addDays(15),
                'location' => 'Museum BDARU, Galeri Utama',
                'is_published' => true,
                'is_featured' => false,
                'view_count' => 567,
                'published_at' => now()->subDays(10)
            ],
            [
                'title' => 'Diskusi Budaya: Pelestarian Warisan Budaya',
                'content' => 'Diskusi panel tentang pentingnya pelestarian warisan budaya Indonesia. Menghadirkan para ahli budaya dan praktisi seni tradisional. Diskusi ini membahas strategi pelestarian budaya di era digital.',
                'excerpt' => 'Diskusi panel tentang pelestarian warisan budaya Indonesia dengan para ahli dan praktisi seni tradisional.',
                'image_path' => $this->generatePlaceholderImage('Diskusi Budaya', '06b6d4'),
                'type' => 'activity',
                'news_category_id' => $culture->id, // Kebudayaan
                'event_date' => now()->addDays(20),
                'location' => 'Museum BDARU, Auditorium',
                'is_published' => true,
                'is_featured' => false,
                'view_count' => 432,
                'published_at' => now()->subDays(3)
            ],
            [
                'title' => 'Kunjungan Siswa SDN 01 Jakarta',
                'content' => 'Siswa-siswi SDN 01 Jakarta melakukan kunjungan edukasi ke Museum BDARU. Mereka belajar tentang budaya Indonesia melalui koleksi museum dan mengikuti kegiatan interaktif yang disediakan.',
                'excerpt' => 'Kunjungan edukasi siswa SDN 01 Jakarta ke Museum BDARU untuk belajar budaya Indonesia.',
                'image_path' => $this->generatePlaceholderImage('Kunjungan Siswa', '0891b2'),
                'type' => 'news',
                'news_category_id' => $museumNews->id, // Berita Museum
                'is_published' => true,
                'is_featured' => false,
                'view_count' => 234,
                'published_at' => now()->subDays(1)
            ],
            [
                'title' => 'Pelatihan Kurator Museum',
                'content' => 'Museum BDARU mengadakan pelatihan kurator untuk meningkatkan kapasitas pengelolaan koleksi museum. Pelatihan ini diikuti oleh staf museum dan relawan dengan materi pengelolaan koleksi digital.',
                'excerpt' => 'Pelatihan kurator museum untuk meningkatkan kapasitas pengelolaan koleksi digital.',
                'image_path' => $this->generatePlaceholderImage('Pelatihan Kurator', '0e7490'),
                'type' => 'activity',
                'category_id' => 2, // Kegiatan
                'event_date' => now()->addDays(30),
                'location' => 'Museum BDARU, Ruang Pelatihan',
                'is_published' => true,
                'is_featured' => false,
                'view_count' => 189,
                'published_at' => now()->subDays(2)
            ],
            [
                'title' => 'Digitalisasi Koleksi Museum',
                'content' => 'Museum BDARU meluncurkan program digitalisasi koleksi untuk memudahkan akses publik. Program ini menggunakan teknologi 3D scanning dan augmented reality.',
                'excerpt' => 'Program digitalisasi koleksi museum dengan teknologi 3D scanning dan augmented reality.',
                'image_path' => $this->generatePlaceholderImage('Digitalisasi Koleksi', '155e75'),
                'type' => 'news',
                'category_id' => 1, // Berita
                'is_published' => true,
                'is_featured' => true,
                'view_count' => 756,
                'published_at' => now()->subDays(7)
            ],
            [
                'title' => 'Festival Budaya Nusantara',
                'content' => 'Festival budaya nusantara akan digelar selama 3 hari dengan menampilkan berbagai kesenian tradisional dari seluruh Indonesia.',
                'excerpt' => 'Festival budaya nusantara dengan kesenian tradisional dari seluruh Indonesia.',
                'image_path' => $this->generatePlaceholderImage('Festival Budaya', '164e63'),
                'type' => 'event',
                'category_id' => 3, // Pameran
                'event_date' => now()->addDays(45),
                'location' => 'Museum BDARU, Halaman Utama',
                'is_published' => true,
                'is_featured' => false,
                'view_count' => 345,
                'published_at' => now()->subDays(4)
            ]
        ];

        foreach ($news as $item) {
            News::updateOrCreate(
                ['slug' => Str::slug($item['title'])],
                [
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'excerpt' => $item['excerpt'] ?? null,
                    'image_path' => $item['image_path'] ?? null,
                    'type' => $item['type'],
                    'category_id' => $item['category_id'] ?? null,
                    'event_date' => $item['event_date'] ?? null,
                    'location' => $item['location'] ?? null,
                    'is_published' => $item['is_published'],
                    'is_featured' => $item['is_featured'] ?? false,
                    'view_count' => $item['view_count'] ?? 0,
                    'published_at' => $item['published_at']
                ]
            );
        }
    }
}
