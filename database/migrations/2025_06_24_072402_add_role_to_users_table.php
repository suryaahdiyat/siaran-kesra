<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambahkan kolom 'role' setelah kolom 'email'
            // Tipe ENUM membatasi isinya hanya boleh 'staff' atau 'kepala_bidang'
            // Defaultnya adalah 'staff'
            $table->enum('role', ['staff', 'kepala_bidang'])->default('staff')->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Jika migrasi di-rollback, hapus kolom 'role'
            $table->dropColumn('role');
        });
    }
};