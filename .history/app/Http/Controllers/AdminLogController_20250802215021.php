<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminLogController extends Controller
{
    public function index()
    {
        $logFiles = [];
        $logPath = storage_path('logs');

        if (File::exists($logPath)) {
            $files = File::files($logPath);
            foreach ($files as $file) {
                if ($file->getExtension() === 'log') {
                    $logFiles[] = [
                        'name' => $file->getFilename(),
                        'size' => $file->getSize(),
                        'date' => $file->getMTime(),
                    ];
                }
            }
        }

        return view('management.logs.index', compact('logFiles'));
    }

    public function show($filename)
    {
        $logPath = storage_path('logs/' . $filename);

        if (!File::exists($logPath)) {
            abort(404, 'File log tidak ditemukan');
        }

        $content = File::get($logPath);
        $lines = explode("\n", $content);
        $lines = array_reverse($lines); // Show latest first

        return view('management.logs.show', compact('filename', 'lines'));
    }

    public function download($filename)
    {
        $logPath = storage_path('logs/' . $filename);

        if (!File::exists($logPath)) {
            abort(404, 'File log tidak ditemukan');
        }

        return response()->download($logPath, $filename);
    }

    public function clear($filename)
    {
        $logPath = storage_path('logs/' . $filename);

        if (File::exists($logPath)) {
            File::put($logPath, '');
            return redirect()->route('logs-management.index')
                ->with('success', 'File log berhasil dibersihkan!');
        }

        return redirect()->route('logs-management.index')
            ->with('error', 'File log tidak ditemukan');
    }
}
