<?php

namespace App\Exports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StockProduct implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        // Ambil data stok beserta relasinya
        return Stock::with(['product', 'warehouse'])->get();
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Nama Gudang',
            'Jumlah Stok',
            'Tanggal Diperbarui',
        ];
    }

    public function map($stock): array
    {
        return [
            $stock->product->name ?? '-',
            $stock->warehouse->name ?? '-',
            $stock->stock,
            $stock->updated_at->format('d-m-Y H:i'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Header tebal
        ];
    }
}
