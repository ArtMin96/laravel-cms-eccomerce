<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            [
                'en' => [
                    'title' => 'Job title en',
                ],
                'ru' => [
                    'title' => 'Job title ru',
                ],
                'hy' => [
                    'title' => 'Job title hy',
                ]
            ],
        ];

        foreach ($jobs as $key => $job) {
            \App\Jobs::create($job);
        }
    }
}
