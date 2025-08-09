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
            'museum_name' => 'Museum Digital Balai Adat Rajo Penghulu BDARU',
            'address' => 'Jl. Museum Nasional No. 1',
            'city' => 'Jakarta Pusat',
            'province' => 'DKI Jakarta',
            'postal_code' => '10110',
            'country' => 'Indonesia',
            'latitude' => -6.175392,
            'longitude' => 106.827183,
            'phone_1' => '+62 21 386 8172',
            'phone_2' => '+62 21 386 8173',
            'email_info' => 'info@bdaru-museum.id',
            'email_support' => 'support@bdaru-museum.id',
            'email_partnership' => 'partnership@bdaru-museum.id',
            'website' => 'https://bdaru-museum.id',
            'opening_hours' => json_encode([
                'monday' => '08:00 - 17:00',
                'tuesday' => '08:00 - 17:00',
                'wednesday' => '08:00 - 17:00',
                'thursday' => '08:00 - 17:00',
                'friday' => '08:00 - 17:00',
                'saturday' => '09:00 - 15:00',
                'sunday' => 'Tutup'
            ]),
            'description' => 'Museum Digital Balai Adat Rajo Penghulu yang berkomitmen melestarikan dan memperkenalkan warisan budaya Indonesia melalui teknologi digital yang inovatif.'
        ]);
    }
}
