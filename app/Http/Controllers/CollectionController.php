<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Collection;
use App\Models\Category;
use App\Models\Visit;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $query = Collection::with('category')->where('is_active', true);

        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search functionality
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $collections = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();

        return Inertia::render('Collections/Index', [
            'collections' => $collections,
            'categories' => $categories,
            'filters' => $request->only(['category', 'search'])
        ]);
    }

    public function show($slug)
    {
        $collection = Collection::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Track visit
        Visit::create([
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'page_visited' => 'collection_detail',
            'collection_id' => $collection->id,
            'device_type' => $this->getDeviceType()
        ]);

        // Increment view count
        $collection->incrementViewCount();

        return Inertia::render('Collections/Show', [
            'collection' => $collection
        ]);
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
