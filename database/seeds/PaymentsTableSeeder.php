<?php

use App\Payment;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i=0; $i < 10; $i++) { 
        $payment = new Payment();
        $payment->status = $faker->randomElement(['accepted', 'pending', 'rejected']);
        $payment->starting_datetime = $faker->date;
        $payment->save();
      }
    }
}
