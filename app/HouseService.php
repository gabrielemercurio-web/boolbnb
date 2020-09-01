<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseService extends Model
{
	protected $table = 'house_service';

    public function houses() {
		$this->belongsToMany('App\House');
	}
 
	public function services() {
		$this->belongsToMany('App\Service');
	}
}
