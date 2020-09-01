<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }     

    public function payments() {
        return $this->hasMany('App\Payment');
    }     

    public function hits() {
        return $this->hasMany('App\Hit');
    }     

    public function messages() {
        return $this->hasMany('App\Message');
    }     

    public function services() {
        return $this->belongsToMany('App\Service');
    }
}
