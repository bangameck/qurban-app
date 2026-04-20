<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'tahun', 'jenis', 'kategori', 'nama_barang', 'jumlah',
    'harga_satuan', 'total', 'keterangan',
])]
class Rab extends Model
{
    use HasFactory;
}
