<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Senjata Tradisional',
                'description' => 'Koleksi senjata tradisional dari berbagai suku dan daerah',
                'icon' => 'sword',
                'is_active' => true
            ],
            [
                'name' => 'Pakaian Adat',
                'description' => 'Koleksi pakaian adat dan busana tradisional',
                'icon' => 'shirt',
                'is_active' => true
            ],
            [
                'name' => 'Perhiasan Tradisional',
                'description' => 'Koleksi perhiasan dan aksesoris tradisional',
                'icon' => 'gem',
                'is_active' => true
            ],
            [
                'name' => 'Alat Musik',
                'description' => 'Koleksi alat musik tradisional dan modern',
                'icon' => 'music',
                'is_active' => true
            ],
            [
                'name' => 'Kerajinan Tangan',
                'description' => 'Koleksi kerajinan tangan dan seni rupa',
                'icon' => 'hand',
                'is_active' => true
            ],
            [
                'name' => 'Dokumen & Naskah',
                'description' => 'Koleksi dokumen, naskah kuno, dan arsip sejarah',
                'icon' => 'book',
                'is_active' => true
            ],
            [
                'name' => 'Fotografi',
                'description' => 'Koleksi foto dokumentasi budaya dan sejarah',
                'icon' => 'camera',
                'is_active' => true
            ],
            [
                'name' => 'Artefak Arkeologi',
                'description' => 'Koleksi artefak dan benda arkeologi',
                'icon' => 'archaeology',
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'icon' => $category['icon'],
                'is_active' => $category['is_active']
            ]);
        }
    }
}
