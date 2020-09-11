<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Service;

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
			return view('guest.houses.show', compact('house'));
		} else {
			return abort('404');
		}
	}
	
	public function search(Request $request) {
		//get the address inputed in homepage and show it in searchbar in search page
		$userQuery = $request->user_search_address;
		//grab advertised houses to show on top
		//TODO: randomize houses
		$houses = House::where('visible', '1')
					->where('advertised', '1')
					->limit(3)
					->get();
		$services = Service::all();
		return view('guest.houses.search', compact('userQuery', 'houses', 'services'));
	}
};
