<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->paragraph(1),
            'market_price' => $this->faker->randomFloat(2, 1, 100),
            'price' => $this->faker->randomFloat(2, 2, 500),
            'quantity' => $this->faker->numberBetween(1, 100),
            'image' => null,
            'expiry_date' => $this->faker->date('Y-m-d', now()->addMonths(18)),
            'product_status_id' => $this->faker->randomElement([1, 2, 3, 4, 5, 6, 7, 8]),
            'category_id' => null,
            'brand_id' => null,
        ];
    }
}
