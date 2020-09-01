<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeService extends Model
{
	protected $table = 'home_service';

    public function homes() {
		$this->belongsToMany('App\Home');
	}
 
	public function services() {
		$this->belongsToMany('App\Service');
	}
}
