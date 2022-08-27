<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    // use HasFactory;

    //Get Product Detials From Product Table Using Eloquent Relationship
    public function products(){
        return $this->belongsTo("App\Models\Products","product_id");
    }

    //Get Category Detials From Category Table Using Eloquent Relationship
    public function categories(){
        return $this->belongsTo("App\Models\Categories","product_id","id");
    }

    //Get Branch Detials From Branch Table Using Eloquent Relationship
    public function branch(){
        return $this->belongsTo("App\Models\Branches","branch_id");
    }

     //Get Users Details From User Table Using Eleoquent Relationship
     public function users(){
        return $this->belongsTo("App\Models\User","user_id");
    }
}
