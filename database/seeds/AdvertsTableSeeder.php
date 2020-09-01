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
        // Get collection of 'id' from payments table
        $payments = Payment::all()->pluck('id')->toArray();
        for ($i=0; $i < 10; $i++) { 
            $seed = new Advert();
            $seed->payment_id = $faker->randomElement($payments);
            $seed->duration_in_days = $faker->randomElement(['1', '3', '6']);
            $seed->price = $faker->randomFloat(2,0,5);
            $seed->save();
        }
    }
}
