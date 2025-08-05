<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HeroImage;

class HeroImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heroImages = [
            [
                'title' => 'Galeri Seni Rupa',
                'subtitle' => 'Koleksi Lukisan Klasik Indonesia',
                'description' => 'Jelajahi keindahan seni rupa tradisional dan kontemporer yang menceritakan sejarah dan budaya Indonesia melalui karya-karya masterpiece dari berbagai era.',
                'image_path' => null, // Admin akan upload gambar nanti
                'alt_text' => 'Galeri Seni Rupa Museum Digital Indonesia',
                'is_active' => true,
            ],
            [
                'title' => 'Artefak Kuno',
                'subtitle' => 'Peninggalan Sejarah Nusantara',
                'description' => 'Temukan harta karun arkeologi dari masa lalu yang mengungkapkan peradaban dan kebudayaan nenek moyang bangsa Indonesia.',
                'image_path' => null, // Admin akan upload gambar nanti
                'alt_text' => 'Artefak Kuno Peninggalan Sejarah',
                'is_active' => true,
            ],
            [
                'title' => 'Kain Tradisional',
                'subtitle' => 'Batik dan Tenun Nusantara',
                'description' => 'Warisan tekstil yang menceritakan budaya bangsa melalui motif, warna, dan teknik pembuatan yang telah diwariskan turun-temurun.',
                'image_path' => null, // Admin akan upload gambar nanti
                'alt_text' => 'Kain Tradisional Batik dan Tenun',
                'is_active' => true,
            ],
        ];

        foreach ($heroImages as $heroImage) {
            HeroImage::create($heroImage);
        }

        $this->command->info('Hero Images seeded successfully!');
        $this->command->info('Note: Please upload actual images through the admin panel.');
    }
}
