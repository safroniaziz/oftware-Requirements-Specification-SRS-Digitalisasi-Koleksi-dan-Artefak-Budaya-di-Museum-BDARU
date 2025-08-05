<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Setting up placeholder images...');

        // Create directories if they don't exist
        $directories = [
            'collections',
            'news',
            'events',
            'testimonials',
            'team-members'
        ];

        foreach ($directories as $directory) {
            $path = storage_path("app/public/{$directory}");
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
                $this->command->info("Created directory: {$directory}");
            }
        }

        // Create placeholder images for collections
        for ($i = 1; $i <= 12; $i++) {
            $path = storage_path("app/public/collections/collection-{$i}.jpg");
            if (!File::exists($path)) {
                File::put($path, '');
                $this->command->info("Created: collections/collection-{$i}.jpg");
            }
        }

        // Create placeholder images for news
        for ($i = 1; $i <= 8; $i++) {
            $path = storage_path("app/public/news/news-{$i}.jpg");
            if (!File::exists($path)) {
                File::put($path, '');
                $this->command->info("Created: news/news-{$i}.jpg");
            }
        }

        // Create placeholder images for events
        for ($i = 1; $i <= 6; $i++) {
            $path = storage_path("app/public/events/event-{$i}.jpg");
            if (!File::exists($path)) {
                File::put($path, '');
                $this->command->info("Created: events/event-{$i}.jpg");
            }
        }

        // Create category images for news
        $newsCategories = ['museum', 'cultural', 'heritage', 'art', 'workshop', 'education', 'digital', 'festival'];
        foreach ($newsCategories as $category) {
            $path = storage_path("app/public/news/category-{$category}.jpg");
            if (!File::exists($path)) {
                File::put($path, '');
                $this->command->info("Created: news/category-{$category}.jpg");
            }
        }

        // Create type images for events
        $eventTypes = ['museum', 'exhibition', 'workshop', 'seminar', 'performance', 'cultural', 'artshow', 'festival'];
        foreach ($eventTypes as $type) {
            $path = storage_path("app/public/events/type-{$type}.jpg");
            if (!File::exists($path)) {
                File::put($path, '');
                $this->command->info("Created: events/type-{$type}.jpg");
            }
        }

        $this->command->info('Placeholder images setup completed!');
    }
}
