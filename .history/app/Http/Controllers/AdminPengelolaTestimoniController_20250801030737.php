<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;

class AdminPengelolaTestimoniController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('management.testimonials.index', compact('testimonials'));
    }

    public function approve($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_approved' => true]);

        return redirect()->route('testimonials-management.index')->with('success', 'Testimoni berhasil disetujui');
    }

    public function unapprove($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_approved' => false]);

        return redirect()->route('testimonials-management.index')->with('success', 'Persetujuan testimoni berhasil dibatalkan');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Soft delete the testimonial
        $testimonial->delete();

        return redirect()->route('testimonials-management.index')->with('success', 'Testimoni berhasil dihapus');
    }
}
