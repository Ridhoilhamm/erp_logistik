<?php

namespace Database\Seeders;

use App\Models\DeliveryReceipt;
use Illuminate\Database\Seeder;

class DeliveryReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryReceipt::factory()->count(5)->create();
    }
}
