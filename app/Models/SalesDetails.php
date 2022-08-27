<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetails extends Model
{
    // use HasFactory;

    // Get Products Details
    public function mainwarehouse(){
        return $this->belongsTo("App\Models\MainWarehouse","product_id");
    }


    // Get Products Details
    public function products(){
        return $this->belongsTo("App\Models\Products","product_id");
    }


    // Get Branch Details
    public function branch(){
        return $this->belongsTo("App\Models\Branches","branch_id");
    }


    // Get Sales Trans Details
    public function sales(){
        return $this->belongsTo("App\Models\Sales","sales_id");
    }


    // Get Customer Details
    public function customers(){
        return $this->belongsTo("App\Models\Customers","customer_id");
    }


    // Get Transaction Number
    public function payments(){
        return $this->belongsTo("App\Models\Payments","payment_id");
    }
    
}
