<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiDistribusi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sesi', 'jam_mulai', 'jam_selesai', 'kuota_maksimal',
    ];

    public function mustahiqs()
    {
        return $this->hasMany(Mustahiq::class, 'id_sesi_distribusi');
    }
}
