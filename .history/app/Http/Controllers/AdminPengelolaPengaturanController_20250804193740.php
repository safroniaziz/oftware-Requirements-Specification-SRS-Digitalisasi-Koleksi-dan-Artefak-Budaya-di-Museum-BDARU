<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MuseumSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminPengelolaPengaturanController extends Controller
{
    public function index()
    {
        $settings = MuseumSetting::first();

        return view('management.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'museum_name' => 'required|string|max:255',
            'museum_description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'opening_hours' => 'nullable|string',
            'social_media' => 'nullable|array',
            'social_media.facebook' => 'nullable|url',
            'social_media.instagram' => 'nullable|url',
            'social_media.twitter' => 'nullable|url',
            'social_media.youtube' => 'nullable|url',
        ]);

        $settings = MuseumSetting::first();

        if (!$settings) {
            $settings = new MuseumSetting();
        }

        $settings->fill($request->all());
        $settings->save();

        // Log the update
        Log::info('Settings updated', [
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'user_email' => Auth::user()->email,
            'ip_address' => $request->ip(),
            'action' => 'SETTINGS_UPDATE',
            'details' => 'General settings updated'
        ]);

        return redirect()->route('settings-management.index')->with('success', 'Pengaturan berhasil diperbarui');
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
        ]);

        $settings = MuseumSetting::first();

        if (!$settings) {
            $settings = new MuseumSetting();
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($settings->logo_path && Storage::disk('public')->exists($settings->logo_path)) {
                Storage::disk('public')->delete($settings->logo_path);
            }

            $logo = $request->file('logo');
            $filename = 'logos/' . time() . '_' . $logo->getClientOriginalName();

            // Create image manager
            $manager = new ImageManager(new Driver());

            // Resize and crop logo to 300x300 (square) for optimal display
            $resizedLogo = $manager->read($logo)
                ->cover(300, 300)
                ->toPng();

            Storage::disk('public')->put($filename, $resizedLogo);
            $settings->logo_path = $filename;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($settings->favicon_path && Storage::disk('public')->exists($settings->favicon_path)) {
                Storage::disk('public')->delete($settings->favicon_path);
            }

            $favicon = $request->file('favicon');
            $filename = 'favicons/' . time() . '_' . $favicon->getClientOriginalName();

            // Create image manager
            $manager = new ImageManager(new Driver());

            // Resize and crop favicon to 64x64 (square) for favicon standard
            $resizedFavicon = $manager->read($favicon)
                ->cover(64, 64)
                ->toPng();

            Storage::disk('public')->put($filename, $resizedFavicon);
            $settings->favicon_path = $filename;
        }

        $settings->save();

        // Log the update
        Log::info('Logo/Favicon updated', [
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'user_email' => Auth::user()->email,
            'ip_address' => $request->ip(),
            'action' => 'LOGO_UPDATE',
            'details' => 'Logo or favicon updated'
        ]);

        return redirect()->route('settings-management.index')->with('success', 'Logo dan favicon berhasil diperbarui');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'mail_host' => 'nullable|string|max:255',
            'mail_port' => 'nullable|integer|min:1|max:65535',
            'mail_username' => 'nullable|email|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|in:tls,ssl',
        ]);

        $settings = MuseumSetting::first();

        if (!$settings) {
            $settings = new MuseumSetting();
        }

        $settings->fill($request->all());
        $settings->save();

        // Log the update
        Log::info('Email settings updated', [
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'user_email' => Auth::user()->email,
            'ip_address' => $request->ip(),
            'action' => 'EMAIL_SETTINGS_UPDATE',
            'details' => 'SMTP settings updated'
        ]);

        return redirect()->route('settings-management.index')->with('success', 'Pengaturan email berhasil diperbarui');
    }

    public function updateSocial(Request $request)
    {
        $request->validate([
            'social_media' => 'nullable|array',
            'social_media.facebook' => 'nullable|url',
            'social_media.instagram' => 'nullable|url',
            'social_media.twitter' => 'nullable|url',
            'social_media.youtube' => 'nullable|url',
        ]);

        $settings = MuseumSetting::first();
        if (!$settings) {
            $settings = new MuseumSetting();
        }
        $settings->fill($request->all());
        $settings->save();

        Log::info('Social media settings updated', [
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'user_email' => Auth::user()->email,
            'ip_address' => $request->ip(),
            'action' => 'SOCIAL_UPDATE',
            'details' => 'Social media settings updated'
        ]);

        return redirect()->route('settings-management.index')->with('success', 'Pengaturan sosial media berhasil diperbarui');
    }

    public function clearCache()
    {
        try {
            // Clear all caches
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            Cache::flush();

            // Log the action
            Log::info('Cache cleared', [
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'user_email' => Auth::user()->email,
                'ip_address' => request()->ip(),
                'action' => 'CACHE_CLEAR',
                'details' => 'All caches cleared successfully'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cache berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Cache clear failed', [
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'user_email' => Auth::user()->email,
                'ip_address' => request()->ip(),
                'action' => 'CACHE_CLEAR_FAILED',
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus cache: ' . $e->getMessage()
            ], 500);
        }
    }

    public function clearLogs()
    {
        try {
            // Clear Laravel logs
            $logPath = storage_path('logs');
            $files = glob($logPath . '/*.log');

            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }

            // Log the action
            Log::info('Logs cleared', [
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'user_email' => Auth::user()->email,
                'ip_address' => request()->ip(),
                'action' => 'LOGS_CLEAR',
                'details' => 'All log files cleared successfully'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Logs berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            Log::error('Logs clear failed', [
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'user_email' => Auth::user()->email,
                'ip_address' => request()->ip(),
                'action' => 'LOGS_CLEAR_FAILED',
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus logs: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateSystem(Request $request)
    {
        try {
            $request->validate([
                'maintenance_mode' => 'boolean',
                'debug_mode' => 'boolean',
                'pagination_per_page' => 'integer|min:5|max:100',
                'session_lifetime' => 'integer|min:1|max:1440',
            ]);

            $settings = MuseumSetting::first();
            if (!$settings) {
                $settings = new MuseumSetting();
            }

            // Update system settings
            $settings->maintenance_mode = $request->input('maintenance_mode', false);
            $settings->debug_mode = $request->input('debug_mode', false);
            $settings->pagination_per_page = $request->input('pagination_per_page', 10);
            $settings->session_lifetime = $request->input('session_lifetime', 120);
            $settings->save();

            // Log the action
            Log::info('System settings updated', [
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'user_email' => Auth::user()->email,
                'ip_address' => request()->ip(),
                'action' => 'SYSTEM_SETTINGS_UPDATE',
                'details' => 'System settings updated via AJAX',
                'settings' => [
                    'maintenance_mode' => $settings->maintenance_mode,
                    'debug_mode' => $settings->debug_mode,
                    'pagination_per_page' => $settings->pagination_per_page,
                    'session_lifetime' => $settings->session_lifetime,
                ]
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pengaturan sistem berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            Log::error('System settings update failed', [
                'user_id' => Auth::id(),
                'user_name' => Auth::user()->name,
                'user_email' => Auth::user()->email,
                'ip_address' => request()->ip(),
                'action' => 'SYSTEM_SETTINGS_UPDATE_FAILED',
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan pengaturan sistem: ' . $e->getMessage()
            ], 500);
        }
    }
}
