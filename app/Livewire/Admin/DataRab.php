<?php

namespace App\Livewire\Admin;

use App\Models\AppSetting;
use App\Models\Rab;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Lazy]
#[Title('Rencana Anggaran Belanja (RAB)')]
class DataRab extends Component
{
    public $tahun_aktif;

    public function placeholder()
    {
        return view('components.skeleton._rab');
    }

    // Array untuk menampung baris inputan (seperti Excel)
    public $rows = [];

    public function mount()
    {
        $this->tahun_aktif = AppSetting::where('key', 'tahun')->first()?->value ?? date('Y');
        $this->loadData();
    }

    public function loadData()
    {
        // Tarik data dari DB, ubah ke array untuk di-binding ke Form
        $this->rows = Rab::where('tahun', $this->tahun_aktif)->get()->toArray();

        // Kasih 1 baris kosong kalau datanya murni belum ada
        if (empty($this->rows)) {
            $this->addRow();
        }
    }

    public function addRow()
    {
        $this->rows[] = [
            'id' => null,
            'jenis' => 'Pengeluaran', // Default
            'kategori' => '',
            'nama_barang' => '',
            'jumlah' => 1,
            'harga_satuan' => 0,
            'total' => 0,
            'keterangan' => '',
        ];
    }

    public function removeRow($index)
    {
        // Kalau id-nya ada, berarti data dari DB, kita hapus beneran
        if (! empty($this->rows[$index]['id'])) {
            Rab::find($this->rows[$index]['id'])->delete();
        }

        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // Re-index array
        $this->dispatch('notify-success', 'Baris dihapus!');
    }

    // Fungsi otomatis hitung total per baris dan AUTO SAVE
    public function updated($propertyName)
    {
        if (preg_match('/rows\.(\d+)\.(.+)/', $propertyName, $matches)) {
            $index = $matches[1];
            $field = $matches[2];

            if ($field == 'jumlah' || $field == 'harga_satuan') {
                $qty = (float) ($this->rows[$index]['jumlah'] ?? 0);
                $harga = (float) ($this->rows[$index]['harga_satuan'] ?? 0);
                $this->rows[$index]['total'] = $qty * $harga;
            }

            $this->autoSaveRow($index);
        }
    }

    public function autoSaveRow($index)
    {
        $row = $this->rows[$index] ?? null;
        if (! $row) {
            return;
        }

        // Hanya simpan jika nama barang ada (mandatory untuk database tabel Rab)
        if (! empty($row['nama_barang'])) {
            $rab = Rab::updateOrCreate(
                ['id' => $row['id']],
                [
                    'tahun' => $this->tahun_aktif,
                    'jenis' => $row['jenis'],
                    'kategori' => $row['kategori'] ?? '',
                    'nama_barang' => $row['nama_barang'],
                    'jumlah' => $row['jumlah'] ?? 1,
                    'harga_satuan' => $row['harga_satuan'] ?? 0,
                    'total' => ($row['jumlah'] ?? 1) * ($row['harga_satuan'] ?? 0),
                    'keterangan' => $row['keterangan'] ?? '',
                ]
            );

            // Update ID biar next autosave jadi proses update, bukan insert
            $this->rows[$index]['id'] = $rab->id;
            $this->rows[$index]['total'] = $rab->total;

            // Trigger notifikasi per baris di frontend
            $this->dispatch('row-saved', index: $index);
        }
    }

    public function render()
    {
        usleep(200000);
        // Hitung Summary buat di Header
        $totalPemasukan = collect($this->rows)->where('jenis', 'Pemasukan')->sum('total');
        $totalPengeluaran = collect($this->rows)->where('jenis', 'Pengeluaran')->sum('total');
        $sisaDana = $totalPemasukan - $totalPengeluaran;

        return view('livewire.admin.data-rab', [
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'sisaDana' => $sisaDana,
        ])->title('Rencana Anggaran Belanja (RAB)');
    }
}
