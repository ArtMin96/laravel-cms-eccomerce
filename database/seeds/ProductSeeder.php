<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'en' => [
                    'title' => 'Product 1',
                ],
                'ru' => [
                    'title' => 'Product 1',
                ],
                'hy' => [
                    'title' => 'Product 1',
                ],
                'sale_type_id' => 1,
                'language' => 1,
                'price' => 1000,
            ],
            [
                'en' => [
                    'title' => 'Product 2',
                ],
                'ru' => [
                    'title' => 'Product 2',
                ],
                'hy' => [
                    'title' => 'Product 2',
                ],
                'sale_type_id' => 1,
                'language' => 2,
                'price' => 1000,
            ],
            [
                'en' => [
                    'title' => 'Product 3',
                ],
                'ru' => [
                    'title' => 'Product 3',
                ],
                'hy' => [
                    'title' => 'Product 3',
                ],
                'sale_type_id' => 3,
                'language' => 3,
                'price' => 1500,
            ],
            [
                'en' => [
                    'title' => 'Product 4',
                ],
                'ru' => [
                    'title' => 'Product 4',
                ],
                'hy' => [
                    'title' => 'Product 4',
                ],
                'sale_type_id' => 3,
                'language' => 1,
                'price' => 2800,
            ],
            [
                'en' => [
                    'title' => 'Product 5',
                ],
                'ru' => [
                    'title' => 'Product 5',
                ],
                'hy' => [
                    'title' => 'Product 5',
                ],
                'sale_type_id' => 3,
                'language' => 2,
                'price' => 1800,
            ],
            [
                'en' => [
                    'title' => 'Product 6',
                ],
                'ru' => [
                    'title' => 'Product 6',
                ],
                'hy' => [
                    'title' => 'Product 6',
                ],
                'sale_type_id' => 1,
                'language' => 3,
                'price' => 3500,
            ],
            [
                'en' => [
                    'title' => 'Product 7',
                ],
                'ru' => [
                    'title' => 'Product 7',
                ],
                'hy' => [
                    'title' => 'Product 7',
                ],
                'sale_type_id' => 1,
                'language' => 3,
                'price' => 3000,
            ],
            [
                'en' => [
                    'title' => 'Product 8',
                ],
                'ru' => [
                    'title' => 'Product 8',
                ],
                'hy' => [
                    'title' => 'Product 8',
                ],
                'sale_type_id' => 1,
                'language' => 3,
                'price' => 2000,
            ],
            [
                'en' => [
                    'title' => 'Product 9',
                ],
                'ru' => [
                    'title' => 'Product 9',
                ],
                'hy' => [
                    'title' => 'Product 9',
                ],
                'sale_type_id' => 1,
                'language' => 3,
                'price' => 2000,
            ],
            [
                'en' => [
                    'title' => 'Product 10',
                ],
                'ru' => [
                    'title' => 'Product 10',
                ],
                'hy' => [
                    'title' => 'Product 10',
                ],
                'sale_type_id' => 1,
                'language' => 2,
                'price' => 2000,
            ],
            [
                'en' => [
                    'title' => 'Product 11',
                ],
                'ru' => [
                    'title' => 'Product 11',
                ],
                'hy' => [
                    'title' => 'Product 11',
                ],
                'sale_type_id' => 1,
                'language' => 1,
                'price' => 2000,
            ],
            [
                'en' => [
                    'title' => 'Product 12',
                ],
                'ru' => [
                    'title' => 'Product 12',
                ],
                'hy' => [
                    'title' => 'Product 12',
                ],
                'sale_type_id' => 1,
                'language' => 3,
                'price' => 2000,
            ],
            [
                'en' => [
                    'title' => 'Product 13',
                ],
                'ru' => [
                    'title' => 'Product 13',
                ],
                'hy' => [
                    'title' => 'Product 13',
                ],
                'sale_type_id' => 1,
                'language' => 3,
                'price' => 2000,
            ],
            [
                'en' => [
                    'title' => 'Product 14',
                ],
                'ru' => [
                    'title' => 'Product 14',
                ],
                'hy' => [
                    'title' => 'Product 14',
                ],
                'sale_type_id' => 1,
                'language' => 1,
                'price' => 2000,
            ],
            [
                'en' => [
                    'title' => 'Product 15',
                ],
                'ru' => [
                    'title' => 'Product 15',
                ],
                'hy' => [
                    'title' => 'Product 15',
                ],
                'sale_type_id' => 1,
                'language' => 3,
                'price' => 2000,
            ],
            [
                'en' => [
                    'title' => 'Product 16',
                ],
                'ru' => [
                    'title' => 'Product 16',
                ],
                'hy' => [
                    'title' => 'Product 16',
                ],
                'sale_type_id' => 1,
                'language' => 3,
                'price' => 2000,
            ],
            [
                'en' => [
                    'title' => 'Product 17',
                ],
                'ru' => [
                    'title' => 'Product 17',
                ],
                'hy' => [
                    'title' => 'Product 17',
                ],
                'sale_type_id' => 1,
                'language' => 1,
                'price' => 2000,
            ],
        ];

        foreach ($products as $key => $product) {
            \App\Product::create($product);
        }
    }
}
