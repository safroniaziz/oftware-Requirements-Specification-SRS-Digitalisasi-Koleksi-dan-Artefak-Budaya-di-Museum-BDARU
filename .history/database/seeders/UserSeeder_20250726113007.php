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

        // Create User/Operator accounts
        $user1 = User::create([
            'name' => 'Operator BDARU',
            'email' => 'operator@bdaru.com',
            'password' => Hash::make('operator123'),
            'email_verified_at' => now(),
        ]);
        $user1->assignRole('user'); // User biasa

        $user2 = User::create([
            'name' => 'Staff Museum',
            'email' => 'staff@bdaru.com',
            'password' => Hash::make('staff123'),
            'email_verified_at' => now(),
        ]);
        $user2->assignRole('user'); // User biasa

        // Create regular visitor accounts
        $visitor1 = User::create([
            'name' => 'Pengunjung Museum',
            'email' => 'visitor@bdaru.com',
            'password' => Hash::make('visitor123'),
            'email_verified_at' => now(),
        ]);
        $visitor1->assignRole('user');

        $visitor2 = User::create([
            'name' => 'Mahasiswa Budaya',
            'email' => 'student@bdaru.com',
            'password' => Hash::make('student123'),
            'email_verified_at' => now(),
        ]);
        $visitor2->assignRole('user');
    }
}
