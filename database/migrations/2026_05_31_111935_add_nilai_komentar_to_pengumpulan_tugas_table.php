<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            if (!Schema::hasColumn('pengumpulan_tugas', 'nilai')) {
                $table->integer('nilai')->nullable()->after('file');
            }

            if (!Schema::hasColumn('pengumpulan_tugas', 'komentar')) {
                $table->text('komentar')->nullable()->after('nilai');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengumpulan_tugas', function (Blueprint $table) {
            if (Schema::hasColumn('pengumpulan_tugas', 'komentar')) {
                $table->dropColumn('komentar');
            }

            if (Schema::hasColumn('pengumpulan_tugas', 'nilai')) {
                $table->dropColumn('nilai');
            }
        });
    }
};