<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\CollectionHistory;

class CollectionHistorySeeder extends Seeder
{
    public function run(): void
    {
        $collections = Collection::all();

        foreach ($collections as $collection) {
            // Sample history data
            $histories = [
                [
                    'title' => 'Periode Pembuatan',
                    'year' => $collection->year_period ?: '1920-1930',
                    'description' => 'Periode pembuatan koleksi ini, menggambarkan konteks historis dan budaya pada masa tersebut.',
                    'order' => 1,
                    'color' => '#10b981'
                ],
                [
                    'title' => 'Era Tradisional',
                    'year' => 'Era Tradisional',
                    'description' => 'Dibuat dengan teknik tradisional, menandakan periode keahlian dan tradisi yang berkembang pada masa itu.',
                    'order' => 2,
                    'color' => '#0ea5e9'
                ],
                [
                    'title' => 'Lokasi Asal',
                    'year' => 'Lokasi Asal',
                    'description' => 'Berasal dari ' . ($collection->origin_location ?: 'Jawa Tengah') . ', menunjukkan pengaruh budaya dan tradisi lokal yang khas.',
                    'order' => 3,
                    'color' => '#8b5cf6'
                ],
                [
                    'title' => 'Era Modern',
                    'year' => 'Era Modern',
                    'description' => 'Koleksi ini telah melalui proses digitalisasi dan konservasi untuk memastikan kelestariannya bagi generasi mendatang.',
                    'order' => 4,
                    'color' => '#f59e0b'
                ]
            ];

            foreach ($histories as $history) {
                CollectionHistory::create([
                    'collection_id' => $collection->id,
                    'title' => $history['title'],
                    'year' => $history['year'],
                    'description' => $history['description'],
                    'order' => $history['order'],
                    'color' => $history['color']
                ]);
            }
        }
    }
}
