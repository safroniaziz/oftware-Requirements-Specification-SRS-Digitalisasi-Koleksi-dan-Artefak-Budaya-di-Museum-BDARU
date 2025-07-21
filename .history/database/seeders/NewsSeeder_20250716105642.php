<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = [
            [
                'title' => 'Pembukaan Museum BDARU',
                'content' => 'Museum BDARU resmi dibuka untuk umum pada tanggal 15 Januari 2024. Museum ini menyimpan koleksi budaya yang berharga dan menjadi pusat pembelajaran budaya Indonesia.',
                'type' => 'news',
                'is_published' => true,
                'published_at' => now()->subDays(30)
            ],
            [
                'title' => 'Workshop Membatik Tradisional',
                'content' => 'Museum BDARU mengadakan workshop membatik tradisional untuk pelajar dan masyarakat umum. Workshop ini mengajarkan teknik membatik dengan canting dan pewarna alami.',
                'type' => 'activity',
                'event_date' => now()->addDays(7),
                'location' => 'Museum BDARU, Ruang Workshop',
                'is_published' => true,
                'published_at' => now()->subDays(5)
            ],
            [
                'title' => 'Pameran Senjata Tradisional',
                'content' => 'Pameran khusus senjata tradisional Indonesia akan digelar selama bulan Februari. Pameran ini menampilkan berbagai jenis senjata tradisional dari berbagai daerah di Indonesia.',
                'type' => 'event',
                'event_date' => now()->addDays(15),
                'location' => 'Museum BDARU, Galeri Utama',
                'is_published' => true,
                'published_at' => now()->subDays(10)
            ],
            [
                'title' => 'Diskusi Budaya: Pelestarian Warisan Budaya',
                'content' => 'Diskusi panel tentang pentingnya pelestarian warisan budaya Indonesia. Menghadirkan para ahli budaya dan praktisi seni tradisional.',
                'type' => 'activity',
                'event_date' => now()->addDays(20),
                'location' => 'Museum BDARU, Auditorium',
                'is_published' => true,
                'published_at' => now()->subDays(3)
            ],
            [
                'title' => 'Kunjungan Siswa SDN 01 Jakarta',
                'content' => 'Siswa-siswi SDN 01 Jakarta melakukan kunjungan edukasi ke Museum BDARU. Mereka belajar tentang budaya Indonesia melalui koleksi museum.',
                'type' => 'news',
                'is_published' => true,
                'published_at' => now()->subDays(1)
            ],
            [
                'title' => 'Pelatihan Kurator Museum',
                'content' => 'Museum BDARU mengadakan pelatihan kurator untuk meningkatkan kapasitas pengelolaan koleksi museum. Pelatihan ini diikuti oleh staf museum dan relawan.',
                'type' => 'activity',
                'event_date' => now()->addDays(30),
                'location' => 'Museum BDARU, Ruang Pelatihan',
                'is_published' => true,
                'published_at' => now()->subDays(2)
            ]
        ];

        foreach ($news as $item) {
            News::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'content' => $item['content'],
                'type' => $item['type'],
                'event_date' => $item['event_date'] ?? null,
                'location' => $item['location'] ?? null,
                'is_published' => $item['is_published'],
                'published_at' => $item['published_at']
            ]);
        }
    }
}
