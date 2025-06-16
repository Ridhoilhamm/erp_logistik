<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ProductExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithEvents
{
    /**
     * Mengambil data yang akan diekspor
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Mengambil data produk beserta relasi dengan product_unit dan product_category
        return Product::with(['unit', 'category'])->get();
    }

    /**
     * Menentukan heading untuk kolom Excel
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Produk',
            'SKU',
            'Deskripsi',
            'Unit Produk',
            'Kategori Produk',
            'Harga Beli',
            'Harga Jual',
            'Tanggal Dibuat',
            'Tanggal Diperbarui',
        ];
    }

    /**
     * Menentukan bagaimana data akan dipetakan ke dalam Excel
     *
     * @param Product $product
     * @return array
     */
    public function map($product): array
    {
        return [
            $product->getKey(),
            $product->name,
            $product->sku,
            $product->description,
            $product->unit ? $product->unit->name : 'N/A',
            $product->category ? $product->category->name : 'N/A',
            $product->purchase_price, // Harga Beli
            $product->seliing_price, // Harga Jual
            $product->created_at, // Tanggal Dibuat
            $product->updated_at, // Tanggal Diperbarui
        ];
    }

    /**
     * Styling untuk Excel (mengatur header, font, dan border)
     */
    public function styles($sheet)
    {
        // Styling header
        $sheet->getStyle('A1:J1')->getFont()->setBold(true)->setSize(12);
        $sheet->getStyle('A1:J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00'); // Background kuning
        $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Styling untuk data produk
        $sheet->getStyle('A2:J' . $sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:J' . $sheet->getHighestRow())->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Set font size untuk data
        $sheet->getStyle('A2:J' . $sheet->getHighestRow())->getFont()->setSize(10);
    }

    /**
     * Menentukan lebar kolom
     */
    public function columnWidths(): array
    {
        return [
            'A' => 20,  // ID
            'B' => 30,  // Nama Produk
            'C' => 20,  // SKU
            'D' => 40,  // Deskripsi
            'E' => 20,  // Unit Produk
            'F' => 20,  // Kategori Produk
            'G' => 20,  // Harga Beli
            'H' => 20,  // Harga Jual
            'I' => 25,  // Tanggal Dibuat
            'J' => 25,  // Tanggal Diperbarui
        ];
    }

    /**
     * Menambahkan event untuk styling lebih lanjut setelah sheet selesai dibuat
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Styling header
                $event->sheet->getStyle('A1:J1')->getFont()->setBold(true)->setSize(12);
                $event->sheet->getStyle('A1:J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
                $event->sheet->getStyle('A1:J' . $event->sheet->getHighestRow())->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                $event->sheet->getStyle('A1:J' . $event->sheet->getHighestRow())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
