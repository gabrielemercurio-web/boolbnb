<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'user_id', 'title', 'nr_of_rooms', 'nr_of_beds', 'nr_of_bedrooms', 'nr_of_bathrooms', 'square_mt', 'address', 'latitude', 'longitude', 'visible', 'advertised', 'description'
    ];
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
