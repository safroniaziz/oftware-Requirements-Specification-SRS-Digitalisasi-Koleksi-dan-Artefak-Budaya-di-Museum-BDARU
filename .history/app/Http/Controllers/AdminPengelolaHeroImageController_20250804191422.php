<?php

namespace App\Http\Controllers;

use App\Models\HeroImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminPengelolaHeroImageController extends Controller
{
    public function index()
    {
        $heroImages = HeroImage::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('management.hero-images.index', compact('heroImages'));
    }

    public function create()
    {
        return view('management.hero-images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt_text' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $data = $request->only([
            'title', 'subtitle', 'description', 'alt_text', 'is_active'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'hero-images/' . time() . '_' . $image->getClientOriginalName();

            // Create image manager
            $manager = new ImageManager(new Driver());

            // Resize and crop image to 1200x800 (3:2 aspect ratio) for hero slider - optimized for web
            $resizedImage = $manager->read($image)
                ->cover(1200, 800)
                ->toJpeg(85);

            Storage::disk('public')->put($filename, $resizedImage);
            $data['image_path'] = $filename;
        }

        $data['is_active'] = $request->has('is_active');

        $heroImage = HeroImage::create($data);

        // Log the creation
        Log::info('Hero image created', [
            'hero_image_id' => $heroImage->id,
            'hero_image_title' => $heroImage->title,
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
            'user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
            'user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => 'CREATE',
            'timestamp' => now()->toDateTimeString()
        ]);

        return redirect()->route('hero-images-management.index')
            ->with('success', 'Hero image berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $heroImage = HeroImage::findOrFail($id);
        return view('management.hero-images.edit', compact('heroImage'));
    }

    public function update(Request $request, $id)
    {
        $heroImage = HeroImage::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt_text' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $data = $request->only([
            'title', 'subtitle', 'description', 'alt_text', 'is_active'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($heroImage->image_path && Storage::disk('public')->exists($heroImage->image_path)) {
                Storage::disk('public')->delete($heroImage->image_path);
            }

            $image = $request->file('image');
            $filename = 'hero-images/' . time() . '_' . $image->getClientOriginalName();

            // Create image manager
            $manager = new ImageManager(new Driver());

            // Resize and crop image to 1200x800 (3:2 aspect ratio) for hero slider - optimized for web
            $resizedImage = $manager->read($image)
                ->cover(1200, 800)
                ->toJpeg(85);

            Storage::disk('public')->put($filename, $resizedImage);
            $data['image_path'] = $filename;
        }

        $data['is_active'] = $request->has('is_active');

        $heroImage->update($data);

        // Log the update
        Log::info('Hero image updated', [
            'hero_image_id' => $heroImage->id,
            'hero_image_title' => $heroImage->title,
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
            'user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
            'user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => 'UPDATE',
            'timestamp' => now()->toDateTimeString()
        ]);

        return redirect()->route('hero-images-management.index')
            ->with('success', 'Hero image berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $heroImage = HeroImage::findOrFail($id);

        // Log the deletion
        Log::info('Hero image soft deleted', [
            'hero_image_id' => $heroImage->id,
            'hero_image_title' => $heroImage->title,
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
            'user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
            'user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => 'DELETE',
            'timestamp' => now()->toDateTimeString()
        ]);

        // Soft delete (image remains in storage)
        $heroImage->delete();

        return redirect()->route('hero-images-management.index')
            ->with('success', 'Hero image berhasil dihapus!');
    }
}
