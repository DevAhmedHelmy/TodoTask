<?php

namespace App;

 

class Card extends Model
{



    
    //  // relationship between  items and card
    public function item()
    {
        return $this->belongsTo('App\Item','item_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
