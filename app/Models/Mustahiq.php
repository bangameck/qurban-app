<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mustahiq extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_warga', 'id_sesi_distribusi', 'kategori_penerima',
        'kode_unik_kupon', 'path_qr_code', 'status_pengambilan',
        'waktu_diambil', 'id_panitia_scanner',
    ];

    protected $casts = [
        'waktu_diambil' => 'datetime',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'id_warga');
    }

    public function sesiDistribusi()
    {
        return $this->belongsTo(SesiDistribusi::class, 'id_sesi_distribusi');
    }

    public function panitiaScanner()
    {
        return $this->belongsTo(User::class, 'id_panitia_scanner');
    }
}
