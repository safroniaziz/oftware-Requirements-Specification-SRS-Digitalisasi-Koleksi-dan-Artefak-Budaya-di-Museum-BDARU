<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\TestCollectionSeeder;

class SeedTestCollections extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:test-collections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed test collections for QR code generation testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Seeding test collections...');

        $seeder = new TestCollectionSeeder();
        $seeder->run();

        $this->info('Test collections seeded successfully!');
        $this->info('You can now test QR code generation for these collections.');
        $this->info('Go to admin panel > Collections Management to generate QR codes.');
    }
}
