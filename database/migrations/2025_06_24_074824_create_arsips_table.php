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
        Schema::create('arsips', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('judul');
            $table->enum('kategori', ['Dispensasi Nikah', 'Surat Masuk', 'Surat Keluar', 'Lainnya']);
            $table->string('file_path'); // Untuk menyimpan path ke file yang diunggah
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Siapa yang mengunggah
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsips');
    }
};
