<?php

use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catalogs = [
            [
                'en' => [
                    'title' => 'Emails'
                ],
                'ru' => [
                    'title' => 'Электронные письма'
                ],
                'hy' => [
                    'title' => 'Էլ. Փոստ'
                ]
            ],
            [
                'en' => [
                    'title' => 'Business Letters'
                ],
                'ru' => [
                    'title' => 'Деловые письма'
                ],
                'hy' => [
                    'title' => 'Բիզնես նամակներ'
                ]
            ],
            [
                'en' => [
                    'title' => 'Business Reports'
                ],
                'ru' => [
                    'title' => 'Бизнес отчеты'
                ],
                'hy' => [
                    'title' => 'Բիզնես հաշվետվություններ'
                ]
            ],
            [
                'en' => [
                    'title' => 'Transactional Documents'
                ],
                'ru' => [
                    'title' => 'Транзакционные документы'
                ],
                'hy' => [
                    'title' => 'Գործարքային փաստաթղթեր'
                ]
            ],
            [
                'en' => [
                    'title' => 'Financial Reports and Documents'
                ],
                'ru' => [
                    'title' => 'Финансовые отчеты и документы'
                ],
                'hy' => [
                    'title' => 'Ֆինանսական հաշվետվություններ և փաստաթղթեր'
                ]
            ]
        ];

        foreach ($catalogs as $catalog) {
            \App\Catalog::create($catalog);
        }
    }
}
