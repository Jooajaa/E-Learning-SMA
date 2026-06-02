<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['nama']) || empty($row['email']) || empty($row['nip'])) {
            return null;
        }

        $user = User::updateOrCreate(
            ['email' => $row['email']],
            [
                'name' => $row['nama'],
                'nip' => $row['nip'],
                'password' => Hash::make('password'),
                'status' => $row['status'] ?? 'aktif',
            ]
        );

        Role::firstOrCreate(['name' => 'guru']);
        $user->assignRole('guru');

        return $user;
    }
}
