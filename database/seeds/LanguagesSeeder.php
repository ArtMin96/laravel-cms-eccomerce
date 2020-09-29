<?php

use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            [
                'en' => [
                    'name' => 'Armenian'
                ],
                'ru' => [
                    'name' => 'Армянский'
                ],
                'hy' => [
                    'name' => 'Հայերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Arabic'
                ],
                'ru' => [
                    'name' => 'Арабский'
                ],
                'hy' => [
                    'name' => 'Արաբերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Bulgarian'
                ],
                'ru' => [
                    'name' => 'Болгарский'
                ],
                'hy' => [
                    'name' => 'Բուլղարերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Chinese'
                ],
                'ru' => [
                    'name' => 'Китайский'
                ],
                'hy' => [
                    'name' => 'Չինարեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Czech'
                ],
                'ru' => [
                    'name' => 'Чешский'
                ],
                'hy' => [
                    'name' => 'Չեխերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'English'
                ],
                'ru' => [
                    'name' => 'Английский'
                ],
                'hy' => [
                    'name' => 'Անգլերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'French'
                ],
                'ru' => [
                    'name' => 'Французский'
                ],
                'hy' => [
                    'name' => 'Ֆրանսերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Georgian'
                ],
                'ru' => [
                    'name' => 'Грузинский'
                ],
                'hy' => [
                    'name' => 'Վրացերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'German'
                ],
                'ru' => [
                    'name' => 'Немецкий'
                ],
                'hy' => [
                    'name' => 'Գերմաներեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Greek'
                ],
                'ru' => [
                    'name' => 'Греческий'
                ],
                'hy' => [
                    'name' => 'Հունարեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Indian'
                ],
                'ru' => [
                    'name' => 'Индийский'
                ],
                'hy' => [
                    'name' => 'Հնդկերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Italian'
                ],
                'ru' => [
                    'name' => 'Итальянский'
                ],
                'hy' => [
                    'name' => 'Իտալերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Japanese'
                ],
                'ru' => [
                    'name' => 'Японский'
                ],
                'hy' => [
                    'name' => 'Ճապոներեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Lithuanian'
                ],
                'ru' => [
                    'name' => 'Литовский'
                ],
                'hy' => [
                    'name' => 'Լիտվերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Dutch'
                ],
                'ru' => [
                    'name' => 'Нидерландский'
                ],
                'hy' => [
                    'name' => 'Հոլանդերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Polish'
                ],
                'ru' => [
                    'name' => 'Польский'
                ],
                'hy' => [
                    'name' => 'Լեհերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Portuguese'
                ],
                'ru' => [
                    'name' => 'Португальский'
                ],
                'hy' => [
                    'name' => 'Պորտուգալերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Romanian'
                ],
                'ru' => [
                    'name' => 'Румынский'
                ],
                'hy' => [
                    'name' => 'Ռումիներեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Russian'
                ],
                'ru' => [
                    'name' => 'Русский'
                ],
                'hy' => [
                    'name' => 'Ռուսերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Korean'
                ],
                'ru' => [
                    'name' => 'Корейский'
                ],
                'hy' => [
                    'name' => 'Կորեերեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Spanish'
                ],
                'ru' => [
                    'name' => 'Испанский'
                ],
                'hy' => [
                    'name' => 'Իսպաներեն'
                ]
            ],
            [
                'en' => [
                    'name' => 'Ukrainian'
                ],
                'ru' => [
                    'name' => 'Украинский'
                ],
                'hy' => [
                    'name' => 'Ուկրաիներեն'
                ]
            ],
        ];

        foreach ($languages as $language) {
            \App\Languages::create($language);
        }
    }
}
