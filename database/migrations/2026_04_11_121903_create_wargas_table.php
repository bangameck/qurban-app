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
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->nullable()->constrained('users')->nullOnDelete();

            // Tambahkan no_kk di sini, buat nullable karena opsional
            $table->string('no_kk')->nullable();

            $table->string('nik')->unique();
            $table->string('nama');

            // Gabungkan nullable() dan unique() di sini wak!
            $table->string('phone_number')->nullable()->unique();

            $table->text('alamat');
            $table->foreignId('id_rt')->nullable()->constrained('rts')->nullOnDelete();
            $table->enum('jabatan_sosial', ['Warga', 'RT', 'RW', 'Tokoh'])->default('Warga');
            $table->string('path_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};
