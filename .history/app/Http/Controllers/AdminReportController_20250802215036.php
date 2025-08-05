<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\News;
use App\Models\Event;
use App\Models\CollectionQrCode;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function index()
    {
        // Collection statistics
        $collectionStats = [
            'total' => Collection::whereNull('deleted_at')->count(),
            'by_category' => Collection::whereNull('deleted_at')
                ->with('category')
                ->get()
                ->groupBy('category.name')
                ->map->count(),
        ];

        // QR Code statistics
        $qrStats = [
            'total_codes' => CollectionQrCode::count(),
            'total_scans' => CollectionQrCode::sum('scan_count'),
            'most_scanned' => CollectionQrCode::with('collection')
                ->orderBy('scan_count', 'desc')
                ->limit(5)
                ->get(),
        ];

        // User activity
        $userStats = [
            'total_users' => User::count(),
            'recent_registrations' => User::orderBy('created_at', 'desc')
                ->limit(10)
                ->get(),
        ];

        // Content statistics
        $contentStats = [
            'news' => News::whereNull('deleted_at')->count(),
            'events' => Event::whereNull('deleted_at')->count(),
        ];

        return view('management.reports.index', compact(
            'collectionStats',
            'qrStats',
            'userStats',
            'contentStats'
        ));
    }

    public function collections()
    {
        $collections = Collection::whereNull('deleted_at')
            ->with(['category', 'qrCodes'])
            ->get()
            ->map(function($collection) {
                return [
                    'id' => $collection->id,
                    'name' => $collection->name,
                    'category' => $collection->category->name ?? 'Tidak ada kategori',
                    'qr_codes' => $collection->qrCodes->count(),
                    'total_scans' => $collection->qrCodes->sum('scan_count'),
                    'created_at' => $collection->created_at->format('d/m/Y'),
                ];
            });

        return view('management.reports.collections', compact('collections'));
    }

    public function qrCodes()
    {
        $qrCodes = CollectionQrCode::with('collection')
            ->orderBy('scan_count', 'desc')
            ->get()
            ->map(function($qrCode) {
                return [
                    'id' => $qrCode->id,
                    'code' => $qrCode->qr_code,
                    'collection' => $qrCode->collection->name,
                    'scan_count' => $qrCode->scan_count,
                    'last_scanned' => $qrCode->last_scanned_at ? $qrCode->last_scanned_at->format('d/m/Y H:i') : 'Belum pernah di-scan',
                    'created_at' => $qrCode->created_at->format('d/m/Y'),
                ];
            });

        return view('management.reports.qr-codes', compact('qrCodes'));
    }
}
