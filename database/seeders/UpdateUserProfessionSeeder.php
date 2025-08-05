<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UpdateUserProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing users with profession and phone
        $users = [
            'admin@bdaru.com' => [
                'profession' => 'Administrator',
                'phone' => '081234567890'
            ],
            'pengelola@bdaru.com' => [
                'profession' => 'Pengelola Museum',
                'phone' => '081234567891'
            ],
            'kurator@bdaru.com' => [
                'profession' => 'Kurator',
                'phone' => '081234567892'
            ],
            'operator@bdaru.com' => [
                'profession' => 'Operator',
                'phone' => '081234567893'
            ],
            'staff@bdaru.com' => [
                'profession' => 'Staff Museum',
                'phone' => '081234567894'
            ],
            'visitor@bdaru.com' => [
                'profession' => 'Pengunjung',
                'phone' => '081234567895'
            ],
            'student@bdaru.com' => [
                'profession' => 'Mahasiswa',
                'phone' => '081234567896'
            ],
        ];

        foreach ($users as $email => $data) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->update($data);
                $this->command->info("Updated user: {$email}");
            } else {
                $this->command->warn("User not found: {$email}");
            }
        }
    }
}
