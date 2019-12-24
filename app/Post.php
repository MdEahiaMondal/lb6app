<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    protected $fillable = ['user_id', 'title', 'content', 'status', 'thumbanil'];

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

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_posts');
    }


    public function setSlugAttribute($val)
    {
        $slug = trim(preg_replace("/[^\w\d]+/i", "-", $val), "-");
        $count = $this->where('slug', 'like', "%${slug}%")->count();
        $slug = $slug.($count + 1);
        $this->attributes['slug'] = strtolower($slug);
    }

    public function getSlugAttribute($val)
    {
        if ($val == null){
            return $this->id;
        }

        return $val;
    }






}
