<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function homes() {
        return $this->belongsToMany('App\Home');
    }
}
