<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MuseumSetting;

class MuseumSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update museum settings
        MuseumSetting::updateOrCreate(
            ['id' => 1],
            [
                'museum_name' => 'Museum Digital Balai Adat Rajo Penghulu BDARU',
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
                'description' => 'Museum Digital Balai Adat Rajo Penghulu BDARU adalah museum modern yang menghadirkan kekayaan budaya Indonesia dalam format digital yang interaktif dan edukatif.',
            ]
        );
    }
}
