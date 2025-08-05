<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\News;
use App\Models\Event;
use App\Models\Testimonial;
use App\Models\MuseumSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index()
    {
        // Get live data from database
        $collections = Collection::count();
        $news = News::count();
        $events = Event::count();
        $testimonials = Testimonial::count();

        // Get museum settings (location data)
        $museumSettings = MuseumSetting::getSettings();

        return Inertia::render('Contact', [
            'collections' => ['total' => $collections],
            'news' => ['total' => $news],
            'events' => ['total' => $events],
            'testimonials' => ['total' => $testimonials],
            'museumSettings' => $museumSettings
        ]);
    }
}
