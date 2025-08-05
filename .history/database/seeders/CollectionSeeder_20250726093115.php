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
                'name' => 'Keris Modern Bali',
                'category_name' => 'Senjata Tradisional',
                'description' => 'Keris kontemporer karya empu Bali dengan pamor modern yang menggabungkan teknik tradisional dengan sentuhan artistik masa kini.',
                'year_period' => '2020',
                'origin_location' => 'Bali',
                'is_featured' => true
            ],
            [
                'name' => 'Batik Digital Yogyakarta',
                'category_name' => 'Pakaian Adat',
                'description' => 'Batik dengan motif digital yang inovatif, menggabungkan teknologi printing modern dengan motif tradisional Yogyakarta.',
                'year_period' => '2022',
                'origin_location' => 'Yogyakarta',
                'is_featured' => true
            ],
            [
                'name' => 'Gamelan Elektronik',
                'category_name' => 'Alat Musik',
                'description' => 'Gamelan elektronik yang memadukan suara tradisional dengan teknologi digital untuk pertunjukan modern.',
                'year_period' => '2021',
                'origin_location' => 'Solo, Jawa Tengah',
                'is_featured' => false
            ],
            [
                'name' => 'Kalung Bambu Lombok',
                'category_name' => 'Perhiasan Tradisional',
                'description' => 'Kalung tradisional dari bambu dengan desain modern, karya pengrajin Lombok yang ramah lingkungan.',
                'year_period' => '2023',
                'origin_location' => 'Lombok, Nusa Tenggara Barat',
                'is_featured' => false
            ],
            [
                'name' => 'Tenun Ikat Modern Sumba',
                'category_name' => 'Kerajinan Tangan',
                'description' => 'Tenun ikat Sumba dengan motif kontemporer yang tetap mempertahankan filosofi budaya lokal.',
                'year_period' => '2022',
                'origin_location' => 'Sumba, Nusa Tenggara Timur',
                'is_featured' => true
            ],
            [
                'name' => 'Dokumentasi Digital Budaya',
                'category_name' => 'Dokumen & Naskah',
                'description' => 'Koleksi dokumentasi digital budaya Indonesia dalam format e-book dan multimedia interaktif.',
                'year_period' => '2023',
                'origin_location' => 'Jakarta',
                'is_featured' => false
            ],
            [
                'name' => 'Foto Dokumentasi Festival Budaya',
                'category_name' => 'Fotografi',
                'description' => 'Koleksi foto dokumentasi festival budaya Indonesia dari berbagai daerah dalam format digital.',
                'year_period' => '2021-2023',
                'origin_location' => 'Seluruh Indonesia',
                'is_featured' => false
            ],
            [
                'name' => 'Artefak Digital Rekonstruksi',
                'category_name' => 'Artefak Arkeologi',
                'description' => 'Rekonstruksi digital artefak arkeologi Indonesia menggunakan teknologi 3D scanning dan modeling.',
                'year_period' => '2023',
                'origin_location' => 'Berbagai Situs Arkeologi',
                'is_featured' => false
            ],
            [
                'name' => 'Wayang Digital',
                'category_name' => 'Kerajinan Tangan',
                'description' => 'Wayang kulit dengan sentuhan digital, menggunakan teknologi laser cutting untuk detail yang presisi.',
                'year_period' => '2022',
                'origin_location' => 'Yogyakarta',
                'is_featured' => false
            ],
            [
                'name' => 'Angklung Modern',
                'category_name' => 'Alat Musik',
                'description' => 'Angklung dengan material modern dan tuning yang disesuaikan untuk pertunjukan kontemporer.',
                'year_period' => '2021',
                'origin_location' => 'Bandung, Jawa Barat',
                'is_featured' => false
            ],
            [
                'name' => 'Songket Digital Palembang',
                'category_name' => 'Pakaian Adat',
                'description' => 'Songket Palembang dengan motif digital yang inovatif, memadukan tradisi dengan teknologi modern.',
                'year_period' => '2023',
                'origin_location' => 'Palembang, Sumatera Selatan',
                'is_featured' => false
            ],
            [
                'name' => 'Keris Miniatur Koleksi',
                'category_name' => 'Senjata Tradisional',
                'description' => 'Koleksi miniatur keris dari berbagai daerah Indonesia dengan detail yang presisi.',
                'year_period' => '2022',
                'origin_location' => 'Berbagai Daerah',
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
                    'image_path' => '/images/collections/collection-' . rand(1, 12) . '.jpg',
                    'is_featured' => $collection['is_featured'],
                    'is_active' => true,
                    'view_count' => rand(10, 500)
                ]);
            }
        }
    }
}
