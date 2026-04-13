<?php

namespace App\Imports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class WargaImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $rtId;

    // Terima ID RT dari Livewire
    public function __construct($rtId)
    {
        $this->rtId = $rtId;
    }

    public function model(array $row)
    {
        return new Warga([
            'no_kk' => $row['no_kk'] ?? null,
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'phone_number' => $row['phone_number'] ?? null,
            'alamat' => $row['alamat'],
            'id_rt' => $this->rtId, // Pakai ID yang dipilih di Dropdown
            'jabatan_sosial' => $row['jabatan_sosial'] ?? 'Warga',
        ]);
    }

    public function rules(): array
    {
        return [
            'nik' => 'required|numeric|digits:16|unique:wargas,nik',
            'nama' => 'required|string|max:255',
            'no_kk' => 'nullable|numeric|digits:16',
            'alamat' => 'required|string',
            'phone_number' => 'nullable|string|starts_with:0',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nik.unique' => 'NIK :input sudah ada di database wak!',
            'nik.digits' => 'NIK harus 16 digit!',
            'no_kk.digits' => 'No. KK harus 16 digit!',
        ];
    }
}
