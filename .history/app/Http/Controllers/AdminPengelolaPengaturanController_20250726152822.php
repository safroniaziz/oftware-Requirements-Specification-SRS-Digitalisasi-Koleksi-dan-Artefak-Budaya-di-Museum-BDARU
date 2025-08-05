<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MuseumSetting;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('settings-management.index')->with('success', 'Pengaturan berhasil diperbarui');
    }
}
