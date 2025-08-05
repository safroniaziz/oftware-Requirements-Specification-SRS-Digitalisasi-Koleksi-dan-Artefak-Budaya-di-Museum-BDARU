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

        // Ensure logo_url is included in the data
        $museumSettingsData = $museumSettings->toArray();
        $museumSettingsData['logo_url'] = $museumSettings->logo_url;
        $museumSettingsData['favicon_url'] = $museumSettings->favicon_url;

        // Check if authenticated user has already submitted a testimonial
        $hasSubmittedTestimonial = false;
        if (Auth::check()) {
            $hasSubmittedTestimonial = Testimonial::where('user_id', Auth::id())->exists();
        }

        return Inertia::render('Testimonials', [
            'testimonials' => $testimonials,
            'featuredTestimonials' => $featuredTestimonials,
            'museumSettings' => $museumSettingsData,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'auth' => [
                'user' => Auth::user(),
                'hasSubmittedTestimonial' => $hasSubmittedTestimonial
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

            // Cek apakah user sudah pernah mengirim testimoni
            $existingTestimonial = Testimonial::where('user_id', $user->id)->first();
            if ($existingTestimonial) {
                return redirect()->back()->with('error', 'Anda sudah pernah mengirim testimoni sebelumnya.');
            }

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

            // Cek apakah guest dengan email yang sama sudah pernah mengirim testimoni
            if ($request->email) {
                $existingTestimonial = Testimonial::where('email', $request->email)->first();
                if ($existingTestimonial) {
                    return redirect()->back()->with('error', 'Email ini sudah pernah digunakan untuk mengirim testimoni.');
                }
            }

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
