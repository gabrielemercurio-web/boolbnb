<?php

use App\Service;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $services = [
			'Wifi', 'Swimming Pool', 'Parking Spot', 'Concierge', 'Sauna', 'Sea View', 
		];

		foreach ($services as $service) {
			$newService = new Service();
			$newService->name = $service;
			$newService->save();
		}
    }
}
