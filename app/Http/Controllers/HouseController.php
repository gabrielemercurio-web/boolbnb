<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Service;
use App\Hit;

class HouseController extends Controller
{
    public function homepage() {
        $houses = House::where('advertised', true)->get();
		return view('guest.houses.homepage', compact('houses'));
	}

	public function show($id)
    {
		/**the list of services is grabbed from the frontend */
		$house = House::find($id);
		if ($house) {
			$hit = new Hit();
			$hit->timestamps = false;
			$hit->house_id = $id;
			$hit->created_at = now();
			$hit->save();
			return view('guest.houses.show', compact('house'));
		} else {
			return abort('404');
		}
	}
	
	public function search(Request $request) {
		//get the address inputed in homepage and show it in searchbar in search page
		$userQuery = $request->user_search_address;
		$source = $request->search_source;
		//grab advertised houses to show on top
		//TODO: randomize houses
		$houses = House::where('visible', '1')
					->where('advertised', '1')
					->limit(3)
					->get();
		$services = Service::all();
		$data = [
			'userQuery' => $userQuery,
			'houses' => $houses,
			'services' => $services,
			'source' => $source,
		];
		return view('guest.houses.search', $data);
	}
};
