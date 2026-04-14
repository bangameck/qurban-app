<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Daftar tabel yang butuh fitur Multi-Tahun
     */
    protected $tables = [
        'sapis',
        'kelompok_sapis',
        'mudhohis',
        'sesi_distribusis',
        'mustahiqs',
    ];

    public function up(): void
    {
        $currentYear = date('Y'); // Default tahun saat ini (2026)

        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($currentYear) {
                // Tambahkan field tahun setelah id, set default ke tahun berjalan
                $table->integer('tahun')->default($currentYear)->after('id');

                // Indexing biar pencarian data antar tahun ngebut!
                $table->index('tahun');
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) {
                $table->dropIndex(['tahun']);
                $table->dropColumn('tahun');
            });
        }
    }
};
