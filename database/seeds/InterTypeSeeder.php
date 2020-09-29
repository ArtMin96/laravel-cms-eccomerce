<?php

use Illuminate\Database\Seeder;

class InterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interpretationType = [
            [
                'en' => [
                    'name' => 'Simultaneous'
                ],
                'ru' => [
                    'name' => 'Одновременный'
                ],
                'hy' => [
                    'name' => 'Միաժամանակյա'
                ]
            ],
            [
                'en' => [
                    'name' => 'Consecutive'
                ],
                'ru' => [
                    'name' => 'Последовательный'
                ],
                'hy' => [
                    'name' => 'Հաջորդական'
                ]
            ],
            [
                'en' => [
                    'name' => 'Court interpretation'
                ],
                'ru' => [
                    'name' => 'Толкование суда'
                ],
                'hy' => [
                    'name' => 'Դատարանի մեկնաբանությունը'
                ]
            ],
            [
                'en' => [
                    'name' => 'Sign interpretation'
                ],
                'ru' => [
                    'name' => 'Толкование знаков'
                ],
                'hy' => [
                    'name' => 'Նշանի մեկնաբանությունը'
                ]
            ]
        ];

        foreach ($interpretationType as $type) {
            \App\InterType::create($type);
        }
    }
}
