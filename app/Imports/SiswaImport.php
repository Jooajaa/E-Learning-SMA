<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['nama']) || empty($row['email']) || empty($row['nis'])) {
            return null;
        }

        $user = User::updateOrCreate(
            ['email' => $row['email']],
            [
                'name' => $row['nama'],
                'nis' => $row['nis'],
                'password' => Hash::make('password'),
                'status' => $row['status'] ?? 'aktif',
            ]
        );

        Role::firstOrCreate(['name' => 'siswa']);
        $user->assignRole('siswa');

        return $user;
    }
}
