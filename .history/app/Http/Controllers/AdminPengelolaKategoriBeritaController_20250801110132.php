<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;
use Illuminate\Support\Str;

class AdminPengelolaKategoriBeritaController extends Controller
{
    public function index()
    {
        $newsCategories = NewsCategory::withCount('news')
            ->whereNull('deleted_at')
            ->orderBy('sort_order', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('management.news-categories.index', compact('newsCategories'));
    }

    public function create()
    {
        return view('management.news-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:news_categories',
            'slug' => 'required|string|max:255|unique:news_categories',
            'description' => 'nullable|string',
            'color' => 'required|string|max:7',
            'icon' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        NewsCategory::create($data);

        return redirect()->route('news-categories-management.index')
            ->with('success', 'Kategori berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $newsCategory = NewsCategory::findOrFail($id);

        return view('management.news-categories.edit', compact('newsCategory'));
    }

    public function update(Request $request, $id)
    {
        $newsCategory = NewsCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:news_categories,name,' . $id,
            'slug' => 'required|string|max:255|unique:news_categories,slug,' . $id,
            'description' => 'nullable|string',
            'color' => 'required|string|max:7',
            'icon' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $newsCategory->update($data);

        return redirect()->route('news-categories-management.index')
            ->with('success', 'Kategori berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $newsCategory = NewsCategory::findOrFail($id);

        // Check if category has news
        if ($newsCategory->news()->count() > 0) {
            return redirect()->route('news-categories-management.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki berita');
        }

        $newsCategory->delete();

        return redirect()->route('news-categories-management.index')
            ->with('success', 'Kategori berita berhasil dihapus');
    }
}
