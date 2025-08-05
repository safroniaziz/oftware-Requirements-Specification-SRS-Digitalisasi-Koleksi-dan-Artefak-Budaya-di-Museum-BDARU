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
        ]);

        $data = $request->only([
            'name', 'position', 'description', 'email', 'linkedin', 'twitter'
        ]);

        $teamMember->update($data);

        return redirect()->route('team-members-management.index')
            ->with('success', 'Anggota tim berhasil diperbarui!');
    }

    public function destroy(TeamMember $teamMember)
    {
        $teamMember->delete();

        return redirect()->route('team-members-management.index')
            ->with('success', 'Anggota tim berhasil dihapus!');
    }


}
