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
        Schema::create('mustahiqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_warga')->constrained('wargas')->cascadeOnDelete();
            $table->foreignId('id_sesi_distribusi')->constrained('sesi_distribusis');
            $table->enum('kategori_penerima', ['Mustahiq', 'Mudhohi', 'Panitia']);
            $table->string('kode_unik_kupon', 10)->unique(); // ex: QBN-X82
            $table->string('path_qr_code')->nullable();
            $table->enum('status_pengambilan', ['Belum', 'Sudah'])->default('Belum');
            $table->timestamp('waktu_diambil')->nullable();
            $table->foreignId('id_panitia_scanner')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mustahiqs');
    }
};
