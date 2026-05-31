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
        Schema::create('materi', function (Blueprint $table) {

            $table->id();

            // Guru yang upload materi
            $table->foreignId('guru_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Informasi materi
            $table->string('judul');

            $table->text('deskripsi')->nullable();

            // File materi (pdf/doc/ppt/dll)
            $table->string('file');

            // Optional tambahan
            $table->string('thumbnail')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};