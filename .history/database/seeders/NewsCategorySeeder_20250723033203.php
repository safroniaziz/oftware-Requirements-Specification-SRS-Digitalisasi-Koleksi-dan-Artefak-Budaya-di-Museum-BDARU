<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NewsCategory;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Berita Museum',
                'slug' => 'berita-museum',
                'description' => 'Berita seputar kegiatan dan perkembangan museum',
                'color' => '#10b981',
                'icon' => '🏛️',
                'sort_order' => 1
            ],
            [
                'name' => 'Pameran & Event',
                'slug' => 'pameran-event',
                'description' => 'Informasi pameran, event, dan kegiatan khusus',
                'color' => '#f59e0b',
                'icon' => '🎨',
                'sort_order' => 2
            ],
            [
                'name' => 'Workshop & Edukasi',
                'slug' => 'workshop-edukasi',
                'description' => 'Workshop, pelatihan, dan program edukasi',
                'color' => '#3b82f6',
                'icon' => '📚',
                'sort_order' => 3
            ],
            [
                'name' => 'Teknologi Digital',
                'slug' => 'teknologi-digital',
                'description' => 'Inovasi teknologi dan digitalisasi museum',
                'color' => '#8b5cf6',
                'icon' => '💻',
                'sort_order' => 4
            ],
            [
                'name' => 'Kebudayaan',
                'slug' => 'kebudayaan',
                'description' => 'Berita seputar budaya, tradisi, dan warisan',
                'color' => '#ef4444',
                'icon' => '🏺',
                'sort_order' => 5
            ],
            [
                'name' => 'Pengumuman',
                'slug' => 'pengumuman',
                'description' => 'Pengumuman resmi dan informasi penting',
                'color' => '#6b7280',
                'icon' => '📢',
                'sort_order' => 6
            ]
        ];

        foreach ($categories as $category) {
            NewsCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
