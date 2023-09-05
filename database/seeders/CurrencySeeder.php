<?php

namespace Database\Seeders;

use App\Models\Currency;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $currencies = [Currency::EUR,Currency::USD];
        //$date = $from;
        $date = new DateTime("2022-01-01");
        $dateEnd = new DateTime("2023-07-01");


            while ($date <= $dateEnd) {
                foreach ($currencies as $currency) {
                    Currency::factory()->create([
                        'date' =>  $date->format('Y-m-d'),
                        //'date' =>  date('Y-m-d', strtotime($date)),
                        'currency' => $currency,
                        'value' => rand(10, 100),
                    ]);
                }
                //$date = date('Y-m-d', strtotime($date . ' +1 day'));
                $date->modify('+1 day');
            }


    }
}

