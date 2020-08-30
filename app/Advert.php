<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    public function payments() {
        return $this->hasMany('App\Payment');
    }     
}
