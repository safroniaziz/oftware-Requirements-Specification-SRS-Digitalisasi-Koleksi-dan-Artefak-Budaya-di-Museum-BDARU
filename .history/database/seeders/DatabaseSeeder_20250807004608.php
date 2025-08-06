<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class, // Harus dijalankan pertama untuk membuat role dan permission
            UserSeeder::class,
            MuseumSettingSeeder::class, // Pengaturan museum
            CategorySeeder::class,
            NewsCategorySeeder::class,
            CollectionSeeder::class,
            AdditionalCollectionSeeder::class, // Koleksi tambahan tanpa QR code untuk testing
            CollectionHistorySeeder::class, // Harus setelah CollectionSeeder
            CollectionTechnicalSpecSeeder::class, // Harus setelah CollectionSeeder
            CollectionConservationRecordSeeder::class, // Harus setelah CollectionSeeder
            CollectionRatingSeeder::class, // Harus setelah CollectionSeeder
            NewsSeeder::class,
            EventSeeder::class,
            TeamMemberSeeder::class,
            TestimonialSeeder::class,
            HeroImageSeeder::class,
            TestQrCodeSeeder::class, // QR Code test data
        ]);
    }
}
