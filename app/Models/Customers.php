<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    // use HasFactory;

    public function users(){
        return $this->belongsTo('App\User','user_id');
    }


    public function admins(){
        return $this->belongsTo('App\Admin','user_id');
    }


    //Get Branch Detials From Branch Table Using Eloquent Relationship
    public function branch(){
        return $this->belongsTo("App\Branches",'branch_id'); 
    }


    // Get Sales Details
    public function sales(){
        return $this->belongsTo("App\Sales","sales_id");
    }


   


     //Create A Relation To Get Latest Customer Inserted
     public static function getcustomers(){

        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];

        $getcustomers = Customers::with('branch')->where('branch_id',$branchid)->where(function($query){
            $query->where('id','!=',null)
                    ->where('status',1);
        })->latest()->first();
        // dd($getcustomers); die;
        return $getcustomers;
     }



     //Create A Relation To Get Latest Creditor Inserted
     public static function getcreditors(){
        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];
        
        $getcreditors = Customers::with('branch')->where('branch_id',$branchid)->where(function($query){
            $query->where('status',2);
        })->latest()->first();
        // dd($getcreditors); die;
        return $getcreditors;
     }



     //Create A Relation To Get Latest Creditor Inserted
     public static function getbigcustomers(){
        // Get Branch Id
        // $userId = session('user')['userid'];
        // $branchid = session('user')['branchid'];

        $getbigcustomers = Customers::where(function($query){
            $query->where('id','!=',null)
                    ->where('status',3);
        })->latest()->first();
        // dd($getbigcustomers); die;
        return $getbigcustomers;
     }

}
