<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Home;
use App\Service;
// use App\HomeService;
// use App\Payment;
// use Faker\Generator as Faker;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('upr.homes.create');
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
		$homeData = $request->all();//non all! in mezzo ci sono sia le cose che vanno in homes che quelle che vanno in services -> SEPARARE I CAMPI!
		$serviceData = ???;
		$newHome = new Home();
		$newHome->fill($homeData);
		$newHome->save();

		
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
		$home = Home::find($id);
		if ($home) {
			return view('upr.homes.show', compact('home'));
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
        $home = Home::find($id);
		if ($home) {
			return view('upr.homes.edit', compact('home'));
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
		$home = Home::find($id);
		$home->update($data);
		return redirect()->route('upr.homes.show', compact('home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$home = Home::find($id);
		$home->delete();
		return redirect()->route('upra.homes.index');
	}
}
