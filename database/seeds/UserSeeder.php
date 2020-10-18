<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Arthur',
                'last_name' => 'Minasyan',
                'username' => 'arthur_minasyan',
                'email' => 'artmins96@gmail.com',
                'password' => Hash::make('123123'),
                'phone' => '37477149478',
                'company' => 'CRM Consulting',
                'address' => 'Address',
                'contact_person' => '',
                'tax_code' => '',
                'person_type' => 1,
            ],
            [
                'name' => 'Mariam',
                'last_name' => 'Ivanyan',
                'username' => 'mariam_ivanyan',
                'email' => 'mariam@gmail.com',
                'password' => Hash::make('123123'),
                'phone' => '37477458595',
                'company' => 'CRM Consulting',
                'address' => 'Address',
                'contact_person' => '',
                'tax_code' => '',
                'person_type' => 1,
            ],
            [
                'name' => 'Test',
                'last_name' => 'Testoyan',
                'username' => 'test_testoyan',
                'email' => 'test@gmail.com',
                'password' => Hash::make('123123'),
                'phone' => '37477125746',
                'company' => 'Beeline',
                'address' => 'Address',
                'contact_person' => '',
                'tax_code' => '',
                'person_type' => 1,
            ]
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
