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
        $admin = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        $guru = Role::firstOrCreate([
            'name' => 'guru'
        ]);

        $siswa = Role::firstOrCreate([
            'name' => 'siswa'
        ]);

        // Buat User Admin
        $userAdmin = User::firstOrCreate(
            [
                'email' => 'admin@lms.com'
            ],
            [
                'name' => 'Admin Sekolah',
                'password' => Hash::make('password'),
            ]
        );

        $userAdmin->assignRole($admin);

        // Buat User Guru
        $userGuru = User::firstOrCreate(
            [
                'email' => 'guru@lms.com'
            ],
            [
                'name' => 'Guru Contoh',
                'password' => Hash::make('password'),
            ]
        );

        $userGuru->assignRole($guru);

        // Buat User Siswa
        $userSiswa = User::firstOrCreate(
            [
                'email' => 'siswa@lms.com'
            ],
            [
                'name' => 'Siswa Contoh',
                'password' => Hash::make('password'),
            ]
        );

        $userSiswa->assignRole($siswa);
    }
}