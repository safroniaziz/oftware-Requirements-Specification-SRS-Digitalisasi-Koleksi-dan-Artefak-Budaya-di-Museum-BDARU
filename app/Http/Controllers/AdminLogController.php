<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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

        // Get recent activities from Laravel logs
        $recentActivities = $this->getRecentActivities();

        return view('management.logs.index', compact('logFiles', 'recentActivities'));
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

            // Log the clear action
            Log::info('Log file cleared', [
                'filename' => $filename,
                'file_size_before' => File::exists($logPath) ? File::size($logPath) : 0,
                'user_id' => Auth::user() ? Auth::user()->id : null,
                'user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
                'user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
                'user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'action' => 'LOG_CLEAR',
                'timestamp' => now()->toDateTimeString()
            ]);

            return redirect()->route('logs-management.index')
                ->with('success', 'File log berhasil dibersihkan!');
        }

        return redirect()->route('logs-management.index')
            ->with('error', 'File log tidak ditemukan');
    }

    private function getRecentActivities()
    {
        $activities = [];
        $logPath = storage_path('logs/laravel.log');

        if (File::exists($logPath)) {
            $content = File::get($logPath);
            $lines = explode("\n", $content);
            $lines = array_reverse($lines); // Latest first

            $count = 0;
            foreach ($lines as $line) {
                if ($count >= 50) break; // Limit to 50 recent activities

                if (!empty(trim($line))) {
                    $activities[] = [
                        'log' => $line,
                        'type' => $this->getLogType($line),
                        'timestamp' => $this->extractTimestamp($line)
                    ];
                    $count++;
                }
            }
        }

        return $activities;
    }

    private function getLogType($line)
    {
        if (strpos($line, '.ERROR') !== false) return 'error';
        if (strpos($line, '.WARNING') !== false) return 'warning';
        if (strpos($line, '.INFO') !== false) return 'info';
        if (strpos($line, '.DEBUG') !== false) return 'debug';
        return 'info';
    }

    private function extractTimestamp($line)
    {
        // Extract timestamp from log line
        if (preg_match('/\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]/', $line, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
