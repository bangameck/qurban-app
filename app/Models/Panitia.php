<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'tahun', 'id_warga', 'jabatan', 'id_kelompok_sapi',
    'kode_unik_kupon', 'path_qr_code', 'status_pengambilan', 'waktu_diambil',
])]
class Panitia extends Model
{
    protected $casts = [
        'waktu_diambil' => 'datetime',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'id_warga');
    }

    public function kelompokSapi()
    {
        return $this->belongsTo(KelompokSapi::class, 'id_kelompok_sapi');
    }
}
