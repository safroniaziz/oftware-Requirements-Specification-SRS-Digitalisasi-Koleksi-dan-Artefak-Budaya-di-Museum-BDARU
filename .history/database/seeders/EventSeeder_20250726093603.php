<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Pameran Batik Nusantara 2024',
                'description' => 'Pameran koleksi batik tradisional dari berbagai daerah di Indonesia, menampilkan keunikan motif dan filosofi budaya yang kaya.',
                'event_date' => Carbon::now()->addDays(15),
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'location' => 'Galeri Utama Museum BDARU',
                'image' => 'storage/events/event-1.jpg',
                'status' => 'upcoming',
                'type' => 'exhibition',
                'capacity' => 200,
                'price' => 0.00,
                'is_featured' => true,
                'organizer' => 'Museum BDARU',
                'additional_info' => 'Gratis untuk semua pengunjung. Daftar online untuk mendapatkan souvenir eksklusif.',
            ],
            [
                'title' => 'Workshop Membuat Batik Tulis',
                'description' => 'Workshop interaktif untuk belajar membuat batik tulis tradisional dengan teknik canting dan pewarna alami.',
                'event_date' => Carbon::now()->addDays(7),
                'start_time' => '13:00:00',
                'end_time' => '16:00:00',
                'location' => 'Ruang Workshop Museum BDARU',
                'image' => 'storage/events/event-2.jpg',
                'status' => 'upcoming',
                'type' => 'workshop',
                'capacity' => 20,
                'price' => 150000.00,
                'is_featured' => true,
                'organizer' => 'Museum BDARU & Komunitas Batik Indonesia',
                'additional_info' => 'Materi dan alat disediakan. Peserta akan membawa pulang hasil karya batik sendiri.',
            ],
            [
                'title' => 'Seminar Digitalisasi Koleksi Museum',
                'description' => 'Seminar tentang teknologi digital dalam preservasi dan aksesibilitas koleksi museum di era modern.',
                'event_date' => Carbon::now()->addDays(25),
                'start_time' => '10:00:00',
                'end_time' => '15:00:00',
                'location' => 'Auditorium Museum BDARU',
                'image' => 'storage/events/event-3.jpg',
                'status' => 'upcoming',
                'type' => 'seminar',
                'capacity' => 100,
                'price' => 50000.00,
                'is_featured' => false,
                'organizer' => 'Museum BDARU & Kementerian Pendidikan dan Kebudayaan',
                'additional_info' => 'Sertifikat akan diberikan kepada peserta. Coffee break disediakan.',
            ],
            [
                'title' => 'Pertunjukan Wayang Kulit Digital',
                'description' => 'Pertunjukan wayang kulit tradisional dengan teknologi digital mapping yang memukau.',
                'event_date' => Carbon::now()->addDays(3),
                'start_time' => '19:00:00',
                'end_time' => '21:00:00',
                'location' => 'Panggung Terbuka Museum BDARU',
                'image' => 'storage/events/event-4.jpg',
                'status' => 'upcoming',
                'type' => 'performance',
                'capacity' => 150,
                'price' => 75000.00,
                'is_featured' => true,
                'organizer' => 'Museum BDARU & Dalang Muda Indonesia',
                'additional_info' => 'Pertunjukan akan disiarkan langsung di platform digital museum.',
            ],
            [
                'title' => 'Pameran Fotografi Budaya Indonesia',
                'description' => 'Pameran foto dokumentasi budaya Indonesia dari berbagai fotografer profesional dan amatir.',
                'event_date' => Carbon::now()->addDays(30),
                'start_time' => '09:00:00',
                'end_time' => '18:00:00',
                'location' => 'Galeri Fotografi Museum BDARU',
                'image' => 'storage/events/event-5.jpg',
                'status' => 'upcoming',
                'type' => 'exhibition',
                'capacity' => 300,
                'price' => 25000.00,
                'is_featured' => false,
                'organizer' => 'Museum BDARU & Komunitas Fotografer Budaya',
                'additional_info' => 'Pameran akan berlangsung selama 2 minggu. Foto-foto dapat dibeli.',
            ],
            [
                'title' => 'Workshop Seni Rupa Tradisional',
                'description' => 'Workshop melukis dengan teknik tradisional Indonesia seperti batik, wayang, dan ukiran.',
                'event_date' => Carbon::now()->addDays(12),
                'start_time' => '14:00:00',
                'end_time' => '17:00:00',
                'location' => 'Studio Seni Museum BDARU',
                'image' => '/images/events/event-6.jpg',
                'status' => 'upcoming',
                'type' => 'workshop',
                'capacity' => 15,
                'price' => 200000.00,
                'is_featured' => false,
                'organizer' => 'Museum BDARU & Seniman Lokal',
                'additional_info' => 'Semua bahan disediakan. Cocok untuk pemula dan mahir.',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
