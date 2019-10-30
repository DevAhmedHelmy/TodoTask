<?php

namespace App;

 

class Item extends Model
{
    //

    //  // relationship between  items and todo

    public function todo()
    {
        return $this->belongsTo('App\Todo');
    }


    //  // relationship between  items and cards
    public function cards()
    {
        return $this->hasMany('App\Card');
    }
}
