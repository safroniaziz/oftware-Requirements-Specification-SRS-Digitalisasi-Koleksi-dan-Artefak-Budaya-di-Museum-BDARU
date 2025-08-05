<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\CollectionGalleryImage;
use App\Models\CollectionHistory;
use App\Models\CollectionCulturalPoint;
use App\Models\CollectionTechnicalSpec;
use App\Models\CollectionConservationRecord;
use App\Models\CollectionQrCode;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Services\QrCodeService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminPengelolaKoleksiController extends Controller
{
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    public function index()
    {
        $collections = Collection::with(['category', 'galleryImages', 'histories', 'ratings', 'qrCodes'])
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Calculate average rating and rating count for each collection
        $collections->getCollection()->transform(function ($collection) {
            $ratings = $collection->ratings;
            $collection->average_rating = $ratings->count() > 0 ? (float) $ratings->avg('rating') : 0.0;
            $collection->rating_count = $ratings->count();
            return $collection;
        });

        $categories = Category::all();

        return view('management.collections.index', compact('collections', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('management.collections.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'year_period' => 'nullable|string|max:255',
            'origin_location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'material' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'conservation_status' => 'nullable|string|max:255',
            'technical_overview' => 'nullable|string',
            'nilai_budaya' => 'nullable|string',
            'nilai_historis' => 'nullable|string',
            'nilai_edukatif' => 'nullable|string',
            'history_titles' => 'nullable|array',
            'history_years' => 'nullable|array',
            'history_descriptions' => 'nullable|array',
        ]);

        $data = $request->all();

        // Handle boolean fields
        $data['is_active'] = $request->has('is_active');
        $data['is_featured'] = $request->has('is_featured');

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image_path'] = $this->processImage($request->file('image'), 'collections/images');
        }

        // Create collection
        $collection = Collection::create($data);

        if ($collection) {
            // Generate QR code for new collection
            try {
                $this->qrCodeService->generateQrCode($collection);
            } catch (\Exception $e) {
                Log::error('Failed to generate QR code for collection ' . $collection->id . ': ' . $e->getMessage());
            }

            // Log the creation
            Log::info('Collection created', [
                'collection_id' => $collection->id,
                'collection_name' => $collection->name,
                'collection_slug' => $collection->slug,
                'category_id' => $collection->category_id,
                'user_id' => Auth::user() ? Auth::user()->id : null,
                'user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
                'user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
                'user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'action' => 'CREATE',
                'timestamp' => now()->toDateTimeString()
            ]);

            return redirect()->route('collections-management.index')
                ->with('success', 'Koleksi berhasil ditambahkan!');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $imagePath = $this->processGalleryImage($image, 'collections/gallery');
                CollectionGalleryImage::create([
                    'collection_id' => $collection->id,
                    'image_path' => $imagePath,
                    'order' => $index + 1
                ]);
            }
        }

        // Handle history items
        if ($request->has('history_titles') && is_array($request->history_titles)) {
            foreach ($request->history_titles as $index => $title) {
                if (!empty($title)) {
                    CollectionHistory::create([
                        'collection_id' => $collection->id,
                        'title' => $title,
                        'year' => $request->history_years[$index] ?? null,
                        'description' => $request->history_descriptions[$index] ?? '',
                        'order' => $index + 1,
                        'color' => $this->getHistoryColor($index)
                    ]);
                }
            }
        }

        // Create default technical specs
        $this->createDefaultTechnicalSpecs($collection->id);

        // Create default conservation records
        $this->createDefaultConservationRecords($collection->id);

        return redirect()->route('collections-management.index')->with('success', 'Koleksi berhasil ditambahkan');
    }

    private function getHistoryColor($index)
    {
        $colors = ['#dc3545', '#fd7e14', '#ffc107', '#198754', '#0d6efd', '#6f42c1'];
        return $colors[$index % count($colors)];
    }

    /**
     * Process uploaded image with automatic resizing and cropping
     */
    private function processImage($image, $path)
    {
        // Create image manager
        $manager = new ImageManager(new Driver());

        // Read the image
        $img = $manager->read($image);

        // Get original dimensions
        $width = $img->width();
        $height = $img->height();

        // Define target dimensions (16:9 aspect ratio for collections)
        $targetWidth = 800;
        $targetHeight = 600;

        // Calculate aspect ratios
        $originalRatio = $width / $height;
        $targetRatio = $targetWidth / $targetHeight;

        if ($originalRatio > $targetRatio) {
            // Image is wider than target ratio, crop width
            $newWidth = round($height * $targetRatio);
            $newHeight = $height;
            $cropX = round(($width - $newWidth) / 2);
            $cropY = 0;
        } else {
            // Image is taller than target ratio, crop height
            $newWidth = $width;
            $newHeight = round($width / $targetRatio);
            $cropX = 0;
            $cropY = round(($height - $newHeight) / 2);
        }

        // Crop and resize image
        $img->crop($newWidth, $newHeight, $cropX, $cropY)
            ->resize($targetWidth, $targetHeight);

        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.jpg';
        $fullPath = $path . '/' . $filename;

        // Save to storage with quality setting
        Storage::disk('public')->put($fullPath, $img->toJpeg(85));

        return $fullPath;
    }

    private function processGalleryImage($image, $path)
    {
        // Create image manager
        $manager = new ImageManager(new Driver());

        // Read the image
        $img = $manager->read($image);

        // Get original dimensions
        $width = $img->width();
        $height = $img->height();

        // Define target dimensions (smaller for gallery)
        $targetWidth = 300;
        $targetHeight = 200;

        // Calculate aspect ratios
        $originalRatio = $width / $height;
        $targetRatio = $targetWidth / $targetHeight;

        if ($originalRatio > $targetRatio) {
            // Image is wider than target ratio, crop width
            $newWidth = round($height * $targetRatio);
            $newHeight = $height;
            $cropX = round(($width - $newWidth) / 2);
            $cropY = 0;
        } else {
            // Image is taller than target ratio, crop height
            $newWidth = $width;
            $newHeight = round($width / $targetRatio);
            $cropX = 0;
            $cropY = round(($height - $newHeight) / 2);
        }

        // Crop and resize image
        $img->crop($newWidth, $newHeight, $cropX, $cropY)
            ->resize($targetWidth, $targetHeight);

        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.jpg';
        $fullPath = $path . '/' . $filename;

        // Save to storage with quality setting
        Storage::disk('public')->put($fullPath, $img->toJpeg(85));

        return $fullPath;
    }

    private function createDefaultTechnicalSpecs($collectionId)
    {
        $collection = Collection::find($collectionId);

        $technicalSpecs = [
            [
                'spec_name' => 'Material',
                'spec_value' => $collection->material ?: 'Kayu, Logam, Kain',
                'icon' => 'fas fa-cube',
                'order' => 1
            ],
            [
                'spec_name' => 'Dimensi',
                'spec_value' => $collection->dimensions ?: '50cm x 30cm x 20cm',
                'icon' => 'fas fa-ruler-combined',
                'order' => 2
            ],
            [
                'spec_name' => 'Tahun Pembuatan',
                'spec_value' => $collection->year_period ?: '1920-1930',
                'icon' => 'fas fa-calendar',
                'order' => 3
            ],
            [
                'spec_name' => 'Status Konservasi',
                'spec_value' => $collection->conservation_status ?: 'Baik',
                'icon' => 'fas fa-shield-alt',
                'order' => 4
            ],
            [
                'spec_name' => 'Kategori',
                'spec_value' => $collection->category ? $collection->category->name : 'Uncategorized',
                'icon' => 'fas fa-tag',
                'order' => 5
            ],
            [
                'spec_name' => 'Rating',
                'spec_value' => $collection->rating ? number_format($collection->rating, 2) . '/5.00' : '4.50/5.00',
                'icon' => 'fas fa-star',
                'order' => 6
            ]
        ];

        foreach ($technicalSpecs as $spec) {
            CollectionTechnicalSpec::create([
                'collection_id' => $collectionId,
                'spec_name' => $spec['spec_name'],
                'spec_value' => $spec['spec_value'],
                'icon' => $spec['icon'],
                'order' => $spec['order']
            ]);
        }
    }

    private function createDefaultConservationRecords($collectionId)
    {
        $conservationRecords = [
            [
                'record_date' => now()->subMonths(6),
                'action' => 'Pemeriksaan Rutin',
                'description' => 'Koleksi ini telah melalui proses konservasi dan digitalisasi yang ketat untuk memastikan kelestariannya.',
                'status' => 'Baik',
                'color' => '#10b981',
                'order' => 1
            ],
            [
                'record_date' => now()->subMonths(3),
                'action' => 'Digitalisasi',
                'description' => 'Menggunakan teknologi fotografi resolusi tinggi dan pemindaian 3D untuk dokumentasi yang akurat.',
                'status' => 'Selesai',
                'color' => '#0ea5e9',
                'order' => 2
            ],
            [
                'record_date' => now()->subMonth(),
                'action' => 'Penyimpanan',
                'description' => 'Disimpan dalam kondisi terkontrol dengan suhu dan kelembaban yang optimal.',
                'status' => 'Aktif',
                'color' => '#8b5cf6',
                'order' => 3
            ]
        ];

        foreach ($conservationRecords as $record) {
            CollectionConservationRecord::create([
                'collection_id' => $collectionId,
                'record_date' => $record['record_date'],
                'action' => $record['action'],
                'description' => $record['description'],
                'status' => $record['status'],
                'color' => $record['color'],
                'order' => $record['order']
            ]);
        }
    }

    public function edit($id)
    {
        $collection = Collection::with(['histories', 'galleryImages'])->findOrFail($id);
        $categories = Category::all();

        return view('management.collections.edit', compact('collection', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $collection = Collection::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'year_period' => 'nullable|string|max:255',
            'origin_location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'material' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'conservation_status' => 'nullable|string|max:255',
            'technical_overview' => 'nullable|string',
            'nilai_budaya' => 'nullable|string',
            'nilai_historis' => 'nullable|string',
            'nilai_edukatif' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'history_titles' => 'nullable|array',
            'history_years' => 'nullable|array',
            'history_descriptions' => 'nullable|array',
        ]);

        $data = $request->all();

        // Handle boolean fields
        $data['is_active'] = $request->has('is_active');
        $data['is_featured'] = $request->has('is_featured');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Old image remains in storage (not deleted)
            $data['image_path'] = $this->processImage($request->file('image'), 'collections/images');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            // Process new gallery images
            foreach ($request->file('gallery_images') as $image) {
                $galleryPath = $this->processGalleryImage($image, 'collections/gallery');
                $collection->galleryImages()->create([
                    'image_path' => $galleryPath,
                    'caption' => null,
                    'order' => $collection->galleryImages()->count() + 1,
                    'is_featured' => false
                ]);
            }
        }

        // Handle gallery images deletion
        if ($request->has('delete_gallery_images') && is_array($request->delete_gallery_images)) {
            foreach ($request->delete_gallery_images as $galleryId) {
                $galleryImage = $collection->galleryImages()->find($galleryId);
                if ($galleryImage) {
                    // Soft delete from database (file remains in storage)
                    $galleryImage->delete();
                }
            }
        }

        if ($collection->update($data)) {
            // Log the update
            Log::info('Collection updated', [
                'collection_id' => $collection->id,
                'collection_name' => $collection->name,
                'collection_slug' => $collection->slug,
                'category_id' => $collection->category_id,
                'user_id' => Auth::user() ? Auth::user()->id : null,
                'user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
                'user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
                'user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'action' => 'UPDATE',
                'timestamp' => now()->toDateTimeString()
            ]);

            return redirect()->route('collections-management.index')
                ->with('success', 'Koleksi berhasil diperbarui!');
        }

        // Handle timeline sejarah
        if ($request->has('history_titles') && is_array($request->history_titles)) {
            // Delete existing histories
            $collection->histories()->delete();

            // Create new histories
            foreach ($request->history_titles as $index => $title) {
                if (!empty($title)) {
                    $collection->histories()->create([
                        'title' => $title,
                        'year' => $request->history_years[$index] ?? null,
                        'description' => $request->history_descriptions[$index] ?? '',
                        'color' => $this->getHistoryColor($index),
                        'order' => $index + 1
                    ]);
                }
            }
        }

        return redirect()->route('collections-management.index')->with('success', 'Koleksi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);

        // Soft delete related data (this will cascade delete due to foreign key constraints)
        $collection->galleryImages()->delete();
        $collection->histories()->delete();
        $collection->ratings()->delete();
        $collection->technicalSpecs()->delete();
        $collection->conservationRecords()->delete();

        // Soft delete the collection (files remain in storage)
        // Log the deletion
        Log::info('Collection soft deleted', [
            'collection_id' => $collection->id,
            'collection_name' => $collection->name,
            'user' => Auth::user() ? Auth::user()->name : 'Unknown',
            'ip' => request()->ip()
        ]);

        $collection->delete();

        return redirect()->route('collections-management.index')->with('success', 'Koleksi berhasil dihapus');
    }

    /**
     * Generate QR code for collection
     */
    public function generateQrCode($id)
    {
        $collection = Collection::findOrFail($id);

        try {
            $qrCode = $this->qrCodeService->generateQrCode($collection);

            return response()->json([
                'success' => true,
                'message' => 'QR Code berhasil dibuat!',
                'qr_code' => $qrCode->qr_code,
                'qr_image_url' => asset('storage/' . $qrCode->qr_image_path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat QR Code: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reset QR code for collection
     */
    public function resetQrCode($id)
    {
        $collection = Collection::findOrFail($id);

        try {
            $qrCode = $this->qrCodeService->resetQrCode($collection);

            return response()->json([
                'success' => true,
                'message' => 'QR Code baru berhasil dibuat!',
                'qr_code' => $qrCode->qr_code,
                'qr_image_url' => asset('storage/' . $qrCode->qr_image_path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal reset QR Code: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get QR codes for collection
     */
    public function getQrCodes($id)
    {
        $collection = Collection::with('qrCodes')->findOrFail($id);

        return response()->json([
            'success' => true,
            'qr_codes' => $collection->qrCodes->map(function($qrCode) use ($collection) {
                return [
                    'id' => $qrCode->id,
                    'collection_id' => $collection->id,
                    'qr_code' => $qrCode->qr_code,
                    'qr_image_url' => asset('storage/' . $qrCode->qr_image_path),
                    'is_active' => $qrCode->is_active,
                    'scan_count' => $qrCode->scan_count,
                    'last_scanned_at' => $qrCode->last_scanned_at,
                    'created_at' => $qrCode->created_at->format('d/m/Y H:i'),
                ];
            })
        ]);
    }

    /**
     * Get QR code preview
     */
    public function getQrCodePreview($id)
    {
        $collection = Collection::with('latestQrCode')->findOrFail($id);

        if ($collection->latestQrCode) {
            return response()->json([
                'success' => true,
                'qr_image_url' => asset('storage/' . $collection->latestQrCode->qr_image_path),
                'qr_code' => $collection->latestQrCode->qr_code
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'QR Code tidak ditemukan'
        ]);
    }

    /**
     * Download QR code
     */
    public function downloadQrCode($id, $qrCode)
    {
        $collection = Collection::findOrFail($id);
        $qrCodeModel = CollectionQrCode::where('collection_id', $id)
            ->where('qr_code', $qrCode)
            ->firstOrFail();

        if (!$qrCodeModel->qr_image_path || !Storage::disk('public')->exists($qrCodeModel->qr_image_path)) {
            abort(404, 'QR Code image tidak ditemukan');
        }

        $filename = "QR-{$collection->name}-{$qrCodeModel->qr_code}.png";
        $filePath = Storage::disk('public')->path($qrCodeModel->qr_image_path);

        return response()->download($filePath, $filename, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ]);
    }
}
