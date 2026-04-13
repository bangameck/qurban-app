<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokSapi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelompok', 'id_sapi'];

    public function sapi()
    {
        return $this->belongsTo(Sapi::class, 'id_sapi');
    }

    public function mudhohis()
    {
        return $this->hasMany(Mudhohi::class, 'id_kelompok_sapi');
    }
}
