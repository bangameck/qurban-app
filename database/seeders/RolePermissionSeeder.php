<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Roles
        $superadmin = Role::create(['name' => 'superadmin']);
        $admin = Role::create(['name' => 'admin']);
        $panitia = Role::create(['name' => 'panitia']);

        // Buat User Superadmin
        $user = User::create([
            'name' => 'Radevanka',
            'email' => 'admin@qurbanapp.com',
            'password' => bcrypt('password123'),
        ]);

        // Assign role
        $user->assignRole($superadmin);
    }
}
