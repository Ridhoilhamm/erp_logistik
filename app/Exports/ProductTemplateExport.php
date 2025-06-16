<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductTemplateExport implements FromCollection
{
    public function collection()
    {
        return new Collection([
            [
                'name',
                'sku',
                'description',
                'product_unit_id',
                'product_category_id',
                'purchase_price',
                'seliing_price', // mengikuti typo di migration
            ],
        ]);
    }
}
