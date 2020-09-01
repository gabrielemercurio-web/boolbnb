<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Home;
use App\Service;
use App\HomeService;

class HomeServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
		$homes = Home::all()->pluck('id')->toArray();
		$services = Service::all()->pluck('id')->toArray();


		for ($i=0; $i < 20; $i++) { 
			$idsCombos = [];
			$newHome = $faker->randomElement($homes);
			$newService = $faker->randomElement($services);
			$newCombo = $newHome . '-' . $newService;
			if (!in_array($newCombo, $idsCombos)) {
				array_push($idsCombos, $newCombo);
				DB::table('home_service')->insert([
					'home_id' => $newHome,
					'service_id' => $newService,
				]);
			}
		}
    }
}
