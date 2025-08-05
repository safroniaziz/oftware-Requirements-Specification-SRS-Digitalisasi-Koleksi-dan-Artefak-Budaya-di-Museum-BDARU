<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\News;
use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Basic stats for all users
        $stats = [
            'total_collections' => Collection::count(),
            'total_news' => News::count(),
            'total_events' => Event::count(),
            'total_categories' => Category::count(),
            'total_testimonials' => Testimonial::count(),
            'total_visits' => Visit::whereDate('created_at', today())->count(),
        ];

        // Admin-specific stats
        if ($user->hasRole('admin')) {
            $stats['total_users'] = User::count();
        }

        // Performance metrics
        $performanceMetrics = [
            'collection_completion_rate' => $this->calculateCollectionCompletionRate(),
            'news_publish_rate' => $this->calculateNewsPublishRate(),
            'event_completion_rate' => $this->calculateEventCompletionRate(),
            'category_usage_rate' => $this->calculateCategoryUsageRate(),
        ];

        // Admin-specific metrics
        if ($user->hasRole('admin')) {
            $performanceMetrics['user_activity_rate'] = $this->calculateUserActivityRate();
        }

        // Chart data
        $chartData = [
            'collectionsByCategory' => $this->getCollectionsByCategory(),
            'newsStatus' => $this->getNewsStatus(),
            'categoryDistribution' => $this->getCategoryDistribution(),
        ];

        // Recent activities
        $recentActivities = $this->getRecentActivities();

        return view('dashboard', compact('stats', 'performanceMetrics', 'chartData', 'recentActivities'));
    }

    private function calculateCollectionCompletionRate()
    {
        $totalCollections = Collection::count();
        if ($totalCollections === 0) return 0;

        // Koleksi dianggap lengkap jika memiliki nama, deskripsi, dan kategori
        $completeCollections = Collection::whereNotNull('name')
            ->whereNotNull('description')
            ->whereNotNull('category_id')
            ->count();

        return round(($completeCollections / $totalCollections) * 100);
    }

    private function calculateNewsPublishRate()
    {
        $totalNews = News::count();
        if ($totalNews === 0) return 0;

        $publishedNews = News::where('is_published', true)->count();
        return round(($publishedNews / $totalNews) * 100);
    }

    private function calculateEventCompletionRate()
    {
        $totalEvents = Event::count();
        if ($totalEvents === 0) return 0;

        // Agenda dianggap aktif jika event_date >= hari ini dan status bukan cancelled
        $activeEvents = Event::where('event_date', '>=', now()->toDateString())
            ->where('status', '!=', 'cancelled')
            ->count();

        return round(($activeEvents / $totalEvents) * 100);
    }

    private function calculateCategoryUsageRate()
    {
        $totalCategories = Category::count();
        if ($totalCategories === 0) return 0;

        $usedCategories = Category::whereHas('collections')->count();
        return round(($usedCategories / $totalCategories) * 100);
    }

    private function calculateUserActivityRate()
    {
        $totalUsers = User::count();
        if ($totalUsers === 0) return 0;

        // User dianggap aktif jika login dalam 30 hari terakhir
        $activeUsers = User::where('updated_at', '>=', now()->subDays(30))->count();
        return round(($activeUsers / $totalUsers) * 100);
    }

    private function getCollectionsByCategory()
    {
        return Category::withCount(['collections' => function($query) {
            $query->whereNotNull('name');
        }])
        ->orderBy('collections_count', 'desc')
        ->limit(8)
        ->get()
        ->map(function ($category) {
            return [
                'name' => $category->name,
                'count' => $category->collections_count
            ];
        });
    }

    private function getNewsStatus()
    {
        return [
            'published' => News::where('is_published', true)->count(),
            'draft' => News::where('is_published', false)->count(),
            'archived' => 0, // Set to 0 since we don't have is_archived field yet
        ];
    }

    private function getCategoryDistribution()
    {
        return Category::withCount('collections')
            ->pluck('collections_count', 'name')
            ->toArray();
    }

    private function getRecentActivities()
    {
        $activities = [];

        // Recent collections
        $recentCollections = Collection::latest()->limit(3)->get();
        foreach ($recentCollections as $collection) {
            $activities[] = [
                'title' => 'Koleksi baru ditambahkan',
                'description' => $collection->name,
                'time' => $collection->created_at->diffForHumans(),
                'color' => 'primary',
                'icon' => 'ki-duotone ki-boxes'
            ];
        }

        // Recent news
        $recentNews = News::latest()->limit(3)->get();
        foreach ($recentNews as $news) {
            $activities[] = [
                'title' => 'Berita baru dipublikasikan',
                'description' => $news->title,
                'time' => $news->created_at->diffForHumans(),
                'color' => 'success',
                'icon' => 'ki-duotone ki-newspaper'
            ];
        }

        // Recent events
        $recentEvents = Event::latest()->limit(3)->get();
        foreach ($recentEvents as $event) {
            $activities[] = [
                'title' => 'Agenda baru ditambahkan',
                'description' => $event->title,
                'time' => $event->created_at->diffForHumans(),
                'color' => 'warning',
                'icon' => 'ki-duotone ki-calendar'
            ];
        }

        // Sort by time and limit to 10
        usort($activities, function ($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        return array_slice($activities, 0, 10);
    }
}
