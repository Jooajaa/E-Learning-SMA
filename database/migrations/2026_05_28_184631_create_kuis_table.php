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
       Schema::create('kuis', function (Blueprint $table) {
    $table->id();
    $table->string('judul');
    $table->text('deskripsi')->nullable();
    $table->dateTime('waktu_mulai')->nullable();
    $table->dateTime('waktu_selesai')->nullable();
    $table->unsignedBigInteger('guru_id')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};
