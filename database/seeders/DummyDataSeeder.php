<?php

namespace Database\Seeders;

use App\Models\KelompokSapi;
use App\Models\Mustahiq;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Sapi;
use App\Models\SesiDistribusi;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat RW & RT
        $rw = Rw::create([
            'nama_rw' => '01',
            'kelurahan' => 'Sukamaju',
            'kecamatan' => 'Sukaramai',
        ]);

        $rt = Rt::create([
            'nama_rt' => '03',
            'id_rw' => $rw->id,
        ]);

        // 2. Buat Warga
        $warga1 = Warga::create([
            'nik' => '1471000000000001',
            'nama' => 'Bapak Budi',
            'phone_number' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 1',
            'id_rt' => $rt->id,
            'jabatan_sosial' => 'Warga',
        ]);

        // 3. Buat Sapi & Kelompok
        $sapi = Sapi::create([
            'kode_sapi' => 'SP-001',
            'jenis_sapi' => 'Limousin',
            'berat' => 350.50,
            'jenis_kelamin' => 'Jantan',
            'status_proses' => 'Menunggu',
        ]);

        KelompokSapi::create([
            'nama_kelompok' => 'Kelompok Abu Bakar',
            'id_sapi' => $sapi->id,
        ]);

        // 4. Buat Sesi Distribusi & Mustahiq
        $sesi = SesiDistribusi::create([
            'nama_sesi' => 'Sesi 1 (Ba\'da Dzuhur)',
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '14:00:00',
            'kuota_maksimal' => 50,
        ]);

        Mustahiq::create([
            'id_warga' => $warga1->id,
            'id_sesi_distribusi' => $sesi->id,
            'kategori_penerima' => 'Mustahiq',
            'kode_unik_kupon' => strtoupper(Str::random(6)),
            'status_pengambilan' => 'Belum',
        ]);
    }
}
