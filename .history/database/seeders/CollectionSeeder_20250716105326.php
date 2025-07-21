<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\Category;
use Illuminate\Support\Str;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            [
                'name' => 'Keris Pusaka Majapahit',
                'category_name' => 'Senjata Tradisional',
                'description' => 'Keris pusaka dari era Majapahit dengan ukiran detail yang menggambarkan kisah Ramayana. Keris ini memiliki pamor yang unik dan diperkirakan dibuat pada abad ke-14.',
                'year_period' => 'Abad 14 Masehi',
                'origin_location' => 'Jawa Timur',
                'is_featured' => true
            ],
            [
                'name' => 'Batik Tulis Solo',
                'category_name' => 'Pakaian Adat',
                'description' => 'Batik tulis klasik dari Solo dengan motif parang rusak yang melambangkan kekuatan dan keberanian. Dibuat dengan teknik tradisional menggunakan canting.',
                'year_period' => '1920-an',
                'origin_location' => 'Solo, Jawa Tengah',
                'is_featured' => true
            ],
            [
                'name' => 'Gamelan Gede',
                'category_name' => 'Alat Musik',
                'description' => 'Set gamelan lengkap yang digunakan untuk upacara adat dan pertunjukan wayang kulit. Terdiri dari gong, kenong, saron, dan instrumen lainnya.',
                'year_period' => 'Abad 19 Masehi',
                'origin_location' => 'Yogyakarta',
                'is_featured' => false
            ],
            [
                'name' => 'Kalung Mutiara Lombok',
                'category_name' => 'Perhiasan Tradisional',
                'description' => 'Kalung tradisional dari Lombok yang terbuat dari mutiara asli dan emas. Digunakan oleh wanita Sasak dalam upacara adat.',
                'year_period' => '1930-an',
                'origin_location' => 'Lombok, Nusa Tenggara Barat',
                'is_featured' => false
            ],
            [
                'name' => 'Tenun Ikat Sumba',
                'category_name' => 'Kerajinan Tangan',
                'description' => 'Kain tenun ikat tradisional dari Sumba dengan motif geometris yang khas. Setiap motif memiliki makna filosofis dan spiritual.',
                'year_period' => '1950-an',
                'origin_location' => 'Sumba, Nusa Tenggara Timur',
                'is_featured' => true
            ],
            [
                'name' => 'Naskah Lontar Bali',
                'category_name' => 'Dokumen & Naskah',
                'description' => 'Naskah lontar kuno berisi ajaran Hindu dan catatan sejarah kerajaan Bali. Ditulis dengan aksara Bali kuno pada daun lontar.',
                'year_period' => 'Abad 17 Masehi',
                'origin_location' => 'Bali',
                'is_featured' => false
            ],
            [
                'name' => 'Foto Dokumentasi Kerajaan',
                'category_name' => 'Fotografi',
                'description' => 'Koleksi foto dokumentasi kerajaan-kerajaan di Indonesia pada masa kolonial. Menampilkan kehidupan istana dan tradisi kerajaan.',
                'year_period' => '1900-1940',
                'origin_location' => 'Seluruh Indonesia',
                'is_featured' => false
            ],
            [
                'name' => 'Gerabah Majapahit',
                'category_name' => 'Artefak Arkeologi',
                'description' => 'Gerabah kuno dari situs arkeologi Majapahit. Menampilkan teknik pembuatan dan dekorasi yang khas era Majapahit.',
                'year_period' => 'Abad 13-15 Masehi',
                'origin_location' => 'Trowulan, Jawa Timur',
                'is_featured' => false
            ]
        ];

        foreach ($collections as $collection) {
            $category = Category::where('name', $collection['category_name'])->first();

            if ($category) {
                Collection::create([
                    'name' => $collection['name'],
                    'slug' => Str::slug($collection['name']),
                    'category_id' => $category->id,
                    'description' => $collection['description'],
                    'year_period' => $collection['year_period'],
                    'origin_location' => $collection['origin_location'],
                    'is_featured' => $collection['is_featured'],
                    'is_active' => true,
                    'view_count' => rand(10, 500)
                ]);
            }
        }
    }
}
