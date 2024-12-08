<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * Proses setiap baris dalam file Excel dan simpan ke model User.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        Log::info('Header data: ', $row); 
        return new User([
            'name' => $row['name'], // Kolom "name" di file Excel
            'nik' => $row['nik'], // Kolom "nik" di file Excel
            'alamat' => $row['alamat'], // Kolom "alamat" di file Excel
            'grupPelanggan' => $row['gruppelanggan'], // Kolom "grupPelanggan" di file Excel
        ]);
    }
}
