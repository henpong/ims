<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    // use HasFactory;

    // Get Suppliers
    public static function getsuppliers(){
        //Get Suppliers Data
        $getSupplier = Suppliers::get();
        return $getSupplier;
    }
}
