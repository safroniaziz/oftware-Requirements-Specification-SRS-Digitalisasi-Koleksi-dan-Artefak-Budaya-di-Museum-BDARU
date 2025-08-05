<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MuseumSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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

            $logoPath = $request->file('logo')->store('logos', 'public');
            $settings->logo_path = $logoPath;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            // Delete old favicon if exists
            if ($settings->favicon_path && Storage::disk('public')->exists($settings->favicon_path)) {
                Storage::disk('public')->delete($settings->favicon_path);
            }

            $faviconPath = $request->file('favicon')->store('favicons', 'public');
            $settings->favicon_path = $faviconPath;
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
}
