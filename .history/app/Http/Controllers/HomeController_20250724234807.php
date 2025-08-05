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

class HomeController extends Controller
{
    public function index()
    {
        $featuredCollections = Collection::with('category')
            ->where('is_featured', true)
            ->where('is_active', true)
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

        return Inertia::render('Welcome', [
            'featuredCollections' => $featuredCollections,
            'recentNews' => $recentNews,
            'stats' => $stats,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
