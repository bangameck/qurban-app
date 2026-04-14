<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mudhohis', function (Blueprint $table) {
            // Cek biar nggak error kalau udah ada
            if (! Schema::hasColumn('mudhohis', 'status_pengambilan')) {
                $table->enum('status_pengambilan', ['Belum', 'Sudah'])->default('Belum')->after('path_qr_code');
            }
            if (! Schema::hasColumn('mudhohis', 'waktu_diambil')) {
                $table->timestamp('waktu_diambil')->nullable()->after('status_pengambilan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('mudhohis', function (Blueprint $table) {
            if (Schema::hasColumn('mudhohis', 'status_pengambilan')) {
                $table->dropColumn('status_pengambilan');
            }
            if (Schema::hasColumn('mudhohis', 'waktu_diambil')) {
                $table->dropColumn('waktu_diambil');
            }
        });
    }
};
