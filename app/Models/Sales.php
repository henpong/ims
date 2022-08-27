<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    // use HasFactory;

    // Get Branch Details
    public function branch(){
        return $this->belongsTo("App\Models\Branches","branch_id");
    }

    
    // Get Customers
    public function customers(){
        return $this->belongsTo("App\Models\Customers","cust_id");
    }



    // Get Sales Details
    public function salesdetails(){
        return $this->belongsTo("App\Models\SalesDetails","sales_id");
    }


    // Get Products Details
    public function products(){
        return $this->belongsTo("App\Models\Products","product_id");
    }
}
