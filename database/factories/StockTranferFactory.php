<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\RecipientWarehouse;
use App\Models\SenderWarehouse;
use App\Models\StockTranfer;
use App\Models\User;

class StockTranferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockTranfer::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'number' => fake()->regexify('[A-Za-z0-9]{255}'),
            'sender_warehouse_id' => SenderWarehouse::factory(),
            'recipient_warehouse_id' => RecipientWarehouse::factory(),
            'made_by_id' => User::factory(),
            'status' => fake()->randomElement(["draft","sent","received"]),
        ];
    }
}
