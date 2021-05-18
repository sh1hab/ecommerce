<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProduct extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
