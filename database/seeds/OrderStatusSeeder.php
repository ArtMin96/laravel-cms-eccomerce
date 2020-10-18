<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orderStatus = [
            [
                'en' => [
                    'name' => 'Pending',
                ],
                'ru' => [
                    'name' => 'В ожидании',
                ],
                'hy' => [
                    'name' => 'Սպասում է',
                ],
                'color' => '#eff3f9'
            ],
            [
                'en' => [
                    'name' => 'In Progress',
                ],
                'ru' => [
                    'name' => 'В ходе выполнения',
                ],
                'hy' => [
                    'name' => 'Ընթացքում',
                ],
                'color' => '#A4DD74'
            ],
            [
                'en' => [
                    'name' => 'Completed',
                ],
                'ru' => [
                    'name' => 'Завершено',
                ],
                'hy' => [
                    'name' => 'Ավարտված',
                ],
                'color' => '#33ae10'
            ],
            [
                'en' => [
                    'name' => 'Canceled',
                ],
                'ru' => [
                    'name' => 'Отменено',
                ],
                'hy' => [
                    'name' => 'Չեղարկված',
                ],
                'color' => '#e85342'
            ],
        ];

        foreach ($orderStatus as $key => $status) {
            \App\OrderStatus::create($status);
        }
    }
}
