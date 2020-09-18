<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Payment;
use App\Service;
use App\Hit;
use Braintree\Transaction as Transaction;
use Illuminate\Support\Carbon;

class HouseController extends Controller
{
    public function homepage() {
        $payments = Payment::where('status', '=', 'submitted_for_settlement')->get();
		foreach ($payments as $payment) {
			$transaction = Transaction::find($payment->payment_id);
			
			$payment->update(['status' => $transaction->status]);
			if ($payment->status == 'settled') {
				// var_dump("I'm in!");
				$payment->house->update(['advertised' => 1]);
				// var_dump($payment->house);
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
	
		$houses = House::where('advertised', true)
			->where('visible', 1)
			->get();
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
