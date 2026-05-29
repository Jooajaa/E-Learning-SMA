<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KalenderAkademik;

class KalenderAkademikSeeder extends Seeder
{
    public function run(): void
    {
        KalenderAkademik::create([
            'judul' => 'Ujian Tengah Semester',
            'tanggal_mulai' => now()->addDays(14)->toDateString(),
            'tanggal_selesai' => now()->addDays(20)->toDateString(),
            'jenis' => 'ujian',
            'keterangan' => 'Pelaksanaan UTS semester berjalan',
        ]);

        KalenderAkademik::create([
            'judul' => 'Libur Nasional',
            'tanggal_mulai' => now()->addDays(30)->toDateString(),
            'tanggal_selesai' => now()->addDays(30)->toDateString(),
            'jenis' => 'libur',
            'keterangan' => 'Libur nasional sekolah',
        ]);
    }
}