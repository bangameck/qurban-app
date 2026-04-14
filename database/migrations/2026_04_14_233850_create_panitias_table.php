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
        Schema::create('panitias', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->foreignId('id_warga')->constrained('wargas')->cascadeOnDelete();
            $table->enum('jabatan', [
                'Penanggung Jawab Qurban', 'Ketua Qurban', 'Koordinator',
                'Sekretaris Qurban', 'Bendahara Qurban', 'Ketua Prepare Sapi',
                'Anggota Prepare Sapi', 'Ketua Kelompok Qurban', 'Anggota Kelompok Qurban',
            ]);
            // Opsional: Untuk jabatan yang berkaitan dengan Kelompok Sapi
            $table->foreignId('id_kelompok_sapi')->nullable()->constrained('kelompok_sapis')->nullOnDelete();

            // Fitur Kupon Panitia
            $table->string('kode_unik_kupon')->unique()->nullable(); // PQN-XXX
            $table->string('path_qr_code')->nullable();
            $table->enum('status_pengambilan', ['Belum', 'Sudah'])->default('Belum');
            $table->timestamp('waktu_diambil')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panitias');
    }
};
