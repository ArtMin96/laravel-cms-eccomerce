<?php

use Illuminate\Database\Seeder;

class DocumentLanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $langs = [
            [
                'en' => [
                    'name' => 'English',
                ],
                'ru' => [
                    'name' => 'Английский',
                ],
                'hy' => [
                    'name' => 'Անգլերեն',
                ],
            ],
            [
                'en' => [
                    'name' => 'Russian',
                ],
                'ru' => [
                    'name' => 'Русский',
                ],
                'hy' => [
                    'name' => 'Ռուսերեն',
                ],
            ],
            [
                'en' => [
                    'name' => 'Armenian',
                ],
                'ru' => [
                    'name' => 'Армянский',
                ],
                'hy' => [
                    'name' => 'Հայերեն',
                ],
            ],
        ];

        foreach ($langs as $key => $lang) {
            \App\DocumentLanguages::create($lang);
        }
    }
}
