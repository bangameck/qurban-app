<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'tahun', 'nama_sesi', 'jam_mulai', 'jam_selesai', 'kuota_maksimal',
])]

class SesiDistribusi extends Model
{
    use HasFactory;

    public function mustahiqs()
    {
        return $this->hasMany(Mustahiq::class, 'id_sesi_distribusi');
    }
}
