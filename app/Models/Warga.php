<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user', 'no_kk', 'nik', 'nama', 'phone_number', 'alamat',
        'id_rt', 'jabatan_sosial', 'path_img',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'id_rt');
    }
}
