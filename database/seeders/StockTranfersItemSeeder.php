<?php

namespace Database\Seeders;

use App\Models\StockTranferItem;
use App\Models\StockTranfersItem;
use Illuminate\Database\Seeder;

class StockTranfersItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StockTranferItem::factory()->count(5)->create();
    }
}
