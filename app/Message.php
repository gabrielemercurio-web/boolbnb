<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'house_id', 'sender_email', 'message'
    ];
    
    public function house() {
        return $this->belongsTo('App\House');
    }        
}
