<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // User management
            'manage users',
            'view users',

            // Collection management
            'manage collections',
            'view collections',
            'create collections',
            'edit collections',
            'delete collections',

            // Category management
            'manage categories',
            'view categories',
            'create categories',
            'edit categories',
            'delete categories',

            // News management
            'manage news',
            'view news',
            'create news',
            'edit news',
            'delete news',

            // QR Code management
            'generate qr codes',
            'download qr codes',

            // Analytics
            'view analytics',
            'view reports',

            // Content management
            'manage content',
            'upload media',
            'edit pages'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Admin role
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Create Pengelola role
        $managerRole = Role::create(['name' => 'pengelola']);
        $managerRole->givePermissionTo([
            'view collections',
            'create collections',
            'edit collections',
            'view categories',
            'view news',
            'create news',
            'edit news',
            'generate qr codes',
            'download qr codes',
            'view analytics',
            'upload media'
        ]);

        // Create User role (pengunjung biasa)
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            // User hanya bisa akses halaman publik
            'view collections',
            'view news'
        ]);
    }
}
