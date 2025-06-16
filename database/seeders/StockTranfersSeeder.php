<?php

namespace Database\Seeders;

use App\Models\StockTranfer;
use Illuminate\Database\Seeder;

class StockTranfersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StockTranfer::factory()->count(5)->create();
    }
}
