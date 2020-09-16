<?php

namespace App\Http\Controllers\upr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment;
use Braintree;

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
    public function create()
    {
        return view('upr.payments.create');
	}
	
	public function store()
	{
		//TODO: update once the create view is done
		return redirect()->route('upr.payments.index');
	}

    public function checkout(Request $request)
    {
        $payload = $request->input('payload', false);
        $nonce = $request->payment_method_nonce;

        $status = Braintree\Transaction::sale([
	        'amount' => '10.00',
	        'paymentMethodNonce' => $nonce,
	        'options' => [
	           'submitForSettlement' => True
	        ]
        ]);

        return response()->json($status);
    }
}
