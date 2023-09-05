<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $from = strtotime("01.01.2022");
        $to = strtotime("01.07.2023");
        $currency = [Currency::EUR,Currency::USD];

        return [
            'date' => date("Y-m-d", mt_rand($from, $to)),
            'currency' => fake()->randomElement([Currency::EUR,Currency::USD]),
            'value' => rand(1, 10),
        ];
    }
}
