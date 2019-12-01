<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    function parent(){
        return $this->belongsTo(__CLASS__);
    }

    function child(){
        return $this->hasMany(__CLASS__);
    }
}
