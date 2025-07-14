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
        'product_name' => $this->faker->word,
        'category_id' => 1, // or use a factory for categories
        'image_path' => null,
        'description' => $this->faker->sentence,
        'quantity' => $this->faker->numberBetween(1, 100),
        'price' => $this->faker->randomFloat(2, 10, 1000),
        'user_id' => 1, // or use auth/factory user
    ];

    }




}
