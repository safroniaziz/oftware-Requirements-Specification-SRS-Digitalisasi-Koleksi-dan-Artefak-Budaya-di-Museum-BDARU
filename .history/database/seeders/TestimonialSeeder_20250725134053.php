<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Ahmad Rizki',
                'profession' => 'Mahasiswa Sejarah',
                'content' => 'Museum BDARU benar-benar mengubah cara saya melihat warisan budaya Indonesia. Platform digital yang sangat interaktif dan informatif. Saya bisa belajar tentang artefak kuno dengan cara yang modern dan menarik.',
                'rating' => 5,
                'avatar' => 'https://ui-avatars.com/api/?name=Ahmad+Rizki&background=10b981&color=fff&size=128&bold=true',
                'email' => 'ahmad.rizki@email.com',
                'phone' => '081234567890',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'profession' => 'Guru Seni Budaya',
                'content' => 'Sebagai guru, saya sangat terkesan dengan koleksi digital BDARU. Siswa-siswa saya sangat antusias belajar melalui platform ini. Kontennya lengkap dan mudah dipahami.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=400&h=400&fit=crop&crop=face',
                'email' => 'siti.nurhaliza@email.com',
                'phone' => '081234567891',
            ],
            [
                'name' => 'Budi Santoso',
                'profession' => 'Peneliti Budaya',
                'content' => 'Kualitas digitalisasi koleksi di BDARU sangat tinggi. Detail artefak terlihat jelas dan informasi yang disajikan sangat akurat. Platform yang sangat bermanfaat untuk penelitian.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=face',
                'email' => 'budi.santoso@email.com',
                'phone' => '081234567892',
            ],
            [
                'name' => 'Dewi Sartika',
                'profession' => 'Seniman',
                'content' => 'Inspirasi yang luar biasa! Melihat koleksi budaya Indonesia dalam format digital memberikan perspektif baru untuk karya seni saya. BDARU berhasil menghubungkan tradisi dengan teknologi.',
                'rating' => 4,
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop&crop=face',
                'email' => 'dewi.sartika@email.com',
                'phone' => '081234567893',
            ],
            [
                'name' => 'Raden Mas Joko',
                'profession' => 'Kurator Museum',
                'content' => 'Sebagai kurator, saya sangat mengapresiasi inovasi BDARU dalam mendigitalisasi warisan budaya. Platform ini membuka akses yang lebih luas untuk masyarakat.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&h=400&fit=crop&crop=face',
                'email' => 'joko.kurator@email.com',
                'phone' => '081234567894',
            ],
            [
                'name' => 'Maya Indah',
                'profession' => 'Pelajar SMA',
                'content' => 'Seru banget! Saya bisa belajar tentang budaya Indonesia dengan cara yang fun. Interface-nya user-friendly dan kontennya menarik. Recommended buat teman-teman!',
                'rating' => 4,
                'avatar' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&h=400&fit=crop&crop=face',
                'email' => 'maya.indah@email.com',
                'phone' => '081234567895',
            ],
            [
                'name' => 'Pak Haji Umar',
                'profession' => 'Pengusaha',
                'content' => 'Meskipun saya sudah berumur, platform BDARU sangat mudah digunakan. Saya bisa melihat koleksi budaya tanpa harus keluar rumah. Teknologi yang sangat bermanfaat.',
                'rating' => 4,
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop&crop=face',
                'email' => 'umar.haji@email.com',
                'phone' => '081234567896',
            ],
            [
                'name' => 'Nina Kartika',
                'profession' => 'Fotografer',
                'content' => 'Kualitas visual yang luar biasa! Detail artefak terlihat sangat jelas. Platform ini memberikan inspirasi besar untuk proyek fotografi budaya saya.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=400&h=400&fit=crop&crop=face',
                'email' => 'nina.kartika@email.com',
                'phone' => '081234567897',
            ],
            [
                'name' => 'Agus Setiawan',
                'profession' => 'Dosen Arkeologi',
                'content' => 'BDARU berhasil mengombinasikan keakuratan akademis dengan kemudahan akses. Platform yang sangat berguna untuk mahasiswa dan peneliti arkeologi.',
                'rating' => 5,
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=face',
                'email' => 'agus.setiawan@email.com',
                'phone' => '081234567898',
            ],
            [
                'name' => 'Rina Melati',
                'profession' => 'Wiraswasta',
                'content' => 'Saya suka sekali dengan konsep museum digital ini. Bisa mengakses koleksi budaya kapan saja dan di mana saja. Sangat praktis untuk orang sibuk seperti saya.',
                'rating' => 4,
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop&crop=face',
                'email' => 'rina.melati@email.com',
                'phone' => '081234567899',
            ],
            [
                'name' => 'Bambang Wijaya',
                'profession' => 'Pensiunan PNS',
                'content' => 'Setelah pensiun, saya punya waktu lebih untuk mengeksplorasi budaya Indonesia. BDARU memberikan pengalaman yang menyenangkan dan edukatif.',
                'rating' => 5,
                'email' => 'bambang.wijaya@email.com',
                'phone' => '081234567800',
            ],
            [
                'name' => 'Lina Marlina',
                'profession' => 'Desainer Grafis',
                'content' => 'Elemen visual dan UI/UX BDARU sangat menarik! Saya terinspirasi untuk membuat desain yang menggabungkan elemen budaya tradisional dengan modern.',
                'rating' => 4,
                'email' => 'lina.marlina@email.com',
                'phone' => '081234567801',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
