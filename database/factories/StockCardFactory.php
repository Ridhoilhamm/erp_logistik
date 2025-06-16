<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\StockCard;
use App\Models\User;
use App\Models\Warehouse;

class StockCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockCard::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'warehouse_id' => Warehouse::factory(),
            'type' => fake()->word(),
            'user_id' => User::factory(),
            'price' => fake()->randomFloat(0, 0, 9999999999.),
            'sub_total_price' => fake()->randomFloat(0, 0, 9999999999.),
        ];
    }
}
