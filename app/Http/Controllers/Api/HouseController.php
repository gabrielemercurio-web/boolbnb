<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\http\Resources\HouseCollection;
// use App\http\Resources\HouseResource;
use App\House;

class HouseController extends Controller
{
    public function index(Request $request) {
		$input = $request->all();
		$query = House::leftJoin('house_service', 'house_service.house_id', '=', 'houses.id');
			/** rooms */
		if (isset($input['search-nr-rooms']) && $input['search-nr-rooms'])
			$query->where('houses.nr_of_rooms', '>=', $input['search-nr-rooms']);
			/** beds */
		if (isset($input['search-nr-beds']) && $input['search-nr-beds'])
			$query->where('houses.nr_of_beds', '>=', $input['search-nr-beds']);
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
