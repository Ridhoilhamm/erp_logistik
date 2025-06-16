<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;

class ProductImport implements ToCollection
{
    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        // Skip header baris pertama
        $rows->skip(1)->each(function ($row) {
            Product::create([
                'id'                  => Str::uuid(),
                'name'                => $row[0],
                'sku'                 => $row[1],
                'description'         => $row[2],
                'product_unit_id'     => $row[3],
                'product_category_id' => $row[4],
                'purchase_price'      => $row[5],
                'seliing_price'       => $row[6],
            ]);
        });
    }
}
