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
        DB::table('users')->insert([
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
        ]);
    }
}
