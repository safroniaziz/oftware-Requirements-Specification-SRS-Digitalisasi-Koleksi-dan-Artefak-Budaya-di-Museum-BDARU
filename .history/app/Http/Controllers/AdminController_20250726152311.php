<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\News;
use App\Models\Event;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Category;
use App\Models\NewsCategory;
use App\Models\MuseumSetting;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function collections()
    {
        $collections = Collection::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.collections.index', compact('collections'));
    }

    public function news()
    {
        $news = News::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.news.index', compact('news'));
    }

    public function events()
    {
        $events = Event::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.events.index', compact('events'));
    }

    public function testimonials()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function teamMembers()
    {
        $teamMembers = TeamMember::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.team-members.index', compact('teamMembers'));
    }

    public function categories()
    {
        $categories = Category::withCount('collections')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function newsCategories()
    {
        $newsCategories = NewsCategory::withCount('news')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.news-categories.index', compact('newsCategories'));
    }

    public function settings()
    {
        $settings = MuseumSetting::first();

        return view('admin.settings.index', compact('settings'));
    }
}
