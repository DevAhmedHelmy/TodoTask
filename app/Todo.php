<?php

namespace App;

 

class Todo extends Model
{




    //  // relationship between  todos and users

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //  // relationship between  todos and items

    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
