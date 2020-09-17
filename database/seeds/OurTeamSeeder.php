<?php

use App\OurTeam;
use Illuminate\Database\Seeder;

class OurTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ourTeam = [
            [
                'en' => [
                    'name' => 'Lorem',
                    'last_name' => 'Ipsum',
                    'position' => 'Interpreter',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'ru' => [
                    'name' => 'Lorem',
                    'last_name' => 'Ipsum',
                    'position' => 'Interpreter',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'hy' => [
                    'name' => 'Lorem',
                    'last_name' => 'Ipsum',
                    'position' => 'Interpreter',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ]
            ],
            [
                'en' => [
                    'name' => 'Lorem',
                    'last_name' => 'Ipsum',
                    'position' => 'Interpreter',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'ru' => [
                    'name' => 'Lorem',
                    'last_name' => 'Ipsum',
                    'position' => 'Interpreter',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'hy' => [
                    'name' => 'Lorem',
                    'last_name' => 'Ipsum',
                    'position' => 'Interpreter',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ]
            ],
            [
                'en' => [
                    'name' => 'Lorem',
                    'last_name' => 'Ipsum',
                    'position' => 'Interpreter',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'ru' => [
                    'name' => 'Lorem',
                    'last_name' => 'Ipsum',
                    'position' => 'Interpreter',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'hy' => [
                    'name' => 'Lorem',
                    'last_name' => 'Ipsum',
                    'position' => 'Interpreter',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ]
            ],
            [
                'en' => [
                    'name' => 'Lorem',
                    'last_name' => 'Ipsum',
                    'position' => 'Interpreter',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'ru' => [
                    'name' => 'Lorem',
                    'last_name' => 'Ipsum',
                    'position' => 'Interpreter',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'hy' => [
                    'name' => 'Lorem',
                    'last_name' => 'Ipsum',
                    'position' => 'Interpreter',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ]
            ]
        ];

        foreach ($ourTeam as $key => $team) {
            OurTeam::create($team);
        }
    }
}
