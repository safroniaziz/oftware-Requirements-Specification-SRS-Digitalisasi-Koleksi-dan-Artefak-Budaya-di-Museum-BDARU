<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\Category;
use Illuminate\Support\Str;

class TestCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            [
                'name' => 'Keris Test Bengkulu',
                'category_id' => 1,
                'description' => 'Keris test untuk mencoba generate QR code. Keris ini dibuat khusus untuk testing fitur QR code generation.',
                'year_period' => '2024',
                'origin_location' => 'Bengkulu',
                'material' => 'Besi, Kayu',
                'dimensions' => '40cm x 6cm x 2cm',
                'conservation_status' => 'Baru',
                'technical_overview' => 'Keris test untuk testing QR code generation.',
                'nilai_budaya' => 'Keris test untuk testing QR code generation.',
                'nilai_historis' => 'Keris test untuk testing QR code generation.',
                'nilai_edukatif' => 'Keris test untuk testing QR code generation.'
            ],
            [
                'name' => 'Batik Test Bengkulu',
                'category_id' => 2,
                'description' => 'Batik test untuk mencoba generate QR code. Batik ini dibuat khusus untuk testing fitur QR code generation.',
                'year_period' => '2024',
                'origin_location' => 'Bengkulu',
                'material' => 'Kain, Malam',
                'dimensions' => '200cm x 100cm',
                'conservation_status' => 'Baru',
                'technical_overview' => 'Batik test untuk testing QR code generation.',
                'nilai_budaya' => 'Batik test untuk testing QR code generation.',
                'nilai_historis' => 'Batik test untuk testing QR code generation.',
                'nilai_edukatif' => 'Batik test untuk testing QR code generation.'
            ],
            [
                'name' => 'Dol Test Bengkulu',
                'category_id' => 4,
                'description' => 'Dol test untuk mencoba generate QR code. Dol ini dibuat khusus untuk testing fitur QR code generation.',
                'year_period' => '2024',
                'origin_location' => 'Bengkulu',
                'material' => 'Kayu, Kulit',
                'dimensions' => 'Diameter 50cm, Tinggi 35cm',
                'conservation_status' => 'Baru',
                'technical_overview' => 'Dol test untuk testing QR code generation.',
                'nilai_budaya' => 'Dol test untuk testing QR code generation.',
                'nilai_historis' => 'Dol test untuk testing QR code generation.',
                'nilai_edukatif' => 'Dol test untuk testing QR code generation.'
            ]
        ];

        foreach ($collections as $collection) {
            $category = Category::where('id', $collection['category_id'])->first();

            if ($category) {
                Collection::updateOrCreate(
                    ['slug' => Str::slug($collection['name'])],
                    [
                        'name' => $collection['name'],
                        'slug' => Str::slug($collection['name']),
                    'category_id' => $category->id,
                    'description' => $collection['description'],
                    'year_period' => $collection['year_period'],
                    'origin_location' => $collection['origin_location'],
                    'material' => $collection['material'] ?? null,
                    'dimensions' => $collection['dimensions'] ?? null,
                    'conservation_status' => $collection['conservation_status'] ?? null,
                    'technical_overview' => $collection['technical_overview'] ?? null,
                    'nilai_historis' => $collection['nilai_historis'] ?? null,
                    'nilai_edukatif' => $collection['nilai_edukatif'] ?? null,
                    'nilai_budaya' => $collection['nilai_budaya'] ?? null,
                    'image_path' => null,
                    'is_featured' => false,
                    'is_active' => true,
                    'view_count' => rand(10, 100)
                    ]
                );
            }
        }

        // Remove command->info() calls as they're not available in seeders
        // $this->command->info('Test collections seeded successfully!');
        // $this->command->info('You can now test QR code generation for these collections.');
    }
}
