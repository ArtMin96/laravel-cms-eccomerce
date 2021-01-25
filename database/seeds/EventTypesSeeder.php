<?php

use Illuminate\Database\Seeder;

class EventTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eventTypes = [
            [
                'en' => [
                    'title' => 'Conference',
                ],
                'ru' => [
                    'title' => 'Конференция',
                ],
                'hy' => [
                    'title' => 'Համաժողով',
                ],
            ],
            [
                'en' => [
                    'title' => 'Seminar',
                ],
                'ru' => [
                    'title' => 'Семинар',
                ],
                'hy' => [
                    'title' => 'Սեմինար',
                ],
            ],
            [
                'en' => [
                    'title' => 'Workshop',
                ],
                'ru' => [
                    'title' => 'Цех',
                ],
                'hy' => [
                    'title' => 'Արհեստանոց',
                ],
            ],
            [
                'en' => [
                    'title' => 'Training',
                ],
                'ru' => [
                    'title' => 'Тренировка',
                ],
                'hy' => [
                    'title' => 'Ուսուցում',
                ],
            ],
            [
                'en' => [
                    'title' => 'Meeting',
                ],
                'ru' => [
                    'title' => 'Встреча',
                ],
                'hy' => [
                    'title' => 'Հանդիպում',
                ],
            ]
        ];

        foreach ($eventTypes as $key => $type) {
            \App\EventTypes::create($type);
        }
    }
}
