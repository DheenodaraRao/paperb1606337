<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'id', 
        'name'
    ];
    
    public function attractions(){
        return $this->hasMany('App\Attraction');
    }
}
