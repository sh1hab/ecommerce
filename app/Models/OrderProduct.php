<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    function order()
    {
        return $this->belongsTo(Order::class);
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }
}
