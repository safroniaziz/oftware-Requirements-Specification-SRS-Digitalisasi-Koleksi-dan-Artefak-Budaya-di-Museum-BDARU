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
            ->paginate(12);

        return view('management.testimonials.index', compact('testimonials'));
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        // Soft delete the testimonial
        $testimonial->delete();

        return redirect()->route('testimonials-management.index')->with('success', 'Testimoni berhasil dihapus');
    }
}
