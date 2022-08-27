<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    // use HasFactory;

    public static function getunits(){
        //Get Unit Data
        $getUnit = Unit::get();
        return $getUnit;
    }
}
