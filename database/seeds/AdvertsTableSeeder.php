<?php

use App\Advert;
use App\Payment;
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
        $seed = new Advert();
        // Get collection of 'id' from payments table
        $payments = Payment::all()->pluck('id')->toArray();
        $seed->payment_id = $faker->randomElement($payments);
        $seed->duration_in_hrs = $faker->randomElement(['24', '48', '72']);//XXX:use days?
        $seed->price = $faker->randomFloat(2,0,5);
        $seed->save();
      }
    }
}
