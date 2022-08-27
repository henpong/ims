<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    // use HasFactory;
    public static function getbrands(){
        //Get Brand Data
        $getBrand = Brand::get();
        return $getBrand;
    }
}
