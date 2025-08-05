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
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news_categories',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
        ]);

        $newsCategory = NewsCategory::create([
            'name' => $request->name,
            'slug' => $request->slug ?: Str::slug($request->name),
            'description' => $request->description,
            'color' => $request->color ?: '#0d6efd',
            'is_active' => $request->has('is_active'),
        ]);

        if (!$request->is_active) {
            $newsCategory->delete(); // Soft delete
        }

        return redirect()->route('news-categories-management.index')->with('success', 'Kategori berita berhasil dibuat!');
    }

    public function edit($id)
    {
        $newsCategory = NewsCategory::findOrFail($id);

        return view('management.news-categories.edit', compact('newsCategory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news_categories,slug,' . $id,
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
        ]);

        $newsCategory = NewsCategory::findOrFail($id);
        $newsCategory->update([
            'name' => $request->name,
            'slug' => $request->slug ?: Str::slug($request->name),
            'description' => $request->description,
            'color' => $request->color ?: '#0d6efd',
            'is_active' => $request->has('is_active'),
        ]);

        if (!$request->is_active) {
            $newsCategory->delete(); // Soft delete
        } else {
            $newsCategory->restore(); // Restore if soft deleted
        }

        return redirect()->route('news-categories-management.index')->with('success', 'Kategori berita berhasil diupdate!');
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
