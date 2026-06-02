<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('materi') && !Schema::hasColumn('materi', 'kelas_id')) {
            Schema::table('materi', function (Blueprint $table) {
                $table->foreignId('kelas_id')
                    ->nullable()
                    ->after('guru_id')
                    ->constrained('kelas')
                    ->nullOnDelete();
            });
        }

        if (Schema::hasTable('tugas') && !Schema::hasColumn('tugas', 'kelas_id')) {
            Schema::table('tugas', function (Blueprint $table) {
                $table->foreignId('kelas_id')
                    ->nullable()
                    ->after('guru_id')
                    ->constrained('kelas')
                    ->nullOnDelete();
            });
        }

        if (Schema::hasTable('kuis') && !Schema::hasColumn('kuis', 'kelas_id')) {
            Schema::table('kuis', function (Blueprint $table) {
                $table->foreignId('kelas_id')
                    ->nullable()
                    ->after('guru_id')
                    ->constrained('kelas')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('materi') && Schema::hasColumn('materi', 'kelas_id')) {
            Schema::table('materi', function (Blueprint $table) {
                $table->dropConstrainedForeignId('kelas_id');
            });
        }

        if (Schema::hasTable('tugas') && Schema::hasColumn('tugas', 'kelas_id')) {
            Schema::table('tugas', function (Blueprint $table) {
                $table->dropConstrainedForeignId('kelas_id');
            });
        }

        if (Schema::hasTable('kuis') && Schema::hasColumn('kuis', 'kelas_id')) {
            Schema::table('kuis', function (Blueprint $table) {
                $table->dropConstrainedForeignId('kelas_id');
            });
        }
    }
};