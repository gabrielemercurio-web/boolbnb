<?php

use App\Hit;
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
        $hit = new Hit();
        $hit->date = $faker->date;
        $hit->save();
      }
    }
}
