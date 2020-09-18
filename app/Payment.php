<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	protected $guarded = [];

    public function advert() {
        return $this->belongsTo('App\Advert');
    }     

    public function house() {
        return $this->belongsTo('App\House');
    }     
}
