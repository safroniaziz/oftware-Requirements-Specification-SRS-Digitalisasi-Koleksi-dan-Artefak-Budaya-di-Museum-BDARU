<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Inertia\Inertia;
use App\Models\News;
use App\Models\Category;
use App\Models\NewsCategory;
use App\Models\Visit;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = News::with(['category']);

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        // Only show published news
        $query->where('is_published', true);

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('published_at', 'asc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'popular':
                $query->orderBy('view_count', 'desc');
                break;
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        $news = $query->paginate(9);

        // Get categories for filter
        $categories = Category::withCount(['news' => function ($query) {
            $query->where('is_published', true);
        }])->get();

        // Get featured news for sidebar
        $featuredNews = News::where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        // Get recent news for sidebar
        $recentNews = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        return Inertia::render('News', [
            'news' => $news,
            'categories' => $categories,
            'featuredNews' => $featuredNews,
            'recentNews' => $recentNews,
            'filters' => [
                'category' => $request->get('category', 'all'),
                'search' => $request->get('search', ''),
                'sort' => $sortBy,
            ],
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        // Check if news is published
        if (!$news->is_published) {
            abort(404);
        }

        // Increment view count
        $news->increment('view_count');

        // Load related news
        $relatedNews = News::where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->where('is_published', true)
            ->limit(3)
            ->get();

        // Get recent news for sidebar
        $recentNews = News::where('is_published', true)
            ->where('id', '!=', $news->id)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        // Track visit
        Visit::create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'page_visited' => 'news_detail',
            'device_type' => $this->getDeviceType()
        ]);

        return Inertia::render('NewsDetail', [
            'news' => $news->load(['category']),
            'relatedNews' => $relatedNews,
            'recentNews' => $recentNews,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    private function getDeviceType()
    {
        $userAgent = request()->userAgent();
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($userAgent))) {
            return 'tablet';
        }
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($userAgent))) {
            return 'mobile';
        }
        return 'desktop';
    }
}
