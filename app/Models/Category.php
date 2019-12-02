<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    function parent_category()
    {
        return $this->belongsTo(__CLASS__);
    }

    function child_category()
    {
        return $this->hasMany(__CLASS__);
    }

    function products()
    {
        return $this->hasMany(Category::class);
    }
}
