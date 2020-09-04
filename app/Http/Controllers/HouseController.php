<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;

class HouseController extends Controller
{
    public function homepage() {
		return view('guest.houses.homepage');
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
	
	public function search() {
		//TODO: add search mechanism
		return view('guest.houses.search');
	}
};