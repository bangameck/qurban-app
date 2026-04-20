<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'tahun', 'id_warga', 'id_kelompok_sapi', 'id_panitia', 'tipe_qurban', 'path_bukti_pendaftaran', 'kode_unik_kupon', 'path_qr_code', 'status_pengambilan',
    'waktu_diambil',
])]
class Mudhohi extends Model
{
    use HasFactory;

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

    public function panitia()
    {
        return $this->belongsTo(User::class, 'id_panitia');
    }
}
