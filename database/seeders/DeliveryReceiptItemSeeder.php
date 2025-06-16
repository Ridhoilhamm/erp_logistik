<?php

namespace Database\Seeders;

use App\Models\DeliveryReceiptItem;
use Illuminate\Database\Seeder;

class DeliveryReceiptItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryReceiptItem::factory()->count(5)->create();
    }
}
