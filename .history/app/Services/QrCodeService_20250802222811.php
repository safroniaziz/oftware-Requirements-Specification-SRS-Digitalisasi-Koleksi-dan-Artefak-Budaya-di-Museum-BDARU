<?php

namespace App\Services;

use App\Models\Collection;
use App\Models\CollectionQrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class QrCodeService
{
    /**
     * Generate new QR code for collection
     */
    public function generateQrCode(Collection $collection)
    {
        // Generate unique QR code
        $qrCode = CollectionQrCode::generateUniqueQrCode();

        // Create QR code URL
        $qrUrl = route('collections.show', $collection->slug) . '?qr=' . $qrCode;

        // Generate QR code image
        $qrImage = QrCode::format('png')
            ->size(300)
            ->margin(10)
            ->generate($qrUrl);

        // Save QR code image
        $imagePath = 'qr-codes/' . $qrCode . '.png';
        Storage::disk('public')->put($imagePath, $qrImage);

        // Create QR code record
        $collectionQrCode = CollectionQrCode::create([
            'collection_id' => $collection->id,
            'qr_code' => $qrCode,
            'qr_image_path' => $imagePath,
            'is_active' => true,
        ]);

        return $collectionQrCode;
    }

    /**
     * Reset QR code (generate new one but keep old ones active)
     */
    public function resetQrCode(Collection $collection)
    {
        return $this->generateQrCode($collection);
    }

    /**
     * Track QR code scan
     */
    public function trackScan($qrCode)
    {
        $collectionQrCode = CollectionQrCode::where('qr_code', $qrCode)->first();

        if ($collectionQrCode) {
            $collectionQrCode->update([
                'scan_count' => $collectionQrCode->scan_count + 1,
                'last_scanned_at' => now(),
            ]);

            return $collectionQrCode->collection;
        }

        return null;
    }

    /**
     * Get QR code image URL
     */
    public function getQrImageUrl($qrCode)
    {
        $collectionQrCode = CollectionQrCode::where('qr_code', $qrCode)->first();

        if ($collectionQrCode && $collectionQrCode->qr_image_path) {
            return asset('storage/' . $collectionQrCode->qr_image_path);
        }

        return null;
    }
}
