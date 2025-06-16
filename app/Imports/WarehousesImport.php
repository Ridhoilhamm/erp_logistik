<?php

namespace App\Imports;

use App\Models\Warehouse;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WarehousesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // Debug dulu isinya
        // dd($rows);
        foreach ($rows as $row) {
            Warehouse::create([
                'name' => $row['nama_gudang'],
                'address' => Arr::get($row, 'alamat', 'halo'),
                'phone' => $row['no_telepon'],
            ]);
        }
    }
}
