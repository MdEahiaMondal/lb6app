<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    public function posts()
    {
        // if intermidiat table er jodi two forain key thake tahole seconkey and secondlocal key same hobe
        return $this->hasManyThrough(
            Post::class, // target table
            UserProfile::class, // inter entermidiat table( through table)
            'country_id', //  Foreign key on entermidiat table
            'user_id', // Foreign key on target table
            'id', // Local key on countries table
            'user_id' // Foreign key on entermidiat table
        );
    }


    public function users()
    {

    }


}
