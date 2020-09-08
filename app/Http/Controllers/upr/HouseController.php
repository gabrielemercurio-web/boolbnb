<?php

namespace App\Http\Controllers\upr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\House;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // grab id of current upr and make it match user_id
        $houses = DB::table('users')
            ->join('houses', 'users.id', '=', 'houses.user_id')
            ->where('houses.user_id', '=', Auth::user()->id)
            ->orderBy('houses.created_at', 'DESC')
            ->get();

		return view('upr.houses.index', compact('houses'));
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
		$houseData = $request->all();//in mezzo ci sono sia le cose che vanno in houses che quelle che vanno in services -> SEPARARE I CAMPI!
		// $serviceData = ???;
		$newHouse = new House();
		$newHouse->fill($houseData);
		$newHouse->save();
		return redirect()->route('upr.houses.index');
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		/**the list of services is grabbed from the frontend */
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
		return redirect()->route('upr.houses.index');
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
		return redirect()->route('upr.houses.index');
	}

	public function homepage() {
		$houses = House::where('advertised', true)->get();
		return view('upr.houses.homepage', compact('houses'));
    }
    
    public function toggleVisibility($id) {
        $house = House::find($id);

        if($house->visible == 0) {
            $house->update(['visible'=> 1]);
        } else {
            $house->update(['visible'=> 0]);
        }
        return redirect()->back();
    }

<<<<<<< HEAD
	public function search(Request $request) {
		$userQuery = $request->all();
		//userQuery dentro ha solo l'indirizzo
		return view('upr.houses.search', compact('userQuery'));
=======
	public function search() {
        
        $services = Service::all();
		return view('upr.houses.search', compact('services'));
>>>>>>> 86dca8298914081f0f97f6fdd9341557f16eb8fc
	}

}
