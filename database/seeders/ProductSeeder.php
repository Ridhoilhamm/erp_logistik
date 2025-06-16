<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductUnit;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        $datas = [
            [
                'name' => 'Kopi Arabika',
                'sku' => 'SKU-001',
                'description' => 'Kopi Arabika berkualitas tinggi',
                'purchase_price' => 25000,
                'seliing_price' => 35000,
            ],
            [
                'name' => 'Teh Hijau',
                'sku' => 'SKU-002',
                'description' => 'Teh hijau segar dari pegunungan',
                'purchase_price' => 15000,
                'seliing_price' => 22000,
            ],
            [
                'name' => 'Gula Aren',
                'sku' => 'SKU-003',
                'description' => 'Gula aren asli tanpa campuran',
                'purchase_price' => 12000,
                'seliing_price' => 18000,
            ],
            [
                'name' => 'Susu Kental Manis',
                'sku' => 'SKU-004',
                'description' => 'Susu kental manis premium',
                'purchase_price' => 10000,
                'seliing_price' => 16000,
            ],
            [
                'name' => 'Cokelat Bubuk',
                'sku' => 'SKU-005',
                'description' => 'Cokelat bubuk murni 100%',
                'purchase_price' => 20000,
                'seliing_price' => 28000,
            ],
            [
                'name' => 'Sirup Vanila',
                'sku' => 'SKU-006',
                'description' => 'Sirup rasa vanila untuk minuman',
                'purchase_price' => 18000,
                'seliing_price' => 25000,
            ],
            [
                'name' => 'Espresso Blend',
                'sku' => 'SKU-007',
                'description' => 'Campuran kopi untuk espresso',
                'purchase_price' => 27000,
                'seliing_price' => 37000,
            ],
            [
                'name' => 'Matcha Powder',
                'sku' => 'SKU-008',
                'description' => 'Bubuk matcha asli Jepang',
                'purchase_price' => 30000,
                'seliing_price' => 42000,
            ],
            [
                'name' => 'Whipped Cream',
                'sku' => 'SKU-009',
                'description' => 'Krim kocok untuk topping minuman',
                'purchase_price' => 12000,
                'seliing_price' => 18000,
            ],
            [
                'name' => 'Kopi Robusta',
                'sku' => 'SKU-010',
                'description' => 'Kopi robusta untuk cold brew',
                'purchase_price' => 22000,
                'seliing_price' => 30000,
            ],
        ];
        $product_units = ProductUnit::pluck('id')->toArray();
        $product_categories = ProductCategory::pluck('id')->toArray();
        foreach ($datas as $data) {
            Product::create([
                'name' => $data['name'],
                'sku' => $data['sku'],
                'description' => $data['description'],
                'purchase_price' => $data['purchase_price'],
                'seliing_price' => $data['seliing_price'],
                'product_unit_id' => $faker->randomElement($product_units),
                'product_category_id' => $faker->randomElement($product_categories),
            ]);
        }
    }
}
