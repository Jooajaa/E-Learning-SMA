<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumpulan_tugas', function (Blueprint $table) {

            $table->id();

            // Relasi tugas
            $table->foreignId('tugas_id')
                ->constrained('tugas')
                ->onDelete('cascade');

            // Relasi siswa
            $table->foreignId('siswa_id')
                ->constrained('users')
                ->onDelete('cascade');

            // File jawaban
            $table->string('file');

            // Status
            $table->enum('status', [
                'dikumpulkan',
                'dinilai'
            ])->default('dikumpulkan');

            // Komentar guru
            $table->text('komentar')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumpulan_tugas');
    }
};