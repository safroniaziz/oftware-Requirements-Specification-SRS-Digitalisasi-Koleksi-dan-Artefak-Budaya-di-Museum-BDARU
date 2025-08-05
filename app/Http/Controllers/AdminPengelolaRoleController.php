<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class AdminPengelolaRoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('created_at', 'desc')->paginate(10);
        return view('management.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('management.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'guard_name' => 'required|string|max:255',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->route('roles-management.index')->with('success', 'Role berhasil dibuat!');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('management.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'guard_name' => 'required|string|max:255',
        ]);

        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect()->route('roles-management.index')->with('success', 'Role berhasil diupdate!');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles-management.index')->with('success', 'Role berhasil dihapus!');
    }

    public function permissions($roleId)
    {
        $role = Role::findOrFail($roleId);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions()->pluck('id')->toArray();
        return view('management.roles.permissions', compact('role', 'permissions', 'rolePermissions'));
    }
}
