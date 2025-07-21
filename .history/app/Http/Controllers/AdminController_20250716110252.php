<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Category;
use App\Models\News;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'totalCollections' => Collection::count(),
            'totalCategories' => Category::count(),
            'totalNews' => News::count(),
            'totalUsers' => User::count(),
            'totalVisits' => Visit::count(),
            'recentVisits' => Visit::latest()->take(10)->get(),
            'featuredCollections' => Collection::where('is_featured', true)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function analytics()
    {
        $visits = Visit::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(30)
            ->get();

        $collectionsByCategory = Category::withCount('collections')->get();

        return view('admin.analytics', compact('visits', 'collectionsByCategory'));
    }

    // Collections Management
    public function collections()
    {
        $collections = Collection::with('category')->paginate(15);
        $categories = Category::all();

        return view('admin.collections.index', compact('collections', 'categories'));
    }

    public function createCollection()
    {
        $categories = Category::all();
        return view('admin.collections.create', compact('categories'));
    }

    public function storeCollection(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'year_period' => 'nullable|string|max:255',
            'origin_location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mov|max:10240',
            'pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->all();

        // Handle file uploads
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('collections/images', 'public');
        }

        if ($request->hasFile('video')) {
            $data['video_path'] = $request->file('video')->store('collections/videos', 'public');
        }

        if ($request->hasFile('pdf')) {
            $data['pdf_path'] = $request->file('pdf')->store('collections/pdfs', 'public');
        }

        $collection = Collection::create($data);

        // Generate QR Code
        $collection->generateQrCode();

        return redirect()->route('admin.collections.index')->with('success', 'Koleksi berhasil ditambahkan');
    }

    public function editCollection($id)
    {
        $collection = Collection::findOrFail($id);
        $categories = Category::all();

        return view('admin.collections.edit', compact('collection', 'categories'));
    }

    public function updateCollection(Request $request, $id)
    {
        $collection = Collection::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'year_period' => 'nullable|string|max:255',
            'origin_location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,avi,mov|max:10240',
            'pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->all();

        // Handle file uploads
        if ($request->hasFile('image')) {
            if ($collection->image_path) {
                Storage::disk('public')->delete($collection->image_path);
            }
            $data['image_path'] = $request->file('image')->store('collections/images', 'public');
        }

        if ($request->hasFile('video')) {
            if ($collection->video_path) {
                Storage::disk('public')->delete($collection->video_path);
            }
            $data['video_path'] = $request->file('video')->store('collections/videos', 'public');
        }

        if ($request->hasFile('pdf')) {
            if ($collection->pdf_path) {
                Storage::disk('public')->delete($collection->pdf_path);
            }
            $data['pdf_path'] = $request->file('pdf')->store('collections/pdfs', 'public');
        }

        $collection->update($data);

        return redirect()->route('admin.collections.index')->with('success', 'Koleksi berhasil diperbarui');
    }

    public function destroyCollection($id)
    {
        $collection = Collection::findOrFail($id);

        // Delete associated files
        if ($collection->image_path) {
            Storage::disk('public')->delete($collection->image_path);
        }
        if ($collection->video_path) {
            Storage::disk('public')->delete($collection->video_path);
        }
        if ($collection->pdf_path) {
            Storage::disk('public')->delete($collection->pdf_path);
        }
        if ($collection->qr_code_path) {
            Storage::disk('public')->delete($collection->qr_code_path);
        }

        $collection->delete();

        return redirect()->route('admin.collections.index')->with('success', 'Koleksi berhasil dihapus');
    }
}
