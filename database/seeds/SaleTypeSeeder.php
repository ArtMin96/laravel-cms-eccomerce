<?php

use Illuminate\Database\Seeder;

class SaleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $saleType = [
            [
                'en' => [
                    'name' => 'Document'
                ],
                'ru' => [
                    'name' => 'Документ'
                ],
                'hy' => [
                    'name' => 'Փաստաթուղթ'
                ]
            ],
            [
                'en' => [
                    'name' => 'Fillable document'
                ],
                'ru' => [
                    'name' => 'Заполняемый документ'
                ],
                'hy' => [
                    'name' => 'Լրացման փաստաթուղթ'
                ]
            ],
            [
                'en' => [
                    'name' => 'Rent equipment'
                ],
                'ru' => [
                    'name' => 'Аренда оборудования'
                ],
                'hy' => [
                    'name' => 'Տեխնիկայի վարձույթ'
                ]
            ]
        ];

        foreach ($saleType as $type) {
            \App\SaleType::create($type);
        }
    }
}
