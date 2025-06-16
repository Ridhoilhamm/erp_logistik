<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DeliveryReceipt;
use App\Models\DeliveryReceiptItem;
use App\Models\Product;

class DeliveryReceiptItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeliveryReceiptItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'delivery_receipt_id' => DeliveryReceipt::factory(),
            'product_id' => Product::factory(),
            'quantity' => fake()->word(),
        ];
    }
}
