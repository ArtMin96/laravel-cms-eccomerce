<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(AdminSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(PageSeeder::class);
         $this->call(SettingsSeeder::class);
         $this->call(OurTeamSeeder::class);
         $this->call(JobSeeder::class);
         $this->call(PaymentGatewaysSeeder::class);
         $this->call(CredentialsSeeder::class);
         $this->call(SaleTypeSeeder::class);
         $this->call(InterMethodSeeder::class);
         $this->call(InterTypeSeeder::class);
         $this->call(LanguagesSeeder::class);
         $this->call(RateServiceSeeder::class);
    }
}
