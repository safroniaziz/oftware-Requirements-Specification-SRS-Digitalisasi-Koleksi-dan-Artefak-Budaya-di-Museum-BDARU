<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\CollectionCulturalPoint;

class CollectionCulturalPointSeeder extends Seeder
{
    public function run(): void
    {
        $collections = Collection::all();

        foreach ($collections as $collection) {
            // Sample cultural points data
            $culturalPoints = [
                [
                    'title' => 'Nilai Historis',
                    'description' => 'Menggambarkan periode sejarah penting dalam perkembangan budaya Indonesia',
                    'icon' => 'fas fa-history',
                    'color' => '#10b981',
                    'order' => 1
                ],
                [
                    'title' => 'Lokasi Asal',
                    'description' => 'Berasal dari daerah yang kaya akan tradisi dan budaya lokal',
                    'icon' => 'fas fa-map-marker-alt',
                    'color' => '#0ea5e9',
                    'order' => 2
                ],
                [
                    'title' => 'Nilai Edukatif',
                    'description' => 'Memberikan pembelajaran tentang teknik dan filosofi budaya tradisional',
                    'icon' => 'fas fa-graduation-cap',
                    'color' => '#8b5cf6',
                    'order' => 3
                ]
            ];

            foreach ($culturalPoints as $point) {
                CollectionCulturalPoint::create([
                    'collection_id' => $collection->id,
                    'title' => $point['title'],
                    'description' => $point['description'],
                    'icon' => $point['icon'],
                    'color' => $point['color'],
                    'order' => $point['order']
                ]);
            }
        }
    }
}
