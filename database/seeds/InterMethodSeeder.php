<?php

use Illuminate\Database\Seeder;

class InterMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interpretationMethod = [
            [
                'en' => [
                    'name' => 'In person'
                ],
                'ru' => [
                    'name' => 'Лично'
                ],
                'hy' => [
                    'name' => 'Անձամբ'
                ]
            ],
            [
                'en' => [
                    'name' => 'Over the phone'
                ],
                'ru' => [
                    'name' => 'По телефону'
                ],
                'hy' => [
                    'name' => 'Հեռախոսով'
                ]
            ],
            [
                'en' => [
                    'name' => 'Video Remote Interpreting (VRI)'
                ],
                'ru' => [
                    'name' => 'Удаленный перевод видео (VRI)'
                ],
                'hy' => [
                    'name' => 'Վիդեո հեռակա մեկնաբանություն (VRI)'
                ]
            ]
        ];

        foreach ($interpretationMethod as $type) {
            \App\InterMethod::create($type);
        }
    }
}
