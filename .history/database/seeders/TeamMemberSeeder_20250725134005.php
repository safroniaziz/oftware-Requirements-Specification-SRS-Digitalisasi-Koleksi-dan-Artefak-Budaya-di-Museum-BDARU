<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'Dr. Rina Sari',
                'position' => 'Direktur Utama',
                'description' => 'Ahli arkeologi dengan pengalaman 15 tahun dalam pelestarian warisan budaya Indonesia.',
                'photo' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=400&h=400&fit=crop',
                'email' => 'rina.sari@bdaru-museum.id',
                'linkedin' => 'https://linkedin.com/in/rina-sari',
                'twitter' => 'https://twitter.com/rina_sari',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Ahmad Budi',
                'position' => 'Kepala Teknologi',
                'description' => 'Spesialis teknologi digital dengan fokus pada pengembangan platform museum digital.',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop',
                'email' => 'ahmad.budi@bdaru-museum.id',
                'linkedin' => 'https://linkedin.com/in/ahmad-budi',
                'twitter' => 'https://twitter.com/ahmad_budi',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Siti Mawar',
                'position' => 'Kurator Senior',
                'description' => 'Kurator berpengalaman dalam pengelolaan koleksi dan dokumentasi artefak budaya.',
                'photo' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop&crop=face',
                'email' => 'siti.mawar@bdaru-museum.id',
                'linkedin' => 'https://linkedin.com/in/siti-mawar',
                'twitter' => 'https://twitter.com/siti_mawar',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name']],
                $member
            );
        }
    }
}
