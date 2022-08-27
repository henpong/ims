<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;


class SpoiltGoods extends Model
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


    //Get Customer Detials From Customer Table Using Eloquent Relationship
    public function user(){
        return $this->belongsTo("App\Models\User","user_id");
    }



    // Create a relation to get all products
    public static function getproducts(){
        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];

       
        $getproducts = Products::with(['branch','category'])->where('branch_id',$branchid)->where('status',1)->get();
        // dd($getproducts); die;
        return $getproducts;
    }
}
