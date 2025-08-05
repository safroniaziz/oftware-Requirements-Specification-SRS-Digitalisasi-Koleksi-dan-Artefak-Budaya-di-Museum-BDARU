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
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            CollectionSeeder::class,
            NewsCategorySeeder::class,
            NewsSeeder::class,
            EventSeeder::class,
            TestimonialSeeder::class,
            TeamMemberSeeder::class,
            MuseumSettingSeeder::class,
            // New collection-related seeders
            CollectionHistorySeeder::class,
            CollectionCulturalPointSeeder::class,
            CollectionTechnicalSpecSeeder::class,
            CollectionConservationRecordSeeder::class,
        ]);
    }
}
