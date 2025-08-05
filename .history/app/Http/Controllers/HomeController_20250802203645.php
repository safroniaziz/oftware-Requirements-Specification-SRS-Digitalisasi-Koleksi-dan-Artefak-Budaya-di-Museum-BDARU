<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;
use App\Models\Collection;
use App\Models\News;
use App\Models\Category;
use App\Models\Visit;
use App\Models\Testimonial;
use App\Models\MuseumSetting;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCollections = Collection::with(['category', 'latestQrCode'])
            ->where('is_active', true)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $recentNews = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        $stats = [
            'totalCollections' => Collection::where('is_active', true)->count(),
            'totalCategories' => Category::where('is_active', true)->count(),
            'totalVisits' => Visit::count(),
            'featuredCollections' => Collection::where('is_featured', true)->count(),
        ];

        $featuredTestimonials = Testimonial::featured()
            ->orderBy('rating', 'desc')
            ->limit(3)
            ->get();

        // Get museum settings
        $museumSettings = MuseumSetting::getSettings();

        return Inertia::render('Welcome', [
            'featuredCollections' => $featuredCollections->map(function ($collection) {
                $collection->image_url = $collection->image_url;
                $collection->latest_qr_code = $collection->latestQrCode ? [
                    'qr_code' => $collection->latestQrCode->qr_code,
                    'qr_image_url' => asset('storage/' . $collection->latestQrCode->qr_image_path),
                    'scan_count' => $collection->latestQrCode->scan_count,
                    'last_scanned_at' => $collection->latestQrCode->last_scanned_at
                ] : null;
                return $collection;
            }),
            'recentNews' => $recentNews->map(function ($news) {
                $news->image_url = $news->image_url;
                return $news;
            }),
            'stats' => $stats,
            'featuredTestimonials' => $featuredTestimonials,
            'museumSettings' => $museumSettings,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
