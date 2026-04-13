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
        Schema::create('mudhohis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_warga')->constrained('wargas')->cascadeOnDelete();
            $table->foreignId('id_kelompok_sapi')->constrained('kelompok_sapis')->cascadeOnDelete();
            $table->foreignId('id_panitia')->constrained('users'); // Panitia yang input
            $table->enum('tipe_qurban', ['Patungan', 'Individu', 'Kambing']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mudhohis');
    }
};
