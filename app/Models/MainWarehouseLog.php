<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainWarehouseLog extends Model
{
    // use HasFactory;

    //Get Main Warehouse Details Using Eloquent Relationship
    public function mainwarehouse(){
        return $this->belongsTo('App\Models\MainWarehouse','main_warehouse_id');
    }

    
    //Get Category Name Using Eloquent Relationship
    public function category(){
        return $this->belongsTo('App\Models\Categories', 'category_id');
    }

    // //Get Supplier Name Using Eleoquent Relationship
    public function supplier(){
        return $this->belongsTo('App\Models\Suppliers', 'supplier_id');
    }


    //Get Admin Details Using Eloquent Relationship
    public function admins(){
        return $this->belongsTo('App\Models\Admin','admins_id');
    }


    //Get Users Details Using Eloquent Relationship
    public function users(){
        return $this->belongsTo('App\Models\User','user_id');
    }


    public function stockrequest(){
        return $this->belongsTo('App\Models\StockRequest','stockrequestid');
    }


     //Get Brand Name Using Eloquent Relation
     public function brandname(){
        return $this->belongsTo('App\Models\Brand','brand_id');
    }


    //Get Unit Name Using Eloquent Relation
    public function unitname(){
        return $this->belongsTo('App\Models\Unit','unit_id');
    }


    //Get Warehouse Name Using Eloquent Relation
    public function warehousename(){
        return $this->belongsTo('App\Models\Warehouse','warehouse');
    }


}
