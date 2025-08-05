<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminPengelolaUserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->orderBy('created_at', 'desc')->paginate(10);
        return view('management.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('management.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'nullable|string|max:255|unique:users',
            'profession' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
            'is_active' => 'boolean',
            'email_verified_at' => 'boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'profession' => $request->profession,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'email_verified_at' => $request->email_verified_at ? now() : null,
        ]);

        if ($request->has('roles')) {
            $user->assignRole($request->roles);
        }

        if (!$request->is_active) {
            $user->delete(); // Soft delete
        }

        return redirect()->route('users-management.index')->with('success', 'User berhasil dibuat!');
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('management.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'username' => 'nullable|string|max:255|unique:users,username,' . $id,
            'profession' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
            'is_active' => 'boolean',
            'email_verified_at' => 'boolean',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'profession' => $request->profession,
            'phone' => $request->phone,
            'address' => $request->address,
            'email_verified_at' => $request->email_verified_at ? now() : null,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $user->syncRoles($request->roles);

        if (!$request->is_active) {
            $user->delete(); // Soft delete
        } else {
            $user->restore(); // Restore if soft deleted
        }

        return redirect()->route('users-management.index')->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Soft delete

        return redirect()->route('users-management.index')->with('success', 'User berhasil dihapus!');
    }
}
