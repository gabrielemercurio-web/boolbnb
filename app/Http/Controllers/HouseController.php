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
	
<<<<<<< HEAD
	public function search(Request $request) {
		$userQuery = $request->all();
		//userQuery dentro ha solo l'indirizzo
		return view('guest.houses.search', compact('userQuery'));
=======
	public function search() {
        
        $services = Service::all();
		return view('guest.houses.search', compact('services'));
>>>>>>> 86dca8298914081f0f97f6fdd9341557f16eb8fc
	}
};