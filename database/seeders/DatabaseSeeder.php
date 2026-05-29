<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
    KuisSeeder::class,
    NilaiSeeder::class,
    AbsensiSeeder::class,
    JadwalPelajaranSeeder::class,
    KalenderAkademikSeeder::class,
    ]);
    }
}