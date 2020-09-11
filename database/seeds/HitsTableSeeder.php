<?php

use App\Hit;
use App\House;
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
        // Get collection of 'id' from houses table
        $houses = House::all()->pluck('id')->toArray();
        $seed->house_id = $faker->randomElement($houses);
        $seed->save();
      }
    }
}
