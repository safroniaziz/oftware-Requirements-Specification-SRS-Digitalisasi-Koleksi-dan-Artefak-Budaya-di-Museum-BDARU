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
        // Run seeders in order
        $this->call([
            ImageSeeder::class, // Setup placeholder images first
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            CollectionSeeder::class,
            NewsCategorySeeder::class,
            NewsSeeder::class,
            EventSeeder::class,
            TestimonialSeeder::class,
            MuseumSettingSeeder::class,
            TeamMemberSeeder::class,
        ]);
    }
}
