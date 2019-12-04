<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($category){
            $category->slug = Str::slug($category->title);
        });
    }

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
