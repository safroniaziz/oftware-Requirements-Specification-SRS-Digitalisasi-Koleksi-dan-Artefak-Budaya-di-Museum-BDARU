<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\CollectionTechnicalSpec;

class CollectionTechnicalSpecSeeder extends Seeder
{
    public function run(): void
    {
        $collections = Collection::all();

        foreach ($collections as $collection) {
            // Sample technical specs data
            $technicalSpecs = [
                [
                    'spec_name' => 'Material',
                    'spec_value' => $collection->material ?: 'Kayu, Logam, Kain',
                    'icon' => 'fas fa-cube',
                    'order' => 1
                ],
                [
                    'spec_name' => 'Dimensi',
                    'spec_value' => $collection->dimensions ?: '50cm x 30cm x 20cm',
                    'icon' => 'fas fa-ruler-combined',
                    'order' => 2
                ],
                [
                    'spec_name' => 'Tahun Pembuatan',
                    'spec_value' => $collection->year_period ?: '1920-1930',
                    'icon' => 'fas fa-calendar',
                    'order' => 3
                ],
                [
                    'spec_name' => 'Status Konservasi',
                    'spec_value' => $collection->conservation_status ?: 'Baik',
                    'icon' => 'fas fa-shield-alt',
                    'order' => 4
                ],
                [
                    'spec_name' => 'Kategori',
                    'spec_value' => $collection->category ? $collection->category->name : 'Uncategorized',
                    'icon' => 'fas fa-tag',
                    'order' => 5
                ],
                [
                    'spec_name' => 'Rating',
                    'spec_value' => $collection->rating ? number_format($collection->rating, 2) . '/5.00' : '4.50/5.00',
                    'icon' => 'fas fa-star',
                    'order' => 6
                ]
            ];

            foreach ($technicalSpecs as $spec) {
                CollectionTechnicalSpec::create([
                    'collection_id' => $collection->id,
                    'spec_name' => $spec['spec_name'],
                    'spec_value' => $spec['spec_value'],
                    'icon' => $spec['icon'],
                    'order' => $spec['order']
                ]);
            }
        }
    }
}
