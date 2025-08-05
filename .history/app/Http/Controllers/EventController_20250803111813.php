<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Event;
use App\Models\Visit;
use App\Models\MuseumSetting;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::query();

        // Filter by type
        if ($request->has('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('organizer', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'upcoming');
        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('event_date', 'asc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'featured':
                $query->where('is_featured', true)->orderBy('event_date', 'asc');
                break;
            default:
                $query->orderBy('event_date', 'asc');
                break;
        }

        $events = $query->paginate(9);

        // Transform events data to include image_url
        $events->getCollection()->transform(function ($item) {
            $item->image_url = $item->image ? asset('storage/' . $item->image) : null;
            return $item;
        });

        // Get event types for filter
        $eventTypes = [
            'exhibition' => 'Pameran',
            'workshop' => 'Workshop',
            'seminar' => 'Seminar',
            'performance' => 'Pertunjukan',
            'other' => 'Lainnya'
        ];

        // Get event statuses for filter
        $eventStatuses = [
            'upcoming' => 'Akan Datang',
            'ongoing' => 'Sedang Berlangsung',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];

        // Get featured events for sidebar
        $featuredEvents = Event::where('is_featured', true)
            ->orderBy('event_date', 'asc')
            ->take(5)
            ->get();

        // Transform featured events data
        $featuredEvents->transform(function ($item) {
            $item->image_url = $item->image ? asset('storage/' . $item->image) : null;
            return $item;
        });

        // Get upcoming events for sidebar
        $upcomingEvents = Event::where('event_date', '>=', now()->toDateString())
            ->where('status', 'upcoming')
            ->orderBy('event_date', 'asc')
            ->take(5)
            ->get();

        // Transform upcoming events data
        $upcomingEvents->transform(function ($item) {
            $item->image_url = $item->image ? asset('storage/' . $item->image) : null;
            return $item;
        });

        // Get museum settings
        $museumSettings = MuseumSetting::getSettings();

        return Inertia::render('Events', [
            'events' => $events,
            'eventTypes' => $eventTypes,
            'eventStatuses' => $eventStatuses,
            'featuredEvents' => $featuredEvents,
            'upcomingEvents' => $upcomingEvents,
            'filters' => [
                'type' => $request->get('type', 'all'),
                'status' => $request->get('status', 'all'),
                'search' => $request->get('search', ''),
                'sort' => $sortBy,
            ],
            'museumSettings' => $museumSettings,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // Load related events
        $relatedEvents = Event::where('type', $event->type)
            ->where('id', '!=', $event->id)
            ->where('status', 'upcoming')
            ->limit(3)
            ->get();

        // Transform related events data
        $relatedEvents->transform(function ($item) {
            $item->image_url = $item->image ? asset('storage/' . $item->image) : null;
            return $item;
        });

        // Get upcoming events for sidebar
        $upcomingEvents = Event::where('event_date', '>=', now()->toDateString())
            ->where('status', 'upcoming')
            ->where('id', '!=', $event->id)
            ->orderBy('event_date', 'asc')
            ->take(5)
            ->get();

        // Transform upcoming events data
        $upcomingEvents->transform(function ($item) {
            $item->image_url = $item->image ? asset('storage/' . $item->image) : null;
            return $item;
        });

        // Track visit
        Visit::create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'page_visited' => 'event_detail',
            'device_type' => $this->getDeviceType()
        ]);

        // Get museum settings
        $museumSettings = MuseumSetting::getSettings();

        // Add image_url to main event object
        $event->image_url = $event->image ? asset('storage/' . $event->image) : null;

        // Debug: Log event data
        \Log::info('Event data being sent to EventDetail:', [
            'event_id' => $event->id,
            'event_image' => $event->image,
            'event_image_url' => $event->image_url,
        ]);

        return Inertia::render('EventDetail', [
            'event' => $event,
            'relatedEvents' => $relatedEvents,
            'recentEvents' => $upcomingEvents,
            'museumSettings' => $museumSettings,
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
