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
        Schema::create('sesi_distribusis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sesi'); // ex: Sesi 1 Lansia
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('kuota_maksimal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_distribusis');
    }
};
