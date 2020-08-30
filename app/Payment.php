<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function advert() {
        return $this->belongsTo('App\Advert');
    }     

    public function home() {
        return $this->belongsTo('App\Home');
    }     
}
