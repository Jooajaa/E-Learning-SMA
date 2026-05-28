<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Absensi;

class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
        Absensi::create([
            'siswa_id' => 3,
            'guru_id' => 2,
            'tanggal' => now()->toDateString(),
            'status' => 'hadir',
            'keterangan' => 'Hadir tepat waktu',
        ]);

        Absensi::create([
            'siswa_id' => 3,
            'guru_id' => 2,
            'tanggal' => now()->subDay()->toDateString(),
            'status' => 'izin',
            'keterangan' => 'Izin karena keperluan keluarga',
        ]);
    }
}