<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Models\CollectionRating;
use App\Models\User;

class CollectionRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = Collection::all();
        $users = User::all();

        if ($collections->isEmpty()) {
            $this->command->info('No collections found. Please run CollectionSeeder first.');
            return;
        }

        foreach ($collections as $collection) {
            // Generate 3-8 random ratings per collection
            $ratingCount = rand(3, 8);

            for ($i = 0; $i < $ratingCount; $i++) {
                $rating = rand(30, 50) / 10; // Rating between 3.0 and 5.0

                CollectionRating::create([
                    'collection_id' => $collection->id,
                    'user_id' => $users->random()->id ?? null,
                    'visitor_ip' => fake()->ipv4(),
                    'visitor_session' => fake()->uuid(),
                    'rating' => $rating,
                    'comment' => rand(0, 1) ? fake()->sentence() : null,
                    'is_approved' => true,
                ]);
            }
        }

        $this->command->info('Collection ratings seeded successfully!');
    }
}
