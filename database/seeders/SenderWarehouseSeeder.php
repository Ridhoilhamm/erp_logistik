<?php

namespace Database\Seeders;

use App\Models\SenderWarehouse;
use Illuminate\Database\Seeder;

class SenderWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SenderWarehouse::factory()->count(5)->create();
    }
}
