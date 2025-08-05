<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\MuseumSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class TestimonialController extends Controller
{
    /**
     * Display the testimonials page
     */
    public function index()
    {
        $testimonials = Testimonial::approved()
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        $featuredTestimonials = Testimonial::featured()
            ->orderBy('rating', 'desc')
            ->limit(3)
            ->get();

        // Get museum settings
        $museumSettings = MuseumSetting::getSettings();

        return Inertia::render('Testimonials', [
            'testimonials' => $testimonials,
            'featuredTestimonials' => $featuredTestimonials,
            'museumSettings' => $museumSettings,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'auth' => [
                'user' => Auth::user()
            ],
        ]);
    }

    /**
     * Store a new testimonial
     */
    public function store(Request $request)
    {
        // Jika user sudah login, gunakan data user
        if (Auth::check()) {
            $request->validate([
                'content' => 'required|string|min:10|max:1000',
                'rating' => 'required|integer|min:1|max:5',
            ]);

            $user = Auth::user();

            $testimonial = Testimonial::create([
                'name' => $user->name,
                'profession' => $user->profession,
                'content' => $request->content,
                'rating' => $request->rating,
                'email' => $user->email,
                'phone' => $user->phone,
                'user_id' => $user->id,
            ]);
        } else {
            // Jika guest, validasi semua field
            $request->validate([
                'name' => 'required|string|max:255',
                'profession' => 'nullable|string|max:255',
                'content' => 'required|string|min:10|max:1000',
                'rating' => 'required|integer|min:1|max:5',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:20',
            ]);

            $testimonial = Testimonial::create([
                'name' => $request->name,
                'profession' => $request->profession,
                'content' => $request->content,
                'rating' => $request->rating,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
        }

        return redirect()->back()->with('success', 'Testimoni Anda telah berhasil dikirim!');
    }

    /**
     * Get featured testimonials for Welcome page
     */
    public function getFeatured()
    {
        return Testimonial::featured()
            ->orderBy('rating', 'desc')
            ->limit(3)
            ->get();
    }
}
