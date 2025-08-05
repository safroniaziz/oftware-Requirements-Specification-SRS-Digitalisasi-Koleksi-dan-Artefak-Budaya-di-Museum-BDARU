<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

class AdminBackupController extends Controller
{
    public function index()
    {
        // Get backup files
        $backupFiles = [];
        if (Storage::disk('local')->exists('backups')) {
            $files = Storage::disk('local')->files('backups');
            foreach ($files as $file) {
                $backupFiles[] = [
                    'name' => basename($file),
                    'size' => Storage::disk('local')->size($file),
                    'date' => Storage::disk('local')->lastModified($file),
                ];
            }
        }

        return view('management.backup.index', compact('backupFiles'));
    }

    public function create()
    {
        try {
            // Create backup using Laravel's backup command
            Artisan::call('backup:run');

            return redirect()->route('backup-management.index')
                ->with('success', 'Backup database berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->route('backup-management.index')
                ->with('error', 'Gagal membuat backup: ' . $e->getMessage());
        }
    }

    public function download($filename)
    {
        $path = 'backups/' . $filename;

        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'File backup tidak ditemukan');
        }

        return Storage::disk('local')->download($path);
    }

    public function delete($filename)
    {
        $path = 'backups/' . $filename;

        if (Storage::disk('local')->exists($path)) {
            Storage::disk('local')->delete($path);
            return redirect()->route('backup-management.index')
                ->with('success', 'File backup berhasil dihapus!');
        }

        return redirect()->route('backup-management.index')
            ->with('error', 'File backup tidak ditemukan');
    }
}
