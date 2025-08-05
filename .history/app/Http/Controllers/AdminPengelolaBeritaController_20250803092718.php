<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AdminPengelolaBeritaController extends Controller
{
    public function index()
    {
        $news = News::with('newsCategory')
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = NewsCategory::all();

        return view('management.news.index', compact('news', 'categories'));
    }

    public function create()
    {
        $categories = NewsCategory::all();
        return view('management.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'news_category_id' => 'required|exists:news_categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published');

        // Handle image upload
        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('news/images', 'public');
        }

        // Set published_at if publishing
        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        $news = News::create($data);

        // Log the creation
        Log::info('News created', [
            'news_id' => $news->id,
            'news_title' => $news->title,
            'news_slug' => $news->slug,
            'news_category_id' => $news->news_category_id,
            'is_published' => $news->is_published,
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
            'user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
            'user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => 'CREATE',
            'timestamp' => now()->toDateTimeString()
        ]);

        return redirect()->route('news-management.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = NewsCategory::all();

        return view('management.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'news_category_id' => 'required|exists:news_categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published');

        // Handle image upload
        if ($request->hasFile('image_path')) {
            // Old image remains in storage (not deleted)
            $data['image_path'] = $request->file('image_path')->store('news/images', 'public');
        }

        // Set published_at if publishing
        if ($data['is_published'] && !$news->published_at) {
            $data['published_at'] = now();
        }

        $news->update($data);

        // Log the update
        Log::info('News updated', [
            'news_id' => $news->id,
            'news_title' => $news->title,
            'news_slug' => $news->slug,
            'news_category_id' => $news->news_category_id,
            'is_published' => $news->is_published,
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
            'user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
            'user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => 'UPDATE',
            'timestamp' => now()->toDateTimeString()
        ]);

        return redirect()->route('news-management.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // Log the deletion
        Log::info('News soft deleted', [
            'news_id' => $news->id,
            'news_title' => $news->title,
            'news_slug' => $news->slug,
            'category_id' => $news->category_id,
            'is_published' => $news->is_published,
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
            'user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
            'user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => 'DELETE',
            'timestamp' => now()->toDateTimeString()
        ]);

        $news->delete();

        return redirect()->route('news-management.index')->with('success', 'Berita berhasil dihapus');
    }
}
