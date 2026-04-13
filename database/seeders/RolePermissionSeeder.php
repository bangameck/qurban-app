<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Roles (Jangan dihapus, ini penting!)
        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'panitia']);

        // Hapus kode pembuatan user di sini,
        // karena sudah pindah ke DummyDataSeeder
    }
}
