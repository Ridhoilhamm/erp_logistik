<?php

namespace Database\Seeders;

use App\Models\RecipientWarehouse;
use App\Models\StockTranfer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductUnitSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            WarehouseSeeder::class,
            StockSeeder::class,
            StockCardSeeder::class,
            SupplierSeeder::class,
            SenderWarehouseSeeder::class,
            RecipientWarehouseSeeder::class,
            StockTranfersSeeder::class,
        ]);
    }
}
