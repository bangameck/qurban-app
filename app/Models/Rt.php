<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['nama_rt', 'id_rw', 'id_pejabat'])]

class Rt extends Model
{
    use HasFactory;

    public function rw()
    {
        return $this->belongsTo(Rw::class, 'id_rw');
    }

    public function pejabat()
    {
        return $this->belongsTo(Warga::class, 'id_pejabat');
    }

    public function wargas()
    {
        return $this->hasMany(Warga::class, 'id_rt');
    }
}
