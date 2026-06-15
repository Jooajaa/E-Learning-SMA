<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('absensi') && !Schema::hasColumn('absensi', 'kelas_id')) {
            Schema::table('absensi', function (Blueprint $table) {
                $table->foreignId('kelas_id')
                    ->nullable()
                    ->after('siswa_id')
                    ->constrained('kelas')
                    ->nullOnDelete();
            });
        }

        if (Schema::hasTable('absensi') && !Schema::hasColumn('absensi', 'mata_pelajaran_id')) {
            Schema::table('absensi', function (Blueprint $table) {
                $table->foreignId('mata_pelajaran_id')
                    ->nullable()
                    ->after('kelas_id')
                    ->constrained('mata_pelajarans')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('absensi') && Schema::hasColumn('absensi', 'mata_pelajaran_id')) {
            Schema::table('absensi', function (Blueprint $table) {
                $table->dropConstrainedForeignId('mata_pelajaran_id');
            });
        }

        if (Schema::hasTable('absensi') && Schema::hasColumn('absensi', 'kelas_id')) {
            Schema::table('absensi', function (Blueprint $table) {
                $table->dropConstrainedForeignId('kelas_id');
            });
        }
    }
};