<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockRequest extends Model
{
    // use HasFactory;


    //Get Product Detials From Product Table Using Eloquent Relationship
    public function products(){
        return $this->belongsTo("App\Models\Products","product_id")->with('categories');
    }


    //Get Branch Detials From Branch Table Using Eloquent Relationship
    public function branch(){
        return $this->belongsTo("App\Models\Branches","branch_id");
    }


    //Get Main Warehouse Name Using Eloquent Relations
    public function warehouse(){
        return $this->belongsTo('App\Models\MainWarehouse','main_warehouse_id');
    }


}
