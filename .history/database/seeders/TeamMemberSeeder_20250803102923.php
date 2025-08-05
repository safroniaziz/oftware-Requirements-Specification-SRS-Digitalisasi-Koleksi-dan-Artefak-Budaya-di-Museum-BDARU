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
                            'photo' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=DrRinaSari&backgroundColor=10b981&mouth=smile&style=circle',
                            'email' => 'rina.sari@bdaru-museum.id',
                            'linkedin' => 'https://linkedin.com/in/rina-sari',
                            'twitter' => 'https://twitter.com/rina_sari',
                            'is_active' => true,

                        ],
                        [
                            'name' => 'Ahmad Budi',
                            'position' => 'Kepala Teknologi',
                            'description' => 'Spesialis teknologi digital dengan fokus pada pengembangan platform museum digital.',
                            'photo' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=AhmadBudi&backgroundColor=10b981&mouth=smile&style=circle',
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
                            'photo' => 'https://api.dicebear.com/7.x/avataaars/svg?seed=SitiMawar&backgroundColor=10b981&mouth=smile&style=circle',
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
