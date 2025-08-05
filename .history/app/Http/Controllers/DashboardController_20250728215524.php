<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Event;
use App\Models\News;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch all data dynamically from database
        $stats = [
            'totalCollections' => Collection::count(),
            'totalNews' => News::count(),
            'totalEvents' => Event::count(),
            'totalUsers' => User::count(),
            'totalCategories' => Category::count(),
            'totalTestimonials' => Testimonial::count(),
            'totalVisits' => Visit::whereDate('created_at', today())->count(),
            'totalTeamMembers' => TeamMember::count(),
        ];

        // Calculate performance metrics
        $performanceMetrics = [
            'collectionsPercentage' => $this->calculatePercentage($stats['totalCollections'], 100),
            'newsPercentage' => $this->calculatePercentage($stats['totalNews'], 50),
            'eventsPercentage' => $this->calculatePercentage($stats['totalEvents'], 20),
            'usersPercentage' => $this->calculatePercentage($stats['totalUsers'], 50),
        ];

        return view('dashboard', compact('stats', 'performanceMetrics'));
    }

    private function calculatePercentage($current, $target)
    {
        if ($target == 0) return 0;
        $percentage = ($current / $target) * 100;
        return min(100, round($percentage, 1));
    }
}
