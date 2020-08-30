<?php

use App\Hit;
use App\Home;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class HitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 10; $i++) { 
        $seed = new Hit();
        // Get collection of 'id' from homes table
        $homes = Home::all()->pluck('id')->toArray();
        $seed->home_id = $faker->randomElement($homes);
        $seed->date = $faker->date;
        $seed->save();
      }
    }
}
