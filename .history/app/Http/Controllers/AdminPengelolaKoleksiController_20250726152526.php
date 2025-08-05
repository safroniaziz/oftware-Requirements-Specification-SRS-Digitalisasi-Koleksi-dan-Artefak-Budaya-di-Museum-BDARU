<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class AdminPengelolaKoleksiController extends Controller
{
    public function index()
    {
        $collections = Collection::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

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
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('collections/images', 'public');
        }

        Collection::create($data);

        return redirect()->route('collections-management.index')->with('success', 'Koleksi berhasil ditambahkan');
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
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($collection->image_path) {
                \Storage::disk('public')->delete($collection->image_path);
            }
            $data['image_path'] = $request->file('image')->store('collections/images', 'public');
        }

        $collection->update($data);

        return redirect()->route('collections-management.index')->with('success', 'Koleksi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $collection = Collection::findOrFail($id);

        // Delete associated image
        if ($collection->image_path) {
            \Storage::disk('public')->delete($collection->image_path);
        }

        $collection->delete();

        return redirect()->route('collections-management.index')->with('success', 'Koleksi berhasil dihapus');
    }
}
