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
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminPengelolaKoleksiController extends Controller
{
    public function index()
    {
        $collections = Collection::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $categories = Category::all();

        // Debug: Check if collections have image_path
        foreach ($collections as $collection) {
            if ($collection->image_path) {
                \Log::info("Collection {$collection->id} has image_path: {$collection->image_path}");
            }
        }

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
        $collection = Collection::findOrFail($id);
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
        ]);

        $data = $request->all();

        // Handle boolean fields
        $data['is_active'] = $request->has('is_active');
        $data['is_featured'] = $request->has('is_featured');

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($collection->image_path) {
                Storage::disk('public')->delete($collection->image_path);
            }
            $data['image_path'] = $this->processImage($request->file('image'), 'collections/images');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            // Delete old gallery images
            if ($collection->gallery_images) {
                foreach ($collection->gallery_images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryPaths[] = $this->processGalleryImage($image, 'collections/gallery');
            }
            $data['gallery_images'] = $galleryPaths;
        }

        $collection->update($data);

        return redirect()->route('collections-management.index')->with('success', 'Koleksi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);

        // Delete associated image
        if ($collection->image_path) {
            Storage::disk('public')->delete($collection->image_path);
        }

        $collection->delete();

        return redirect()->route('collections-management.index')->with('success', 'Koleksi berhasil dihapus');
    }
}
