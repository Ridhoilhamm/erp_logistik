<?php

namespace Database\Seeders;

use App\Models\RecipientWarehouse;
use Illuminate\Database\Seeder;

class RecipientWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecipientWarehouse::factory()->count(5)->create();
    }
}
