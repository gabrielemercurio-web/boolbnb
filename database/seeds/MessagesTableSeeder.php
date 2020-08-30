<?php

use App\Message;
use App\Home;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {
            $seed = new Message();
            // Get collection of 'id' from homes table
            $homes = Home::all()->pluck('id')->toArray();
            $seed->home_id = $faker->randomElement($homes);
            $seed->sender_email = $faker->freeEmail;
            $seed->message = $faker->text;
            $seed->save();
        }
    }
}
