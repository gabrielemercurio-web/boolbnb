<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\House;

class HouseController extends Controller
{
    public function index(Request $request) {
		$houses = House::all();
		return response()->json([
			'success' => true,
			'count' => $houses->count(),
			'data' => $houses,
		]);
	}
}
