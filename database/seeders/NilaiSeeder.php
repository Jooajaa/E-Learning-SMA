<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;

class NilaiSeeder extends Seeder
{
    public function run(): void
    {
        Nilai::create([
            'siswa_id' => 3,
            'guru_id' => 2,
            'kuis_id' => 1,
            'nilai' => 85,
            'keterangan' => 'Nilai kuis matematika dasar',
        ]);

        Nilai::create([
            'siswa_id' => 3,
            'guru_id' => 2,
            'kuis_id' => 1,
            'nilai' => 90,
            'keterangan' => 'Nilai tugas harian',
        ]);
    }
}