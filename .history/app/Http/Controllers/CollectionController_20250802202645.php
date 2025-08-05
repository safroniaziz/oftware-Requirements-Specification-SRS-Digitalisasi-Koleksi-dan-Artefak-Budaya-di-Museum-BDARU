<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use App\Models\Collection;
use App\Models\Category;
use App\Models\Visit;
use App\Models\MuseumSetting;
use App\Services\QrCodeService;

class CollectionController extends Controller
{
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Collection::with(['category'])->whereNull('deleted_at');

        // Filter by category
        if ($request->has('category') && $request->category !== 'all') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('year_period', 'like', "%{$search}%")
                  ->orWhere('origin_location', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'views':
                $query->orderBy('view_count', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $collections = $query->paginate(9);

        // Get categories for filter
        $categories = Category::withCount('collections')->get();

        // Get museum settings
        $museumSettings = MuseumSetting::getSettings();

        return Inertia::render('Collections', [
            'collections' => $collections->through(function ($collection) {
                $collection->image_url = $collection->image_url;
                return $collection;
            }),
            'categories' => $categories,
            'filters' => [
                'category' => $request->get('category', 'all'),
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
    public function show($slug)
    {
        $collection = Collection::with(['category', 'galleryImages', 'histories', 'ratings.user', 'qrCodes'])
            ->where('slug', $slug)
            ->whereNull('deleted_at')
            ->firstOrFail();

        // Check if accessed via QR code
        $qrCode = request()->query('qr');
        if ($qrCode) {
            $this->qrCodeService->trackScan($qrCode);
        }

        // Increment view count
        $collection->increment('view_count');

        // Load related collections
        $relatedCollections = Collection::with(['category'])
            ->where('category_id', $collection->category_id)
            ->where('id', '!=', $collection->id)
            ->whereNull('deleted_at')
            ->limit(6)
            ->get();

        // Get museum settings
        $museumSettings = MuseumSetting::getSettings();

        // Load collection with relationships
        $loadedCollection = $collection->load(['category', 'galleryImages', 'ratings' => function($query) {
            $query->orderBy('created_at', 'desc')->limit(10);
        }])->append('image_url');

        // Calculate average rating and rating count
        $ratings = $loadedCollection->ratings;
        $loadedCollection->average_rating = $ratings->count() > 0 ? (float) $ratings->avg('rating') : 0.0;
        $loadedCollection->rating_count = $ratings->count();

        // Add image_url to gallery images
        $loadedCollection->galleryImages->each(function($galleryImage) {
            $galleryImage->image_url = $galleryImage->image_url;
        });

        // Get latest QR code for display
        $latestQrCode = $collection->latestQrCode;
        $qrCodeData = null;
        if ($latestQrCode) {
            $qrCodeData = [
                'qr_code' => $latestQrCode->qr_code,
                'qr_image_url' => asset('storage/' . $latestQrCode->qr_image_path),
                'scan_count' => $latestQrCode->scan_count,
                'last_scanned_at' => $latestQrCode->last_scanned_at,
            ];
        }

        return Inertia::render('CollectionDetail', [
            'collection' => $loadedCollection,
            'relatedCollections' => $relatedCollections->map(function ($collection) {
                $collection->image_url = $collection->image_url;
                return $collection;
            }),
            'qrCode' => $qrCodeData,
            'museumSettings' => $museumSettings,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'auth' => [
                'user' => Auth::user()
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return Inertia::render('Collections/Create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'year_period' => 'required|string|max:50',
            'origin_location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('collections', 'public');
            $validated['image_path'] = $imagePath;
        }

        $collection = Collection::create($validated);

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Koleksi berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection)
    {
        $categories = Category::all();

        return Inertia::render('Collections/Edit', [
            'collection' => $collection->load(['category']),
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collection $collection)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'year_period' => 'required|string|max:50',
            'origin_location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
        ]);

                // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($collection->image_path) {
                Storage::disk('public')->delete($collection->image_path);
            }

            $imagePath = $request->file('image')->store('collections', 'public');
            $validated['image_path'] = $imagePath;
        }

        $collection->update($validated);

        return redirect()->route('collections.show', $collection)
            ->with('success', 'Koleksi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        // Delete image
        if ($collection->image_path) {
            Storage::disk('public')->delete($collection->image_path);
        }

        $collection->delete();

        return redirect()->route('collections.index')
            ->with('success', 'Koleksi berhasil dihapus!');
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
