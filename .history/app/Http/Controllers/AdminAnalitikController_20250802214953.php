<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\News;
use App\Models\Event;
use App\Models\TeamMember;
use App\Models\CollectionQrCode;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminAnalitikController extends Controller
{
    public function index()
    {
        // Get basic statistics
        $stats = [
            'total_collections' => Collection::whereNull('deleted_at')->count(),
            'total_news' => News::whereNull('deleted_at')->count(),
            'total_events' => Event::whereNull('deleted_at')->count(),
            'total_team_members' => TeamMember::whereNull('deleted_at')->count(),
            'total_users' => User::count(),
            'total_qr_codes' => CollectionQrCode::count(),
            'total_qr_scans' => CollectionQrCode::sum('scan_count'),
        ];

        // Get QR code scan statistics
        $qrScanStats = CollectionQrCode::select('collection_id', 'scan_count')
            ->with('collection:id,name')
            ->orderBy('scan_count', 'desc')
            ->limit(10)
            ->get();

        // Get recent activities
        $recentCollections = Collection::whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentNews = News::whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('management.analytics.index', compact('stats', 'qrScanStats', 'recentCollections', 'recentNews'));
    }
}
