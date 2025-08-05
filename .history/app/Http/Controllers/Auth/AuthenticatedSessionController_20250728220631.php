<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();

            // Check user role and redirect accordingly
            $user = $request->user();

            // Debug logging
            \Log::info('Login successful for user: ' . $user->email . ' with role: ' . $user->roles->first()->name ?? 'no role');

            if ($user->hasRole('admin')) {
                // Admin redirects to admin dashboard
                \Log::info('Redirecting admin to dashboard');
                return redirect()->to('/dashboard');
            } elseif ($user->hasRole('pengelola')) {
                // Pengelola redirects to pengelola dashboard
                \Log::info('Redirecting pengelola to dashboard');
                return redirect()->to('/pengelola/dashboard');
            } else {
                // User biasa redirects to welcome page
                \Log::info('Redirecting user to home');
                return redirect()->to('/');
            }
        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
