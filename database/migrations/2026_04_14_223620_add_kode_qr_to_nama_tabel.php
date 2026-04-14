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
        Schema::table('mudhohis', function (Blueprint $table) {
            // Cek apakah kolom belum ada sebelum menambahkan
            if (! Schema::hasColumn('mudhohis', 'kode_unik_kupon')) {
                // Tambahkan nullable() agar tidak error jika ada data lama
                $table->string('kode_unik_kupon', 10)->nullable()->unique()->after('path_bukti_pendaftaran');
            }

            if (! Schema::hasColumn('mudhohis', 'path_qr_code')) {
                $table->string('path_qr_code')->nullable()->after('kode_unik_kupon');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mudhohis', function (Blueprint $table) {
            if (Schema::hasColumn('mudhohis', 'kode_unik_kupon')) {
                $table->dropColumn('kode_unik_kupon');
            }

            if (Schema::hasColumn('mudhohis', 'path_qr_code')) {
                $table->dropColumn('path_qr_code');
            }
        });
    }
};
