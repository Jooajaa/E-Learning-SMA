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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'nis')) {
                $table->string('nis')->nullable()->unique()->after('email');
            }

            if (!Schema::hasColumn('users', 'nip')) {
                $table->string('nip')->nullable()->unique()->after('nis');
            }

            if (!Schema::hasColumn('users', 'status')) {
                $table->enum('status', ['aktif', 'nonaktif'])
                    ->default('aktif')
                    ->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'nis')) {
                $table->dropColumn('nis');
            }

            if (Schema::hasColumn('users', 'nip')) {
                $table->dropColumn('nip');
            }

            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};