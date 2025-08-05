<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Auth;

class AdminPengelolaKategoriController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('collections')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $newsCategories = NewsCategory::withCount('news')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('management.categories.index', compact('categories', 'newsCategories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name', 'asc')
            ->get();

        return view('management.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => $request->slug ?: \Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        if (!$request->is_active) {
            $category->delete(); // Soft delete
        }

        return redirect()->route('categories-management.index')->with('success', 'Kategori berhasil dibuat!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('is_active', true)
            ->where('id', '!=', $id) // Exclude current category from parent options
            ->orderBy('name', 'asc')
            ->get();

        return view('management.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('categories-management.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Check if category has collections
        if ($category->collections()->count() > 0) {
            return redirect()->route('categories-management.index')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki koleksi');
        }

        $category->delete();

        return redirect()->route('categories-management.index')->with('success', 'Kategori berhasil dihapus');
    }

    // News Categories methods
    public function createNewsCategory()
    {
        return view('management.categories.create-news');
    }

    public function storeNewsCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:news_categories',
            'description' => 'nullable|string',
        ]);

        NewsCategory::create($request->all());

        return redirect()->route('categories-management.index')->with('success', 'Kategori berita berhasil ditambahkan');
    }

    public function editNewsCategory($id)
    {
        $newsCategory = NewsCategory::findOrFail($id);

        return view('management.categories.edit-news', compact('newsCategory'));
    }

    public function updateNewsCategory(Request $request, $id)
    {
        $newsCategory = NewsCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:news_categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $newsCategory->update($request->all());

        return redirect()->route('categories-management.index')->with('success', 'Kategori berita berhasil diperbarui');
    }

    public function destroyNewsCategory($id)
    {
        $newsCategory = NewsCategory::findOrFail($id);

        // Check if category has news
        if ($newsCategory->news()->count() > 0) {
            return redirect()->route('categories-management.index')->with('error', 'Kategori berita tidak dapat dihapus karena masih memiliki berita');
        }

        $newsCategory->delete();

        return redirect()->route('categories-management.index')->with('success', 'Kategori berita berhasil dihapus');
    }
}
