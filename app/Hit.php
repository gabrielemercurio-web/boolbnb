<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
    protected $fillable = [
        'house_id', 'created_at'
    ];
    public function house() {
        return $this->belongsTo('App\House');
    }     
}
