<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainWarehouse extends Model
{
    // use HasFactory;

    //Get Categories Name Using Eloquent Relation
    public function categoryname(){
        return $this->belongsTo('App\Models\Categories','category_id')->select('id','category_name');
    }


 
    //Get Suppliers Name Using Eloquent Relation
    public function suppliername(){
        return $this->belongsTo('App\Models\Suppliers','supplier_id')->select('id','supplier_name');
    }


    //Get Brand Name Using Eloquent Relation
    public function brandname(){
        return $this->belongsTo('App\Models\Brand','brand_id')->select('id','brand_name');
    }


    //Get Unit Name Using Eloquent Relation
    public function unitname(){
        return $this->belongsTo('App\Models\Unit','unit_id')->select('id','unit_name');
    }


    //Get Warehouse Name Using Eloquent Relation
    public function warehousename(){
        return $this->belongsTo('App\Models\Warehouse','warehouse')->select('id','name');
    }



     // Get Products In Main Warehouse
     public static function mainwarehouseproduct(){

        $mainwarehouseproduct = MainWarehouse::where('status',1)->get();
        return $mainwarehouseproduct;

    }


    // Create a relation to count total products in all Main Warehouse
    public static function countmainwareproduct(){
                
        $countmainwareproduct = MainWarehouse::where('status',1)->count();
        // echo "<pre>"; print_r($countmainwareproduct); die;
        return $countmainwareproduct;
    }



    // Create a relation to count low stock products
    public static function countlowproducts(){
                
        $countlowproducts = MainWarehouse::whereColumn('total_prodqtypcs','<=','lowstock_point')->where('status',1)->count();
        // echo "<pre>"; print_r($countlowproducts); die;
        return $countlowproducts;
        
    }

}
