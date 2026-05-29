<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kuis;
use App\Models\SoalKuis;

class KuisSeeder extends Seeder
{
    public function run(): void
    {
        $kuis = Kuis::create([
            'judul' => 'Kuis Matematika Dasar',
            'deskripsi' => 'Kuis pilihan ganda tentang operasi matematika dasar.',
            'waktu_mulai' => now(),
            'waktu_selesai' => now()->addDays(7),
            'guru_id' => 2,
        ]);

        SoalKuis::create([
            'kuis_id' => $kuis->id,
            'pertanyaan' => 'Berapakah hasil dari 5 + 3?',
            'pilihan_a' => '6',
            'pilihan_b' => '7',
            'pilihan_c' => '8',
            'pilihan_d' => '9',
            'jawaban_benar' => 'C',
        ]);

        SoalKuis::create([
            'kuis_id' => $kuis->id,
            'pertanyaan' => 'Berapakah hasil dari 10 - 4?',
            'pilihan_a' => '4',
            'pilihan_b' => '5',
            'pilihan_c' => '6',
            'pilihan_d' => '7',
            'jawaban_benar' => 'C',
        ]);
    }
}