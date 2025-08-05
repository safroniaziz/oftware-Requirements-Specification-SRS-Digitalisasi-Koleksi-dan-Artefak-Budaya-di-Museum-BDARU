<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class AdminPengelolaPermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('created_at', 'desc')->paginate(10);
        return view('management.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('management.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions',
            'display_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'guard_name' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
            'guard_name' => $request->guard_name,
        ]);

        if (!$request->is_active) {
            $permission->delete(); // Soft delete
        }

        return redirect()->route('permissions-management.index')->with('success', 'Permission berhasil dibuat!');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('management.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
            'display_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'guard_name' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $permission->update([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
            'guard_name' => $request->guard_name,
        ]);

        if (!$request->is_active) {
            $permission->delete(); // Soft delete
        } else {
            $permission->restore(); // Restore if soft deleted
        }

        return redirect()->route('permissions-management.index')->with('success', 'Permission berhasil diupdate!');
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete(); // Soft delete

        return redirect()->route('permissions-management.index')->with('success', 'Permission berhasil dihapus!');
    }
}
