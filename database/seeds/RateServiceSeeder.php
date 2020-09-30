<?php

use Illuminate\Database\Seeder;

class RateServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rateService = [
            [
                'en' => [
                    'title' => 'Promptness'
                ],
                'ru' => [
                    'title' => 'Оперативность'
                ],
                'hy' => [
                    'title' => 'Արագություն'
                ]
            ],
            [
                'en' => [
                    'title' => 'Accuracy'
                ],
                'ru' => [
                    'title' => 'Точность'
                ],
                'hy' => [
                    'title' => 'Ճշգրտություն'
                ]
            ],
            [
                'en' => [
                    'title' => 'Customer Service'
                ],
                'ru' => [
                    'title' => 'Обслуживание клиентов'
                ],
                'hy' => [
                    'title' => 'Հաճախորդների սպասարկում'
                ]
            ]
        ];

        foreach ($rateService as $rate) {
            \App\RateService::create($rate);
        }
    }
}
