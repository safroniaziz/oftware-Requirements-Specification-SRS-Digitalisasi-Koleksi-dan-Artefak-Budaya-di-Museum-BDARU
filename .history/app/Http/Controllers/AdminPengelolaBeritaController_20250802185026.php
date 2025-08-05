<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPengelolaBeritaController extends Controller
{
    public function index()
    {
        $news = News::with('category')
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
            'category_id' => 'required|exists:news_categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published');

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('news/images', 'public');
        }

        // Set published_at if publishing
        if ($data['is_published']) {
            $data['published_at'] = now();
        }

        News::create($data);

        return redirect()->route('news-management.index')->with('success', 'Berita berhasil ditambahkan');
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
            'category_id' => 'required|exists:news_categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_published'] = $request->has('is_published');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Old image remains in storage (not deleted)
            $data['image_path'] = $request->file('image')->store('news/images', 'public');
        }

        // Set published_at if publishing
        if ($data['is_published'] && !$news->published_at) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('news-management.index')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // Soft delete the news (file remains in storage)
        $news->delete();

        return redirect()->route('news-management.index')->with('success', 'Berita berhasil dihapus');
    }
}
