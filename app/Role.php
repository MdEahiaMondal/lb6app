<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function setNameAttribute($role)
    {
        $this->attributes['name'] = strtolower($role);
    }


    public function getNameAttribute($role)
    {
        return strtolower($role);
    }




}
