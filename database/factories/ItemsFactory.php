<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Items>
 */
class ItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'name' => fake()->text(30),
            'category' => rand(1, 10),
            'price' => rand(1, 10000),
            'currency' => fake()->randomElement([Currency::EUR,Currency::USD]),
        ];
    }

}
