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
        Schema::create('dispensasi_nikahs', function (Blueprint $table) {
            $table->id();

            // Info Umum
            $table->string('nomor_surat_kua');
            $table->string('file_dn_selesai')->nullable(); // Path ke file lampiran surat dispensasi nikah selesai
            $table->string('file_dn_selesai_uploaded_at')->nullable(); // Path ke file lampiran surat dispensasi nikah selesai
            $table->date('tanggal_nikah');
            $table->string('file_surat_kua'); // Path ke file lampiran dari KUA

            // Calon Pria
            $table->string('nama_pria');
            $table->string('jenis_kelamin_pria')->default('Laki-laki');
            $table->string('tempat_lahir_pria');
            $table->date('tanggal_lahir_pria');
            $table->string('agama_pria');
            $table->string('pekerjaan_pria');
            $table->text('alamat_pria');
            /* The code snippet you provided is defining the columns for a database table named `dispensasi_nikahs`
using Laravel's migration schema builder. */
            $table->boolean('pernah_nikah_pria');
            $table->string('file_bukti_cerai_pria')->nullable(); // Bisa kosong

            // Calon Wanita
            $table->string('nama_wanita');
            $table->string('jenis_kelamin_wanita')->default('Perempuan');
            $table->string('tempat_lahir_wanita');
            $table->date('tanggal_lahir_wanita');
            $table->string('agama_wanita');
            $table->string('pekerjaan_wanita');
            $table->text('alamat_wanita');
            $table->boolean('pernah_nikah_wanita');
            $table->string('file_bukti_cerai_wanita')->nullable(); // Bisa kosong

            $table->timestamps(); // Tanggal Upload akan diambil dari created_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispensasi_nikahs');
    }
};
