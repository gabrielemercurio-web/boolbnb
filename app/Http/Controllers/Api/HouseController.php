<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\House;

class HouseController extends Controller
{

    public function index(Request $request) {
		$input = $request->all();
		$query = House::leftJoin('house_service', 'house_service.house_id', '=', 'houses.id');
			/** rooms */
		if (isset($input['rooms']) && $input['rooms'])
			$query->where('houses.nr_of_rooms', '>=', $input['rooms']);
			/** beds */
		if (isset($input['beds']) && $input['beds'])
			$query->where('houses.nr_of_beds', '>=', $input['beds']);
			/** wifi */
		if (isset($input['wifi']) && $input['wifi'])
			$query->where('house_service.service_id', '=', '1');
			/** swimming pool */
		if (isset($input['pool']) && $input['pool'])
			$query->where('house_service.service_id', '=', '2');
			/** parking spot */
		if (isset($input['parking']) && $input['parking'])
			$query->where('house_service.service_id', '=', '5');
			/** concierge */
		if (isset($input['concierge']) && $input['concierge'])
			$query->where('house_service.service_id', '=', $input['concierge']);
			/** sauna */
		if (isset($input['sauna']) && $input['sauna'])
            $query->where('house_service.service_id', '=', '8');
			/** sea view */
		if (isset($input['sea-view']) && $input['sea-view'])
            $query->where('house_service.service_id', '=',  '6');
		$houses = $query->get();
		return response()->json([
			'success' => true,
			'count' => $houses->count(),
			'data' => $houses,
		]);
		// return new HouseResource(House::find(1));
		// return HouseResource::collection($houses);
	}
}
