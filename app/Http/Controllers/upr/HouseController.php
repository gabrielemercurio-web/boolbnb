<?php

namespace App\Http\Controllers\upr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\House;
use App\Payment;
use App\Service;
use App\Hit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\support\facades\Storage;
use Braintree\Transaction as Transaction;
use Illuminate\Support\Carbon;

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
        $services = Service::all();

        return view('upr.houses.create', compact('services'));
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
			'nr_of_rooms' => 'required|integer|min:0',
			'nr_of_beds' => 'required|integer|min:0',
			'nr_of_bathrooms' => 'integer|min:0',
			'square_mt' => 'integer|min:1',
			'address' => 'required',
			'image_path' => 'image',
			'description' => 'max:2000',
		]);

		//TODO: address manipulation
		$houseData = $request->all();//in mezzo ci sono sia le cose che vanno in houses che quelle che vanno in services -> SEPARARE I CAMPI!
		// $serviceData = ???;
		$newHouse = new House();
		$newHouse->fill($houseData);
		$newHouse->image_path = Storage::put('uploads', $houseData['cover_image']);
		$newHouse->save();
		if (!empty($houseData['services_ids'])) {
			$newHouse->services()->sync($houseData['services_ids']);
    	}

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
			$hit = new Hit();
			$hit->timestamps = false;
			$hit->house_id = $id;
			$hit->created_at = now();
			$hit->save();

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
        $services = Service::all();
		if ($house) {
			return view('upr.houses.edit', compact('house', 'services'));
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
			'nr_of_rooms' => 'required|integer|min:0',
			'nr_of_beds' => 'required|integer|min:0',
			'nr_of_bathrooms' => 'integer|min:0',
			'square_mt' => 'integer|min:1',
			'address' => 'required',
			'image_path' => 'image',
			'description' => 'max:2000',
		]);

		$data = $request->all();
		$house = House::find($id);
		$house->update($data);
		if (!empty($data['services_ids'])) {
			$house->services()->sync($data['services_ids']);
    	} else {
			$house->services()->sync([]);
		}
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

	/**
	 * Retrieve advert status data from braintree +
	 * Show freshly updated advertised homes in view
	 */
	public function homepage() {
		/* get all unconfirmed payments */
		$payments = Payment::where('status', '=', 'submitted_for_settlement')->get();
		foreach ($payments as $payment) {
			$transaction = Transaction::find($payment->payment_id);
			/* check whether any has changed status on braintree and update local db */
			$payment->update(['status' => $transaction->status]);
			if ($payment->status == 'settled') {
				/* if the payment is confirmed, mark the advert as active */
				$payment->house->update(['advertised' => 1]);
				/* set start and end datetime for advert */
				$payment->update(['starting_datetime' => Carbon::now()]);
				switch ($payment->advert_id) {
					case 1:
						$payment->update(['expiration_datetime' => Carbon::now()->addDays(1)]);
						break;
					case 2:
						$payment->update(['expiration_datetime' => Carbon::now()->addDays(3)]);
						break;
					case 3:
						$payment->update(['expiration_datetime' => Carbon::now()->addDays(6)]);
						break;
				}
			}
		}

		/* get all the newly expired adverts and mark the house advert as false*/
		$advertisedHomes = House::leftJoin('payments', 'houses.id', '=', 'payments.house_id')
			->where('advertised', 1)
			->where('starting_datetime', '>', Carbon::now()->subDays(7))
			->where('expiration_datetime', '<', Carbon::now())
			->get();
		foreach ($advertisedHomes as $advertisedHome) {
			if ($advertisedHome->advertised == 1) {
                $advertisedId = $advertisedHome->house_id;
                $advertHouse = House::find($advertisedId);
                $advertHouse->update(['advertised' => 0]);
			}
		}
		
		/** send all advertised AND visible houses to the view */
		$houses = House::where('advertised', true)
			->where('visible', 1)
			->get();
		return view('upr.houses.homepage', compact('houses', 'payments'));
    }

	/**
	 * From upr.houses.show, mark home as visible/non visible in the db
	 */
    public function toggleVisibility($id) {
        $house = House::find($id);

        if($house->visible == 0) {
            $house->update(['visible'=> 1]);
        } else {
            $house->update(['visible'=> 0]);
        }
        return redirect()->back();
    }

	/**
	 * Gather and deliver all the data needed from the upr.houses.search view
	 */
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

}
