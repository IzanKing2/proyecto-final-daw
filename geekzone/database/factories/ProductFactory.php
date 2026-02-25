<?php

namespace Database\Factories;

use App\Models\Collection;
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
            'name'          => fake()->words(3, true),
            'description'   => fake()->paragraph(),
            'price'         => fake()->randomFloat(2, 9.99, 299.99),
            'stock'         => fake()->numberBetween(0, 100),
            'featured'      => fake()->boolean(20), // 20% featured
            'height'        => fake()->randomFloat(1, 5, 30),
            'width'         => fake()->randomFloat(1, 5, 20),
            'release_date'  => fake()->dateTimeBetween('-2 years', 'now'),
            'collection_id' => Collection::inRandomOrder()->first()->id
        ];
    }
}
