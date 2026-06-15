<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Role;

class GuruImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $name = $row['name'] ?? null;
        $email = $row['email'] ?? null;
        $nip = $row['nip'] ?? null;
        $password = $row['password'] ?? 'password';
        $status = $row['status'] ?? 'aktif';

        if (!$name || !$email) {
            return null;
        }

        // Cek email sudah ada
        if (User::where('email', $email)->exists()) {
            return null;
        }

        // Cek NIP sudah ada
        if ($nip && Schema::hasColumn('users', 'nip')) {
            if (User::where('nip', $nip)->exists()) {
                return null;
            }
        }

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ];

        if (Schema::hasColumn('users', 'nip')) {
            $data['nip'] = $nip;
        }

        if (Schema::hasColumn('users', 'status')) {
            $data['status'] = $status;
        }

        $guru = User::create($data);

        Role::firstOrCreate(['name' => 'guru']);
        $guru->assignRole('guru');

        return $guru;
    }
}