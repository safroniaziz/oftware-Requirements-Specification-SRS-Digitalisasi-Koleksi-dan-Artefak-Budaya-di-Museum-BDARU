<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\News;
use App\Models\Event;
use App\Models\Testimonial;
use App\Models\MuseumSetting;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function index()
    {
        // Get live data from database
        $collections = Collection::count();
        $news = News::count();
        $events = Event::count();
        $testimonials = Testimonial::count();

                // Get team members
        $teamMembers = TeamMember::active()->ordered()->get();

        // Get museum settings (about data)
        $museumSettings = MuseumSetting::getSettings();

        return Inertia::render('About', [
            'collections' => ['total' => $collections],
            'news' => ['total' => $news],
            'events' => ['total' => $events],
            'testimonials' => ['total' => $testimonials],
            'teamMembers' => $teamMembers->map(function($member) {
                return [
                    'id' => $member->id,
                    'name' => $member->name,
                    'position' => $member->position,
                    'description' => $member->description,
                    'photo' => $member->photo_url,
                    'email' => $member->email,
                    'linkedin' => $member->linkedin,
                    'twitter' => $member->twitter,
                ];
            }),
            'museumSettings' => $museumSettings
        ]);
    }
}
