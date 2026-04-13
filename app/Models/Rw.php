<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama_rw', 'id_pejabat', 'kelurahan', 'kecamatan'])]
class Rw extends Model
{
    use HasFactory;

    public function pejabat()
    {
        return $this->belongsTo(Warga::class, 'id_pejabat');
    }

    public function rts()
    {
        return $this->hasMany(Rt::class, 'id_rw');
    }
}
