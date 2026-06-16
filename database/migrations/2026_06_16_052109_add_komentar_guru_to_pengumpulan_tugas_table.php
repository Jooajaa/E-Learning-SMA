<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pengumpulan_tugas') && !Schema::hasColumn('pengumpulan_tugas', 'komentar_guru')) {
            Schema::table('pengumpulan_tugas', function (Blueprint $table) {
                $table->text('komentar_guru')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pengumpulan_tugas') && Schema::hasColumn('pengumpulan_tugas', 'komentar_guru')) {
            Schema::table('pengumpulan_tugas', function (Blueprint $table) {
                $table->dropColumn('komentar_guru');
            });
        }
    }
};