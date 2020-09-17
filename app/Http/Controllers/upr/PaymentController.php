<?php

namespace App\Http\Controllers\upr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment;
use App\House;
use App\Advert;
use Braintree\Transaction as Braintree_Transaction;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$payments = Payment::all();
		return view('upr.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $house = House::find($id);
        $adverts = Advert::all();
        return view('upr.payments.create', compact('house', 'adverts'));
	}
	
	public function store()
	{
		//TODO: update once the create view is done
		return redirect()->route('upr.payments.index');
	}

    public function checkout(Request $request) {
        $amount = $request->amount;
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];

        $status = Braintree_Transaction::sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
            'submitForSettlement' => True
            ]
        ]);
        
        return response()->json($status);
    }
}
