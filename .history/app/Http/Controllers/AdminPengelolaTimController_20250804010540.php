<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminPengelolaTimController extends Controller
{
    public function index()
    {
        $teamMembers = TeamMember::whereNull('deleted_at')
            ->orderBy('name', 'asc')
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
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $teamMember = TeamMember::create($data);

        // Log the creation
        Log::info('Team member created', [
            'team_member_id' => $teamMember->id,
            'team_member_name' => $teamMember->name,
            'team_member_position' => $teamMember->position,
            'is_active' => $teamMember->is_active,
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
            'user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
            'user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => 'CREATE',
            'timestamp' => now()->toDateTimeString()
        ]);

        if (!$request->is_active) {
            $teamMember->delete(); // Soft delete
        }

        return redirect()->route('team-members-management.index')
            ->with('success', 'Anggota tim berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $teamMember = TeamMember::findOrFail($id);

        return view('management.team.edit', compact('teamMember'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'is_active' => 'boolean',
        ]);

        $teamMember = TeamMember::findOrFail($id);
        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $teamMember->update($data);

        // Log the update
        Log::info('Team member updated', [
            'team_member_id' => $teamMember->id,
            'team_member_name' => $teamMember->name,
            'team_member_position' => $teamMember->position,
            'is_active' => $teamMember->is_active,
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
            'user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
            'user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => 'UPDATE',
            'timestamp' => now()->toDateTimeString()
        ]);

        if (!$request->is_active) {
            $teamMember->delete(); // Soft delete
        } else {
            $teamMember->restore(); // Restore if soft deleted
        }

        return redirect()->route('team-members-management.index')->with('success', 'Anggota tim berhasil diupdate!');
    }

    public function destroy($id)
    {
        $teamMember = TeamMember::findOrFail($id);

        // Soft delete the team member (photo remains in storage)
        // Log the deletion
        Log::info('Team member soft deleted', [
            'team_member_id' => $teamMember->id,
            'team_member_name' => $teamMember->name,
            'team_member_position' => $teamMember->position,
            'is_active' => $teamMember->is_active,
            'user_id' => Auth::user() ? Auth::user()->id : null,
            'user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
            'user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
            'user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => 'DELETE',
            'timestamp' => now()->toDateTimeString()
        ]);

        $teamMember->delete();

        return redirect()->route('team-members-management.index')->with('success', 'Anggota tim berhasil dihapus');
    }
}
