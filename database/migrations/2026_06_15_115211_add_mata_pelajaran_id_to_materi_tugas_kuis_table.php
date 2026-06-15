<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('materi') && !Schema::hasColumn('materi', 'mata_pelajaran_id')) {
            Schema::table('materi', function (Blueprint $table) {
                $table->foreignId('mata_pelajaran_id')
                    ->nullable()
                    ->after('kelas_id')
                    ->constrained('mata_pelajarans')
                    ->nullOnDelete();
            });
        }

        if (Schema::hasTable('tugas') && !Schema::hasColumn('tugas', 'mata_pelajaran_id')) {
            Schema::table('tugas', function (Blueprint $table) {
                $table->foreignId('mata_pelajaran_id')
                    ->nullable()
                    ->after('kelas_id')
                    ->constrained('mata_pelajarans')
                    ->nullOnDelete();
            });
        }

        if (Schema::hasTable('kuis') && !Schema::hasColumn('kuis', 'mata_pelajaran_id')) {
            Schema::table('kuis', function (Blueprint $table) {
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
        if (Schema::hasTable('materi') && Schema::hasColumn('materi', 'mata_pelajaran_id')) {
            Schema::table('materi', function (Blueprint $table) {
                $table->dropConstrainedForeignId('mata_pelajaran_id');
            });
        }

        if (Schema::hasTable('tugas') && Schema::hasColumn('tugas', 'mata_pelajaran_id')) {
            Schema::table('tugas', function (Blueprint $table) {
                $table->dropConstrainedForeignId('mata_pelajaran_id');
            });
        }

        if (Schema::hasTable('kuis') && Schema::hasColumn('kuis', 'mata_pelajaran_id')) {
            Schema::table('kuis', function (Blueprint $table) {
                $table->dropConstrainedForeignId('mata_pelajaran_id');
            });
        }
    }
};