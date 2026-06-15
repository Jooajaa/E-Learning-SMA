<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('nilais') && !Schema::hasColumn('nilais', 'mata_pelajaran_id')) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->foreignId('mata_pelajaran_id')
                    ->nullable()
                    ->after('kuis_id')
                    ->constrained('mata_pelajarans')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('nilais') && Schema::hasColumn('nilais', 'mata_pelajaran_id')) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->dropConstrainedForeignId('mata_pelajaran_id');
            });
        }
    }
};