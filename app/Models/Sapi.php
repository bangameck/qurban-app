<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'tahun', 'kode_sapi', 'jenis_sapi', 'berat', 'jenis_kelamin',
    'nama_peternakan', 'path_foto_sapi', 'status_proses', 'waktu_sembelih',
])]
class Sapi extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'waktu_sembelih' => 'datetime',
            'berat' => 'decimal:2',
        ];
    }

    // Relasi ke Kelompok (Akan dibuat di task selanjutnya)
    public function kelompok()
    {
        return $this->hasOne(KelompokSapi::class, 'id_sapi');
    }
}
