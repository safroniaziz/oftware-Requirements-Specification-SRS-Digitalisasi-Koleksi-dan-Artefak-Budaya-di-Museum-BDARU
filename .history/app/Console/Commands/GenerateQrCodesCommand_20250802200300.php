<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Collection;
use App\Services\QrCodeService;
use Illuminate\Support\Facades\Log;

class GenerateQrCodesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qr:generate {--collection-id= : Generate QR code for specific collection ID} {--all : Generate QR codes for all collections}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate QR codes for collections';

    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        parent::__construct();
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $collectionId = $this->option('collection-id');
        $all = $this->option('all');

        if ($collectionId) {
            // Generate QR code for specific collection
            $collection = Collection::find($collectionId);
            if (!$collection) {
                $this->error("Collection with ID {$collectionId} not found!");
                return 1;
            }

            $this->generateQrCodeForCollection($collection);
        } elseif ($all) {
            // Generate QR codes for all collections that don't have QR codes
            $collections = Collection::whereDoesntHave('qrCodes')->get();

            if ($collections->isEmpty()) {
                $this->info('All collections already have QR codes!');
                return 0;
            }

            $this->info("Generating QR codes for {$collections->count()} collections...");

            $bar = $this->output->createProgressBar($collections->count());
            $bar->start();

            foreach ($collections as $collection) {
                $this->generateQrCodeForCollection($collection, false);
                $bar->advance();
            }

            $bar->finish();
            $this->newLine();
            $this->info('QR codes generation completed!');
        } else {
            $this->error('Please specify --collection-id or --all option');
            $this->info('Usage:');
            $this->info('  php artisan qr:generate --collection-id=1');
            $this->info('  php artisan qr:generate --all');
            return 1;
        }

        return 0;
    }

    private function generateQrCodeForCollection($collection, $showInfo = true)
    {
        try {
            $qrCode = $this->qrCodeService->generateQrCode($collection);
            if ($showInfo) {
                $this->info("QR Code generated successfully for collection: {$collection->name}");
                $this->info("QR Code: {$qrCode->qr_code}");
                $this->info("Image Path: {$qrCode->qr_image_path}");
            }
        } catch (\Exception $e) {
            Log::error('Failed to generate QR code for collection ' . $collection->id . ': ' . $e->getMessage());
            if ($showInfo) {
                $this->error("Failed to generate QR code for collection: {$collection->name}");
                $this->error("Error: " . $e->getMessage());
            }
        }
    }
}
