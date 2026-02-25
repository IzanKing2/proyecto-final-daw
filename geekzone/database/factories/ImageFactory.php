<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define los datos falsos para una imagen.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url_path'   => fake()->imageUrl(640, 480, 'products'),
            'is_main'    => false,
            'product_id' => Product::inRandomOrder()->first()->id
        ];
    }

    /**
     * Estado: marca la imagen como principal.
     */
    public function main(): static
    {
        return $this->state(fn () => [
            'is_main' => true,
        ]);
    }
}
