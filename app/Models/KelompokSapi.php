<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['tahun', 'nama_kelompok', 'id_sapi'])]
class KelompokSapi extends Model
{
    use HasFactory;

    // Relasi ke Sapi (1 Kelompok punya 1 Sapi)
    public function sapi()
    {
        return $this->belongsTo(Sapi::class, 'id_sapi');
    }

    // Relasi ke Mudhohi (1 Kelompok punya banyak Mudhohi - Max 7)
    public function mudhohis()
    {
        return $this->hasMany(Mudhohi::class, 'id_kelompok_sapi');
    }

    public function ketuaPanitia()
    {
        return $this->hasOne(Panitia::class, 'id_kelompok_sapi')
            ->where('jabatan', 'Ketua Kelompok Qurban');
    }

    // Jika sampeyan ingin tetap menggunakan nama "pejabat" agar tidak merubah banyak code:
    public function pejabat()
    {
        // Kita ambil data warganya melalui panitia tersebut
        return $this->hasOneThrough(
            Warga::class,
            Panitia::class,
            'id_kelompok_sapi', // Foreign key di tabel panitias
            'id',               // Foreign key di tabel wargas
            'id',               // Local key di tabel kelompok_sapis
            'id_warga'          // Local key di tabel panitias
        )->where('panitias.jabatan', 'Ketua Kelompok Qurban');
    }
}
