<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporalCreditDetail extends Model
{
    // use HasFactory;

     // Get Product Name Using Eloquent Relations
     public function products(){
        return $this->belongsTo('App\Models\Products','product_id');
    }

    //Get Branch Detials From Branch Table Using Eloquent Relationship
    public function branch(){
        return $this->belongsTo("App\Models\Branches","branch_id");
    }

    //Get Branch Detials From Branch Table Using Eloquent Relationship
    public function customers(){
        return $this->belongsTo("App\Models\Customers","customer_id");
    }

    //Get Users Details From User Table Using Eleoquent Relationship
    public function users(){
        return $this->belongsTo("App\Models\User","user_id");
    }

}
