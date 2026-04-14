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
            $table->string('path_bukti_pendaftaran')->nullable()->after('tipe_qurban');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mudhohis', function (Blueprint $table) {
            //
        });
    }
};
