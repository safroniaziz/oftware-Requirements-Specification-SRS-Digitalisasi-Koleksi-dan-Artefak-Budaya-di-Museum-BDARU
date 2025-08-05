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
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('team/photos', 'public');
        }

        TeamMember::create($data);

        return redirect()->route('team-members-management.index')->with('success', 'Anggota tim berhasil ditambahkan');
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
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Handle photo upload
        if ($request->hasFile('photo')) {
            if ($teamMember->photo_path) {
                Storage::disk('public')->delete($teamMember->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('team/photos', 'public');
        }

        $teamMember->update($data);

        return redirect()->route('team-members-management.index')->with('success', 'Anggota tim berhasil diperbarui');
    }

    public function destroy($id)
    {
        $teamMember = TeamMember::findOrFail($id);

        // Delete associated photo
        if ($teamMember->photo_path) {
            Storage::disk('public')->delete($teamMember->photo_path);
        }

        $teamMember->delete();

        return redirect()->route('team-members-management.index')->with('success', 'Anggota tim berhasil dihapus');
    }
}
