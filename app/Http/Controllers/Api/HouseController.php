<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\House;

class HouseController extends Controller
{

    public function index(Request $request) {
		// $input = $request->all();
		// $services = $request['services'];
		// $services = [1,6];
		// dd($services);
		
		$query = House::with('services')
		->where('nr_of_rooms', '>=', $request->rooms ?? 0)
		->where('nr_of_beds', '>=', $request->beds ?? 0);
		if ($request['services']) {
			$services = explode(',', $request['services']);
			foreach ($services as $service) {
				$query->whereHas('services', function($q) use ($service) {
					$q->where('services.id', $service);
				});
			}
		}
			
		$houses = $query->get();
		return response()->json([
			'success' => true,
			'count' => $houses->count(),
			'data' => $houses,
		]);

	}

	/* get distance */
	public static function vincentyGreatCircleDistance(
			$latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
		{
			// convert from degrees to radians
			$latFrom = deg2rad($latitudeFrom);
			$lonFrom = deg2rad($longitudeFrom);
			$latTo = deg2rad($latitudeTo);
			$lonTo = deg2rad($longitudeTo);
		
			$lonDelta = $lonTo - $lonFrom;
			$a = pow(cos($latTo) * sin($lonDelta), 2) +
			pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
			$b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);
		
			$angle = atan2(sqrt($a), $b);
			return $angle * $earthRadius;
		}
}
