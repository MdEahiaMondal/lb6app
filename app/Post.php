<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profile()
    {
        return $this->hasOneThrough(UserProfile::class,User::class, 'id', 'user_id', 'id', 'id');
    }

    // ekhane ami firstKey = id eti holo user id (ei kane user_id hoyor kotha cilo but jhetu post er id user table e nai tai user table er id ekhane bose giyace)
    // secondKey = user_id eti holo UserProfile er user_id
    // localKey = id etiholo post er id
    // secondlocalKey = id eti holo user er id



}
