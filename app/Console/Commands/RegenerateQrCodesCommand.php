<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Collection;
use App\Services\QrCodeService;

class RegenerateQrCodesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qr:regenerate {--all : Regenerate all QR codes} {--collection= : Specific collection ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Regenerate QR codes for collections';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $qrService = new QrCodeService();

        if ($this->option('collection')) {
            $collection = Collection::find($this->option('collection'));
            if (!$collection) {
                $this->error('Collection not found!');
                return 1;
            }

            $this->info("Regenerating QR code for collection: {$collection->name}");
            $qrCode = $qrService->generateQrCode($collection);
            $this->info("QR Code generated: {$qrCode->qr_code}");
            return 0;
        }

        if ($this->option('all')) {
            $collections = Collection::all();
            $this->info("Found {$collections->count()} collections");

            $bar = $this->output->createProgressBar($collections->count());
            $bar->start();

            foreach ($collections as $collection) {
                $qrService->generateQrCode($collection);
                $bar->advance();
            }

            $bar->finish();
            $this->newLine();
            $this->info('All QR codes regenerated successfully!');
            return 0;
        }

        $this->error('Please specify --all or --collection=ID');
        return 1;
    }
}
