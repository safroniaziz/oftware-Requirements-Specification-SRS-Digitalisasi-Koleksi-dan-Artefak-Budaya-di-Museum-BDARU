<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;

class AdminPengelolaTestimoniController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('management.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('management.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Testimonial::create($request->all());

        return redirect()->route('testimonials-management.index')->with('success', 'Testimoni berhasil ditambahkan');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        return view('management.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $testimonial->update($request->all());

        return redirect()->route('testimonials-management.index')->with('success', 'Testimoni berhasil diperbarui');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $testimonial->delete();

        return redirect()->route('testimonials-management.index')->with('success', 'Testimoni berhasil dihapus');
    }
}
