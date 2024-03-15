<?php

namespace Database\Factories;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartUser>
 */
class CartUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'product_id' => fake()->randomElement([1, 2, 3, 4, 5]),
            'quantity' => fake()->randomNumber(2),
        ];
    }
}
