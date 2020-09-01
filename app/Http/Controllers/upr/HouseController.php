<?php

namespace App\Http\Controllers\upr;

use Illuminate\Http\Request;
use App\House;
use App\Service;
// use App\HouseService;
// use App\Payment;
// use Faker\Generator as Faker;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upr.houses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$request->validate([
			'title' => 'required|max:250',
			'nr_of_rooms' => 'required|integer',
			'nr_of_beds' => 'required|integer',
			'nr_of_bathrooms' => 'integer',
			'square_mt' => 'integer',
			'address' => 'required',
			'image_path' => 'image',
			'visible' => 'required|boolean',
			'advertised' => 'required|boolean',
			'description' => 'max:2000',
		]);

		//TODO: address manipulation
		$houseData = $request->all();//non all! in mezzo ci sono sia le cose che vanno in houses che quelle che vanno in services -> SEPARARE I CAMPI!
		// $serviceData = ???;
		$newHouse = new House();
		$newHouse->fill($houseData);
		$newHouse->save();

		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		/**the list of services get grabbed from the frontend */
		$house = House::find($id);
		if ($house) {
			return view('upr.houses.show', compact('house'));
		} else {
			return abort('404');
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $house = House::find($id);
		if ($house) {
			return view('upr.houses.edit', compact('house'));
		} else {
			return abort('404');
		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
			'title' => 'required|max:250',
			'nr_of_rooms' => 'required|integer',
			'nr_of_beds' => 'required|integer',
			'nr_of_bathrooms' => 'integer',
			'square_mt' => 'integer',
			'address' => 'required',
			'image_path' => 'image',
			'visible' => 'required|boolean',
			'advertised' => 'required|boolean',
			'description' => 'max:2000',
		]);
		
		//TODO: address manipulation
		$data = $request->all();
		$house = House::find($id);
		$house->update($data);
		return redirect()->route('upr.houses.show', compact('house'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$house = House::find($id);
		$house->delete();
		return redirect()->route('upra.houses.index');
	}
}
