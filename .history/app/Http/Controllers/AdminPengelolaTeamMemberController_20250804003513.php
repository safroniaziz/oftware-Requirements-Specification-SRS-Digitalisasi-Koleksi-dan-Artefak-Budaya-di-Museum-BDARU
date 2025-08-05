<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AdminPengelolaTeamMemberController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::orderBy('name', 'asc')->get();
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

        $data = $request->only([
            'name', 'position', 'description', 'email', 'linkedin', 'twitter'
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('team-members', 'public');
            $data['photo'] = $photoPath;
        }

        // Set default values
        $data['is_active'] = $request->has('is_active');

        $teamMember = TeamMember::create($data);

        // Log the action
        Log::info('Team member created', [
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'user_email' => Auth::user()->email,
            'ip_address' => $request->ip(),
            'action' => 'CREATE',
            'entity_type' => 'TeamMember',
            'entity_id' => $teamMember->id,
            'entity_name' => $teamMember->name,
            'details' => [
                'name' => $teamMember->name,
                'position' => $teamMember->position,
                'email' => $teamMember->email,
                'is_active' => $teamMember->is_active,
            ]
        ]);

        return redirect()->route('team-members-management.index')
            ->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    public function edit(TeamMember $teamMember)
    {
        return view('management.team.edit', compact('teamMember'));
    }

    public function update(Request $request, TeamMember $teamMember)
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

        // Set default values
        $data['is_active'] = $request->has('is_active');

        $oldData = $teamMember->toArray();
        $teamMember->update($data);

        // Log the action
        Log::info('Team member updated', [
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'user_email' => Auth::user()->email,
            'ip_address' => $request->ip(),
            'action' => 'UPDATE',
            'entity_type' => 'TeamMember',
            'entity_id' => $teamMember->id,
            'entity_name' => $teamMember->name,
            'old_data' => [
                'name' => $oldData['name'],
                'position' => $oldData['position'],
                'email' => $oldData['email'],
                'is_active' => $oldData['is_active'],
            ],
            'new_data' => [
                'name' => $teamMember->name,
                'position' => $teamMember->position,
                'email' => $teamMember->email,
                'is_active' => $teamMember->is_active,
            ]
        ]);

        return redirect()->route('team-members-management.index')
            ->with('success', 'Anggota tim berhasil diperbarui!');
    }

    public function destroy(TeamMember $teamMember)
    {
        $memberName = $teamMember->name;
        $memberId = $teamMember->id;

        // Delete photo if exists
        if ($teamMember->photo) {
            Storage::disk('public')->delete($teamMember->photo);
        }

        $teamMember->delete();

        // Log the action
        Log::info('Team member deleted', [
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'user_email' => Auth::user()->email,
            'ip_address' => request()->ip(),
            'action' => 'DELETE',
            'entity_type' => 'TeamMember',
            'entity_id' => $memberId,
            'entity_name' => $memberName,
            'details' => [
                'name' => $memberName,
                'position' => $teamMember->position,
                'email' => $teamMember->email,
            ]
        ]);

        return redirect()->route('team-members-management.index')
            ->with('success', 'Anggota tim berhasil dihapus!');
    }
}
