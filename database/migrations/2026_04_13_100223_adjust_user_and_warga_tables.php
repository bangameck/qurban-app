<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Bersihkan tabel warga dari id_user lama
        Schema::table('wargas', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
        });

        // 2. Modifikasi tabel users
        Schema::table('users', function (Blueprint $table) {
            // id_warga sebagai foreign key utama
            $table->foreignId('id_warga')->nullable()->after('id')->constrained('wargas')->cascadeOnDelete();

            // Kolom status untuk aktif/nonaktif
            $table->boolean('status')->default(true)->after('password');

            // Buat email nullable agar bisa pakai dummy
            $table->string('email')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_warga']);
            $table->dropColumn(['id_warga', 'status']);
        });

        Schema::table('wargas', function (Blueprint $table) {
            $table->foreignId('id_user')->nullable()->constrained('users')->nullOnDelete();
        });
    }
};
