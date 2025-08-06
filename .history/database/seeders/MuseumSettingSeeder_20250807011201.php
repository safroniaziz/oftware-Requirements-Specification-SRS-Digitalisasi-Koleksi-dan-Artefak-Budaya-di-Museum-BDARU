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
                'museum_name' => 'Museum Digital Indonesia BDARU',
                'address' => 'Jl. Pariwisata, Malabero, Kec. Tlk. Segara, Kota Bengkulu, Bengkulu, Indonesia',
                'city' => 'Kota Bengkulu',
                'province' => 'Bengkulu',
                'postal_code' => '38119',
                'country' => 'Indonesia',
                'latitude' => -3.7956,
                'longitude' => 102.2592,
                'phone_1' => '0823-7355-5447',
                'phone_2' => '0823-7355-5447',
                'email_info' => 'balaiadatrajopenghulu@gmail.com',
                'website' => 'https://bdaru-museum.id',
                'opening_hours' => 'Senin - Jumat: 08:00 - 17:00, Sabtu - Minggu: 09:00 - 18:00',
                'description' => 'Museum Digital Indonesia BDARU adalah museum modern yang menghadirkan kekayaan budaya Indonesia dalam format digital yang interaktif dan edukatif.',
            ]
        );
    }
}
