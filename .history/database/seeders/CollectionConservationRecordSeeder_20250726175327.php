<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\CollectionConservationRecord;

class CollectionConservationRecordSeeder extends Seeder
{
    public function run(): void
    {
        $collections = Collection::all();

        foreach ($collections as $collection) {
            // Sample conservation records data
            $conservationRecords = [
                [
                    'record_date' => now()->subMonths(6),
                    'action' => 'Pemeriksaan Rutin',
                    'description' => 'Koleksi ini telah melalui proses konservasi dan digitalisasi yang ketat untuk memastikan kelestariannya.',
                    'status' => 'Baik',
                    'color' => '#10b981',
                    'order' => 1
                ],
                [
                    'record_date' => now()->subMonths(3),
                    'action' => 'Digitalisasi',
                    'description' => 'Menggunakan teknologi fotografi resolusi tinggi dan pemindaian 3D untuk dokumentasi yang akurat.',
                    'status' => 'Selesai',
                    'color' => '#0ea5e9',
                    'order' => 2
                ],
                [
                    'record_date' => now()->subMonth(),
                    'action' => 'Penyimpanan',
                    'description' => 'Disimpan dalam kondisi terkontrol dengan suhu dan kelembaban yang optimal.',
                    'status' => 'Aktif',
                    'color' => '#8b5cf6',
                    'order' => 3
                ]
            ];

            foreach ($conservationRecords as $record) {
                CollectionConservationRecord::create([
                    'collection_id' => $collection->id,
                    'record_date' => $record['record_date'],
                    'action' => $record['action'],
                    'description' => $record['description'],
                    'status' => $record['status'],
                    'color' => $record['color'],
                    'order' => $record['order']
                ]);
            }
        }
    }
}
