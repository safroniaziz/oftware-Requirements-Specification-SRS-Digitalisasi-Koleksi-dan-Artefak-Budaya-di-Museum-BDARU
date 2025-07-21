<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin user
        $admin = User::create([
            'name' => 'Administrator BDARU',
            'email' => 'admin@bdaru.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Create Pengelola user
        $manager = User::create([
            'name' => 'Pengelola BDARU',
            'email' => 'pengelola@bdaru.com',
            'password' => Hash::make('pengelola123'),
            'email_verified_at' => now(),
        ]);
        $manager->assignRole('pengelola');

        // Create additional pengelola users
        $manager2 = User::create([
            'name' => 'Kurator Budaya',
            'email' => 'kurator@bdaru.com',
            'password' => Hash::make('kurator123'),
            'email_verified_at' => now(),
        ]);
        $manager2->assignRole('pengelola');
    }
}
