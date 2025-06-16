<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WarehousesTemplateExport implements FromArray, WithHeadings
{
    /**
     * Return empty array to only export headings
     */
    public function array(): array
    {
        return [];
    }

    /**
     * Define the headings for the Excel file
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Gudang',
            'Alamat',
            'No. Telepon',
            'Dibuat Pada',
            'Diperbarui Pada'
        ];
    }
}
