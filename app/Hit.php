<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
    public function home() {
        return $this->belongsTo('App\Home');
    }     
}
