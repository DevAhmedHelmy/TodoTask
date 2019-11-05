<?php

namespace App;



class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function card()
    {
        return $this->belongsTo('App\Card');
    }
}
