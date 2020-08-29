<?php

use App\Advert;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class AdvertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 10; $i++) { 
        $advert = new Advert();
        $advert->duration_in_hrs = $faker->randomElement(['24', '48', '72']);//XXX:use days?
        $advert->price = $faker->randomFloat(2,0,5);
        $advert->save();
      }
    }
}
