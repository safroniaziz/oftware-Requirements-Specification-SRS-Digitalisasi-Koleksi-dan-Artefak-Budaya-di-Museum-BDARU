<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPengelolaTimController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('management.team.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('management.team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('team-photos', 'public');
            $data['photo'] = $photoPath;
        }

        $teamMember = TeamMember::create($data);

        if (!$request->is_active) {
            $teamMember->delete(); // Soft delete
        }

        return redirect()->route('team-members-management.index')->with('success', 'Anggota tim berhasil dibuat!');
    }

    public function edit($id)
    {
        $teamMember = TeamMember::findOrFail($id);

        return view('management.team.edit', compact('teamMember'));
    }

    public function update(Request $request, $id)
    {
        $teamMember = TeamMember::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Old photo remains in storage (not deleted)
            $data['photo_path'] = $request->file('photo')->store('team/photos', 'public');
        }

        $teamMember->update($data);

        return redirect()->route('team-members-management.index')->with('success', 'Anggota tim berhasil diperbarui');
    }

    public function destroy($id)
    {
        $teamMember = TeamMember::findOrFail($id);

        // Soft delete the team member (photo remains in storage)
        $teamMember->delete();

        return redirect()->route('team-members-management.index')->with('success', 'Anggota tim berhasil dihapus');
    }
}
