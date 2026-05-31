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
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();

            // Relasi ke guru
            $table->foreignId('guru_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Judul tugas
            $table->string('judul');

            // Instruksi tugas
            $table->text('instruksi');

            // Deadline pengumpulan
            $table->dateTime('deadline');

            // File tugas (optional)
            $table->string('file')->nullable();

            // Timestamp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};