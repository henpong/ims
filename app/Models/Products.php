<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sections;
use App\Models\MainWarehouse;
use Session;


class Products extends Model
{
    // use HasFactory;


    //Get Category Name Using Eloquent Relation
    public function category(){
        return $this->belongsTo('App\Models\Categories','category_id');
    }

    //Get Branch Name Using Eloquent Relations
    public function branch(){
        return $this->belongsTo('App\Models\Branches','branch_id')->select('id','branch_name');
    }

    //Get Main Warehouse Name Using Eloquent Relations
    public function warehouse(){
        return $this->belongsTo('App\Models\MainWarehouse','main_warehouse_id');
    }


    public function warehousename(){
        return $this->belongsTo('App\Models\Warehouse','ware_id');
    }


    public function categories(){
        return $this->hasMany("App\Models\Categories","id");
    }


    public function temptrans(){
        return $this->belongsTo("App\Models\TempTrans");
    }


    public function prodtemptrans(){
        return $this->hasMany("App\Models\TempTrans","product_id");
    }


    public function salesdetails(){
        return $this->belongsTo("App\Models\SalesDetails");
    }


    public function stockrequest(){
        return $this->belongsTo("App\Models\StockRequest","product_id");
    }
 

    //Get Product Detials From Product Table Using Eloquent Relationship
    public function products(){
        return $this->belongsTo("App\Models\Products","product_id");
    }


    //Get Customer Detials From Customer Table Using Eloquent Relationship
    public function prodcategory(){
        return $this->belongsTo("App\Models\Categories","id","category_name");
    }


   //Create a relation to get products
   public static function getproducts(){
       
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];

        
        $getproducts = Products::with('branch')->where('branch_id',$branchid)->where('status',1)->orWhere('status',2)->get();
        // dd($getproducts); die;
        return $getproducts;
    }



    // Create a relation to count low stock products
    public static function countlowstock(){
        
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];


        $countlowstock = Products::with(['branch','category','warehouse'])->whereColumn('product_qty','<=','lowstock_point')->where('branch_id',$branchid)->where('status',1)->count();
        // dd($countlowstock); die;
        return $countlowstock;
    }



    // Create a relation to count low stock products
    public static function getlowproducts(){
        
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];


        
        $getlowproducts = Products::with(['branch','category','warehouse'])->whereColumn('product_qty','<=','lowstock_point')->where('branch_id',$branchid)->where('status',1)->get();
        // dd($getlowproducts); die;
        return $getlowproducts;
    }



    // Create a relation to count total products in various shops
    public static function countproduct(){
       
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];
        

        
        $countproduct = Products::with('branch')->where('branch_id',$branchid)->where(function($query){
            $query->where('status',1);
        })->count();
        // dd($countproduct); die;
        return $countproduct;
    }





     // Create a relation to count total products in various shops
     public static function countallproduct(){
                
        $countallproduct = Products::where('status',1)->count();
        // echo "<pre>"; print_r($countallproduct); die;
        return $countallproduct;
    }




      //Create a relation to get sub categories
      public function getgas(){
        return $this->hasMany('App\Models\Categories','parent_id')->where(['parent_id'=>0,'category_status'=>1])->where('category_status',1);
    }


   

    
    // Get Products In Main Warehouse
    public static function mainwarehouseproduct(){

        $mainwarehouseproduct = MainWarehouse::get();
        return $mainwarehouseproduct;

    }

}
