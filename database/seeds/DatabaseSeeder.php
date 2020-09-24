<?php

use App\PageContent;
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
         $this->call(CredentialsSeeder::class);
         $this->call(PageContent::class);
    }
}
