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
        Schema::create('jawaban_kuis', function (Blueprint $table) {
    $table->id();
    $table->foreignId('kuis_id')->constrained('kuis')->onDelete('cascade');
    $table->foreignId('soal_kuis_id')->constrained('soal_kuis')->onDelete('cascade');
    $table->unsignedBigInteger('siswa_id');
    $table->enum('jawaban', ['A', 'B', 'C', 'D'])->nullable();
    $table->boolean('benar')->default(false);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_kuis');
    }
};
