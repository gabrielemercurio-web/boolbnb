<?php

namespace App\Http\Controllers\upr;

use App\Http\Controllers\Controller;
use App\Hit;

class HitController extends Controller
{
    public function index($house_id) {
		//TODO: extrapolate hits
		return view('upr.hits.index');
	}
}
