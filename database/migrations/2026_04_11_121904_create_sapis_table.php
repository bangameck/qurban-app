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
        Schema::create('sapis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_sapi')->unique();
            $table->string('jenis_sapi');
            $table->decimal('berat', 8, 2); // dalam KG
            $table->enum('jenis_kelamin', ['Jantan', 'Betina']);
            $table->string('nama_peternakan')->nullable();
            $table->string('path_foto_sapi')->nullable();
            $table->enum('status_proses', ['Menunggu', 'Disembelih', 'Dikuliti', 'Selesai'])->default('Menunggu');
            $table->timestamp('waktu_sembelih')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sapis');
    }
};
