<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mata_pelajarans', function (Blueprint $table) {
            if (!Schema::hasColumn('mata_pelajarans', 'sks')) {
                $table->integer('sks')->nullable()->after('kode_mapel');
            }
        });
    }

    public function down(): void
    {
        Schema::table('mata_pelajarans', function (Blueprint $table) {
            if (Schema::hasColumn('mata_pelajarans', 'sks')) {
                $table->dropColumn('sks');
            }
        });
    }
};