<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalPelajaran;

class JadwalPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        JadwalPelajaran::create([
            'hari' => 'Senin',
            'jam_mulai' => '07:30',
            'jam_selesai' => '09:00',
            'mata_pelajaran' => 'Matematika',
            'kelas' => 'X IPA 1',
            'guru_id' => 2,
        ]);

        JadwalPelajaran::create([
            'hari' => 'Rabu',
            'jam_mulai' => '09:15',
            'jam_selesai' => '10:45',
            'mata_pelajaran' => 'Bahasa Indonesia',
            'kelas' => 'X IPA 1',
            'guru_id' => 2,
        ]);
    }
}