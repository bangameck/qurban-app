<?php

namespace Database\Seeders;

use App\Models\KelompokSapi;
use App\Models\Mustahiq;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Sapi;
use App\Models\SesiDistribusi;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. DATA MASTER WARGA
        // ==========================================

        // Warga Spesial: Admin (Radevanka)
        $wargaAdmin = Warga::create([
            'no_kk' => '1471000000000000',
            'nik' => '1471000000000000',
            'nama' => 'Radevanka',
            'phone_number' => '080000000000',
            'alamat' => 'Markas Qurban App',
            'jabatan_sosial' => 'Super_Admin', // Nanti ditambah 'Panitia' di form
        ]);

        // Panggil fungsi sinkronisasi (Otomatis bikin User dengan email: 1471000000000000@qurban.app)
        $wargaAdmin->syncUserAccount();

        // Ambil User yang baru terbuat, lalu update datanya biar sesuai dengan data asli sampeyan
        $userAdmin = User::where('id_warga', $wargaAdmin->id)->first();
        if ($userAdmin) {
            $userAdmin->update([
                'email' => 'admin@qurbanapp.com', // Timpa dummy email jadi email asli
                'password' => bcrypt('password123'), // Set password asli
            ]);
            // Beri mahkota superadmin!
            $userAdmin->assignRole('superadmin');
        }

        // Warga Biasa & Pejabat
        $wargaRw = Warga::create([
            'no_kk' => '1471000000000001',
            'nik' => '1471000000000001',
            'nama' => 'Bapak Budi (Ketua RW)',
            'phone_number' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 1',
            'jabatan_sosial' => 'RW',
        ]);
        $wargaRw->syncUserAccount();

        $wargaRt = Warga::create([
            'no_kk' => '1234567890123456',
            'nik' => '3201010101010001',
            'nama' => 'Budi Santoso (Ketua RT)',
            'phone_number' => '081234567891',
            'alamat' => 'Jl. Melati No. 12, Pekanbaru',
            'jabatan_sosial' => 'RT',
        ]);
        $wargaRt->syncUserAccount();

        $wargaBiasa = Warga::create([
            'no_kk' => '1234567890123456',
            'nik' => '3201010101010002',
            'nama' => 'Siti Aminah',
            'phone_number' => '082198765432',
            'alamat' => 'Jl. Mawar No. 5, Pekanbaru',
            'jabatan_sosial' => 'Warga',
        ]);

        // ==========================================
        // 2. DATA WILAYAH (RW & RT)
        // ==========================================
        $rw = Rw::create([
            'nama_rw' => '01',
            'kelurahan' => 'Tangkerang Timur',
            'kecamatan' => 'Tenayan Raya',
            'id_pejabat' => $wargaRw->id, // Pasang jabatannya
        ]);

        $rt = Rt::create([
            'nama_rt' => '03',
            'id_rw' => $rw->id,
            'id_pejabat' => $wargaRt->id, // Pasang jabatannya
        ]);

        // Update Warga agar masuk ke RT tersebut
        $wargaRw->update(['id_rt' => $rt->id]);
        $wargaRt->update(['id_rt' => $rt->id]);
        $wargaBiasa->update(['id_rt' => $rt->id]);

        // ==========================================
        // 3. DATA HEWAN & DISTRIBUSI
        // ==========================================
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

        $sesi = SesiDistribusi::create([
            'nama_sesi' => 'Sesi 1 (Ba\'da Dzuhur)',
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '14:00:00',
            'kuota_maksimal' => 50,
        ]);

        Mustahiq::create([
            'id_warga' => $wargaBiasa->id,
            'id_sesi_distribusi' => $sesi->id,
            'kategori_penerima' => 'Mustahiq',
            'kode_unik_kupon' => strtoupper(Str::random(6)),
            'status_pengambilan' => 'Belum',
        ]);
    }
}
