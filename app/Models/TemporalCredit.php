<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class TemporalCredit extends Model
{
    // use HasFactory;

    // Get Product Name Using Eloquent Relations
    public function products(){
        return $this->belongsTo('App\Models\Products','product_id');
    }

      //Get Category Detials From Category Table Using Eloquent Relationship
      public function categories(){
        return $this->belongsTo("App\Models\Categories","product_id","id");
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


    // Get User Details
    public function user(){
        return $this->belongsTo("App\Models\User");
    }



    // Count Temporal Credit For Every Shop
    public static function goodscounts(){

        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];
        // dd($branchid); die;

        $goodscounts = TemporalCredit::with(['branch','products'])->where('branch_id',$branchid)->where('temp_credit_status',1)->count();
        // $goodscounts = json_decode(json_encode($goodscounts));

        // echo "<pre>"; print_r($goodscounts); die;

        return $goodscounts;

    }



    // Count Temporal Credit For All Shops
    public static function allgoodscounts(){

        // Get Branch Id
        // $userId = session('user')['userid'];
        // $branchid = session('user')['branchid'];
        // dd($branchid); die;

        $allgoodscounts = TemporalCredit::with(['branch','products'])->where('temp_credit_status',1)->count();
        // $allgoodscounts = json_decode(json_encode($allgoodscounts));

        // echo "<pre>"; print_r($allgoodscounts); die;

        return $allgoodscounts;

    }


}
