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
                    'title' => 'Translator',
                ],
                'ru' => [
                    'title' => 'Переводчик',
                ],
                'hy' => [
                    'title' => 'Թարգմանիչ',
                ],
                'form_type' => 1
            ],
        ];

        foreach ($jobs as $key => $job) {
            \App\Jobs::create($job);
        }
    }
}
