<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductUnit;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'sku' => fake()->regexify('[A-Za-z0-9]{255}'),
            'description' => fake()->text(),
            'product_unit_id' => ProductUnit::factory(),
            'product_category_id' => ProductCategory::factory(),
            'purchase_price' => fake()->randomFloat(0, 0, 9999999999.),
            'seliing_price' => fake()->randomFloat(0, 0, 9999999999.),
        ];
    }
}
