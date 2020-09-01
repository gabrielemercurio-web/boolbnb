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
        $this->call(UsersTableSeeder::class);
        $this->call(HomesTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(AdvertsTableSeeder::class);
        $this->call(HitsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(HomeServiceSeeder::class);
    }
}
