<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function home() {
        return $this->belongsTo('App\Home');
    }        
}
