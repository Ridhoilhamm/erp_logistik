<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DeliveryReceipt;
use App\Models\User;

class DeliveryReceiptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeliveryReceipt::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'number' => fake()->regexify('[A-Za-z0-9]{255}'),
            'received_by_id' => User::factory(),
            'repeipt_at' => fake()->dateTime(),
        ];
    }
}
