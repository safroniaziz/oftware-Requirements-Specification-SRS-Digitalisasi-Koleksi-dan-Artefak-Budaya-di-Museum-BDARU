<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
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
            'profession' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
            'is_active' => 'boolean',
            'email_verified_at' => 'boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'profession' => $request->profession,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'email_verified_at' => $request->email_verified_at ? now() : null,
        ]);

        // Log the creation
        Log::info('User created', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_phone' => $user->phone,
            'email_verified' => $user->email_verified_at ? true : false,
            'created_by_user_id' => Auth::user() ? Auth::user()->id : null,
            'created_by_user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
            'created_by_user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
            'created_by_user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => 'CREATE',
            'timestamp' => now()->toDateTimeString()
        ]);

        if ($request->has('roles')) {
            $user->assignRole($request->roles);
        }

        if (!$request->is_active) {
            $user->delete(); // Soft delete
        }

        return redirect()->route('users-management.index')
            ->with('success', 'User berhasil ditambahkan!');
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
            'profession' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
            'is_active' => 'boolean',
            'email_verified_at' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'profession' => $request->profession,
            'phone' => $request->phone,
            'email_verified_at' => $request->email_verified_at ? now() : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Log the update
        Log::info('User updated', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_phone' => $user->phone,
            'email_verified' => $user->email_verified_at ? true : false,
            'updated_by_user_id' => Auth::user() ? Auth::user()->id : null,
            'updated_by_user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
            'updated_by_user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
            'updated_by_user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => 'UPDATE',
            'timestamp' => now()->toDateTimeString()
        ]);

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
        // Log the deletion
        Log::info('User deleted', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'user_phone' => $user->phone,
            'email_verified' => $user->email_verified_at ? true : false,
            'deleted_by_user_id' => Auth::user() ? Auth::user()->id : null,
            'deleted_by_user_name' => Auth::user() ? Auth::user()->name : 'Unknown',
            'deleted_by_user_email' => Auth::user() ? Auth::user()->email : 'Unknown',
            'deleted_by_user_roles' => Auth::user() ? Auth::user()->roles->pluck('name')->toArray() : [],
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'action' => 'DELETE',
            'timestamp' => now()->toDateTimeString()
        ]);

        $user->delete();

        return redirect()->route('users-management.index')->with('success', 'User berhasil dihapus!');
    }
}
