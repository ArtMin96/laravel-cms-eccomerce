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
                'price' => 3500,
            ],
        ];

        foreach ($products as $key => $product) {
            \App\Product::create($product);
        }
    }
}
