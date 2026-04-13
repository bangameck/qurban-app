<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mudhohi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_warga', 'id_kelompok_sapi', 'id_panitia', 'tipe_qurban',
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
