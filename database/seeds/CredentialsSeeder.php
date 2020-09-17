<?php

use App\Credentials;
use Illuminate\Database\Seeder;

class CredentialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $credentials = [
            [
                'en' => [
                    'name' => 'Lorem',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'ru' => [
                    'name' => 'Lorem',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'hy' => [
                    'name' => 'Lorem',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ]
            ],
            [
                'en' => [
                    'name' => 'Lorem',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'ru' => [
                    'name' => 'Lorem',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'hy' => [
                    'name' => 'Lorem',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ]
            ],
            [
                'en' => [
                    'name' => 'Lorem',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'ru' => [
                    'name' => 'Lorem',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'hy' => [
                    'name' => 'Lorem',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ]
            ],
            [
                'en' => [
                    'name' => 'Lorem',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'ru' => [
                    'name' => 'Lorem',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ],
                'hy' => [
                    'name' => 'Lorem',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus earum esse maxime, minus nobis similique. Accusantium culpa delectus ea eaque eveniet illum iure laborum maiores.',
                ]
            ]
        ];

        foreach ($credentials as $key => $credential) {
            Credentials::create($credential);
        }
    }
}
