<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    public static function getTaxFraction()
    {
        return 0.25;
    }
}
