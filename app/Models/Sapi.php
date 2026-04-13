<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sapi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_sapi', 'jenis_sapi', 'berat', 'jenis_kelamin',
        'nama_peternakan', 'path_foto_sapi', 'status_proses', 'waktu_sembelih',
    ];

    protected $casts = [
        'waktu_sembelih' => 'datetime',
    ];

    public function kelompokSapi()
    {
        return $this->hasOne(KelompokSapi::class, 'id_sapi');
    }
}
