<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    // use HasFactory;

    public static function getwarehouse(){
        //Get Warehouse Data
        $getWarehouse = Warehouse::get();
        return $getWarehouse;
    }
}
