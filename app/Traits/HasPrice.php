<?php

namespace App\Traits;

use App\Models\Money as ModelsMoney;
use Illuminate\Support\Facades\App;

trait HasPrice
{
    /**
     *  returns the price money object
     */
    public function getPriceAttribute($value)
    {
        return new ModelsMoney($value);
    }
}
