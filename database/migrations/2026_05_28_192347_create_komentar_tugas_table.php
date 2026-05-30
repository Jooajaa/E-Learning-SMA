<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('komentar_tugas', function (Blueprint $table) {
            $table->id();

            // Relasi ke pengumpulan tugas siswa
            $table->foreignId('pengumpulan_tugas_id')
                ->constrained()
                ->onDelete('cascade');

            // Isi komentar guru
            $table->text('komentar');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar_tugas');
    }
};
