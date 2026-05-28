<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Role
        $admin = Role::create(['name' => 'admin']);
        $guru  = Role::create(['name' => 'guru']);
        $siswa = Role::create(['name' => 'siswa']);

        // Buat User Admin
        $userAdmin = User::create([
            'name'     => 'Admin Sekolah',
            'email'    => 'admin@lms.com',
            'password' => Hash::make('password'),
        ]);
        $userAdmin->assignRole($admin);

        // Buat User Guru
        $userGuru = User::create([
            'name'     => 'Guru Contoh',
            'email'    => 'guru@lms.com',
            'password' => Hash::make('password'),
        ]);
        $userGuru->assignRole($guru);

        // Buat User Siswa
        $userSiswa = User::create([
            'name'     => 'Siswa Contoh',
            'email'    => 'siswa@lms.com',
            'password' => Hash::make('password'),
        ]);
        $userSiswa->assignRole($siswa);
    }
}