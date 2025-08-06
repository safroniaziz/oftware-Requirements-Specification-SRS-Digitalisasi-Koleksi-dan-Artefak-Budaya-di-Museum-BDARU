<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class QrCodeController extends Controller
{
    /**
     * Serve QR code SVG files
     */
    public function show($filename)
    {
        // Validate filename
        if (!preg_match('/^[A-Z0-9-]+\.svg$/', $filename)) {
            abort(404);
        }

        // Try multiple paths for hosting compatibility
        $paths = [
            storage_path('app/public/qr-codes/' . $filename),
            public_path('storage/qr-codes/' . $filename),
            storage_path('qr-codes/' . $filename),
        ];

        $filePath = null;
        foreach ($paths as $path) {
            if (file_exists($path)) {
                $filePath = $path;
                break;
            }
        }

        if (!$filePath) {
            // Try to get from storage disk
            try {
                $content = Storage::disk('public')->get('qr-codes/' . $filename);
                if ($content) {
                    return Response::make($content, 200, [
                        'Content-Type' => 'image/svg+xml',
                        'Cache-Control' => 'public, max-age=31536000',
                        'Access-Control-Allow-Origin' => '*'
                    ]);
                }
            } catch (\Exception $e) {
                // Continue to next fallback
            }

            abort(404);
        }

        return Response::file($filePath, [
            'Content-Type' => 'image/svg+xml',
            'Cache-Control' => 'public, max-age=31536000',
            'Access-Control-Allow-Origin' => '*'
        ]);
    }
}
