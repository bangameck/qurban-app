<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

#[Fillable([
    'no_kk', 'nik', 'nama', 'phone_number', 'alamat',
    'id_rt', 'jabatan_sosial', 'path_img',
])]
class Warga extends Model
{
    use HasFactory;

    // Relasi dibalik: Warga "memiliki satu" akun User
    public function user()
    {
        return $this->hasOne(User::class, 'id_warga');
    }

    public function rt()
    {
        return $this->belongsTo(Rt::class, 'id_rt');
    }

    public function syncUserAccount()
    {
        // List jabatan yang boleh login (wak bisa tambah sendiri nanti)
        $aksesDashboard = ['RT', 'RW', 'Panitia', 'Admin', 'Super_Admin'];

        if (in_array($this->jabatan_sosial, $aksesDashboard)) {
            // JABATAN AKTIF -> Buat atau Aktifkan User
            User::updateOrCreate(
                ['id_warga' => $this->id],
                [
                    'name' => $this->nama,
                    'email' => $this->nik.'@qurban.app', // Generate Dummy Email
                    'password' => Hash::make($this->nik), // Password default = NIK
                    'status' => true, // Pastikan aktif
                ]
            );
        } else {
            // JABATAN WARGA BIASA -> Nonaktifkan akses login jika pernah punya akun
            User::where('id_warga', $this->id)->update(['status' => false]);
        }
    }
}
