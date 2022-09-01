<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
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
        $randomNumber = $this->faker->randomDigit();
        $name = $this->faker->words(2, true) . $randomNumber;

        return [
            'name' => $name,
            'slug' => str::slug($name),
            'price' => $this->faker->randomFloat(2, 50, 1000),
            'description' => $this->faker->text,
            'status' => $this->faker->numberBetween(0, 1),
        ];
    }
}
