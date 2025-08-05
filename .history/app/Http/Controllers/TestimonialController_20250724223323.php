<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
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
            ->paginate(12);

        $featuredTestimonials = Testimonial::featured()
            ->orderBy('rating', 'desc')
            ->limit(3)
            ->get();

        return Inertia::render('Testimonials', [
            'testimonials' => $testimonials,
            'featuredTestimonials' => $featuredTestimonials,
        ]);
    }

    /**
     * Store a new testimonial
     */
    public function store(Request $request)
    {
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
            'status' => 'pending', // Default status pending
        ]);

        return redirect()->back()->with('success', 'Testimoni Anda telah berhasil dikirim dan sedang menunggu persetujuan admin.');
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
