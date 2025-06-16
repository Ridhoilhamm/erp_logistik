<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Supplier;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'address' => fake()->regexify('[A-Za-z0-9]{255}'),
            'office_number' => fake()->regexify('[A-Za-z0-9]{255}'),
            'representative_name' => fake()->regexify('[A-Za-z0-9]{255}'),
            'representative_phone' => fake()->word(),
            'email' => fake()->safeEmail(),
            'city' => fake()->city(),
        ];
    }
}
