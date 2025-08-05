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
        'email_support',
        'email_partnership',
        'website',
        'opening_hours',
        'description'
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
            'email_support' => 'support@bdaru-museum.id',
            'email_partnership' => 'partnership@bdaru-museum.id',
            'website' => 'https://bdaru-museum.id',
            'opening_hours' => 'Senin - Jumat: 08:00 - 17:00, Sabtu - Minggu: 09:00 - 18:00',
            'description' => 'Museum Digital Indonesia BDARU adalah museum modern yang menghadirkan kekayaan budaya Indonesia dalam format digital yang interaktif dan edukatif.'
        ]);
    }
}
