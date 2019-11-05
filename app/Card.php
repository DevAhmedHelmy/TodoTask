<?php

namespace App;

 

class Card extends Model
{



    
    //  // relationship between  items and card
    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
