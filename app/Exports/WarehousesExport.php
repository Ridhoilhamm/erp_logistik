<?php

namespace App\Exports;

use App\Models\Warehouse;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;


class WarehousesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    public function collection()
    {
        return Warehouse::all();
    }

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

    public function map($warehouse): array
    {
        return [
            $warehouse->id,
            $warehouse->name,
            $warehouse->address,
            $warehouse->phone,
            $warehouse->created_at->format('d-m-Y H:i'),
            $warehouse->updated_at->format('d-m-Y H:i'),
        ];
    }

    // Styling baris headerwar
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFCC9966'],
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF333333'],
                    ],
                ],
            ],
        ];
    }

    // Tambahkan border ke seluruh data
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $dataCount = Warehouse::count() + 1; // +1 untuk heading
                $cellRange = 'A1:F' . $dataCount;

                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF999999'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
