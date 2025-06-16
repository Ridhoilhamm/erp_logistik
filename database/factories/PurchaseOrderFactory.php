<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\Warehouse;

class PurchaseOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PurchaseOrder::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'number' => fake()->regexify('[A-Za-z0-9]{255}'),
            'suppelier_id' => Supplier::factory(),
            'purchase_at' => fake()->dateTime(),
            'warehouse_id' => Warehouse::factory(),
            'status' => fake()->randomElement(["draft","ordered","sent","receipt"]),
        ];
    }
}
