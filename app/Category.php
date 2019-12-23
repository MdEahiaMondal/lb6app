<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }


    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id', 'id');
    }



}
