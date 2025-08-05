<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::active()->ordered()->get();

        return Inertia::render('TeamMembers/Index', [
            'teamMembers' => $teamMembers
        ]);
    }

    public function create()
    {
        return Inertia::render('TeamMembers/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'email' => 'nullable|email|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
        ]);

        $data = $request->only([
            'name', 'position', 'description', 'email', 'linkedin', 'twitter'
        ]);

        // Set default values
        $data['is_active'] = true;

        TeamMember::create($data);

        return redirect()->route('team-members-management.index')
            ->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    public function edit(TeamMember $teamMember)
    {
        return Inertia::render('TeamMembers/Edit', [
            'teamMember' => $teamMember
        ]);
    }

    public function update(Request $request, TeamMember $teamMember)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'required|string',
            'email' => 'nullable|email|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only([
            'name', 'position', 'description', 'email', 'linkedin', 'twitter'
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($teamMember->photo) {
                Storage::disk('public')->delete($teamMember->photo);
            }

            $photoPath = $request->file('photo')->store('team-members', 'public');
            $data['photo'] = $photoPath;
        }

        $teamMember->update($data);

        return redirect()->route('team-members-management.index')
            ->with('success', 'Anggota tim berhasil diperbarui!');
    }

    public function destroy(TeamMember $teamMember)
    {
        // Delete photo if exists
        if ($teamMember->photo) {
            Storage::disk('public')->delete($teamMember->photo);
        }

        $teamMember->delete();

        return redirect()->route('team-members-management.index')
            ->with('success', 'Anggota tim berhasil dihapus!');
    }

    public function uploadPhoto(Request $request, TeamMember $teamMember)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Delete old photo if exists
        if ($teamMember->photo) {
            Storage::disk('public')->delete($teamMember->photo);
        }

        // Upload new photo
        $photoPath = $request->file('photo')->store('team-members', 'public');

        $teamMember->update(['photo' => $photoPath]);

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diupload!',
            'photo_url' => $teamMember->photo_url
        ]);
    }
}
