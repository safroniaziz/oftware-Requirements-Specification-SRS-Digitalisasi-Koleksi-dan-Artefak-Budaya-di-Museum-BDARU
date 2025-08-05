<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuseumSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'museum_name',
        'address',
        'city',
        'province',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'phone_1',
        'phone_2',
        'email_info',
        'website',
        'opening_hours',
        'description',
        'logo_path'
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Get the first museum setting (singleton pattern)
     */
    public static function getSettings()
    {
        return static::first() ?? static::create([
            'museum_name' => 'Museum Digital Indonesia BDARU',
            'address' => 'Jl. Museum Nasional No. 1, Gambir',
            'city' => 'Jakarta Pusat',
            'province' => 'DKI Jakarta',
            'postal_code' => '10110',
            'country' => 'Indonesia',
            'latitude' => -6.175392,
            'longitude' => 106.827183,
            'phone_1' => '+62-21-3868172',
            'phone_2' => '+62-21-3868173',
            'email_info' => 'info@bdaru-museum.id',
            'website' => 'https://bdaru-museum.id',
            'opening_hours' => 'Senin - Jumat: 08:00 - 17:00, Sabtu - Minggu: 09:00 - 18:00',
            'description' => 'Museum Digital Indonesia BDARU adalah museum modern yang menghadirkan kekayaan budaya Indonesia dalam format digital yang interaktif dan edukatif.'
        ]);
    }

    /**
     * Get the logo URL attribute
     */
    public function getLogoUrlAttribute()
    {
        if (!$this->logo_path || empty($this->logo_path)) {
            return null;
        }

        // If it's already a full URL, return as is
        if (filter_var($this->logo_path, FILTER_VALIDATE_URL)) {
            return $this->logo_path;
        }

        // If it starts with storage/, convert to full URL
        if (str_starts_with($this->logo_path, 'storage/')) {
            return asset($this->logo_path);
        }

        // Otherwise, assume it's a storage path
        return asset('storage/' . $this->logo_path);
    }

    /**
     * Get the favicon URL attribute
     */
    public function getFaviconUrlAttribute()
    {
        if (!$this->favicon_path || empty($this->favicon_path)) {
            return null;
        }

        // If it's already a full URL, return as is
        if (filter_var($this->favicon_path, FILTER_VALIDATE_URL)) {
            return $this->favicon_path;
        }

        // If it starts with storage/, convert to full URL
        if (str_starts_with($this->favicon_path, 'storage/')) {
            return asset($this->favicon_path);
        }

        // Otherwise, assume it's a storage path
        return asset('storage/' . $this->favicon_path);
    }
}
