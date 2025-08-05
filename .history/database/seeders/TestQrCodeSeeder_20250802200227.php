<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Collection;
use App\Services\QrCodeService;
use Illuminate\Support\Facades\Log;

class TestQrCodeSeeder extends Seeder
{
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing collections that don't have QR codes
        $collections = Collection::whereDoesntHave('qrCodes')->get();

        foreach ($collections as $collection) {
            try {
                $this->qrCodeService->generateQrCode($collection);
                $this->command->info("QR Code generated for collection: {$collection->name}");
            } catch (\Exception $e) {
                Log::error('Failed to generate QR code for collection ' . $collection->id . ': ' . $e->getMessage());
                $this->command->error("Failed to generate QR code for collection: {$collection->name}");
            }
        }

        $this->command->info('QR Code generation completed!');
    }
}
