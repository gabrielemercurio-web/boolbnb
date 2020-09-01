<?php

use App\Home;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class HomesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Get collection of 'id' from users table
        $users = User::all()->pluck('id')->toArray();
        for ($i=0; $i < 10; $i++) { 
            $seed = new Home();
            $seed->user_id = $faker->randomElement($users);
            $seed->title = $faker->sentence(5);
            $seed->nr_of_rooms = $faker->randomDigit;
            $seed->nr_of_beds = $faker->randomDigit;
            $seed->nr_of_bathrooms = $faker->randomDigit;
            $seed->square_mt = $faker->randomNumber(2);
            $seed->address = $faker->address;
            $seed->latitude = $faker->latitude;
            $seed->longitude = $faker->longitude;
            $seed->image_path = $faker->imageUrl;
            $seed->visible = $faker->boolean;
			$seed->advertised = $faker->boolean;
			$seed->description = $faker->sentence(50);
            $seed->save();
        }
    }
}
