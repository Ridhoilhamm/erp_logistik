<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\SenderWarehouse;

class SenderWarehouseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SenderWarehouse::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'location' => fake()->regexify('[A-Za-z0-9]{255}'),
            'contact_person' => fake()->regexify('[A-Za-z0-9]{255}'),
            'email' => fake()->safeEmail(),
            'status' => fake()->randomElement(["active","not-active"]),
            'sender_warehouse_at' => fake()->dateTime(),
        ];
    }
}
