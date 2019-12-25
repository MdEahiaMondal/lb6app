<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PhpParser\Builder;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function country()
    {
        return $this;
    }


    public function setUsernameAttribute($username){
        $setUsername = trim(preg_replace("/[^\w\d]+/i","-",$username),"-");
        $count = User::where('username', 'like', "%{$setUsername}%")->count();
        if ($count > 0)
            $setUsername = $setUsername."-".($count + 1);
        $this->attributes['username'] = strtolower($setUsername);
    }



}
