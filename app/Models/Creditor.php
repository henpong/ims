<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creditor extends Model
{
    // use HasFactory;

    public function users(){
        return $this->belongsTo('App\Models\User','user_id');
    }


    //Get Branch Detials From Branch Table Using Eloquent Relationship
    public function branch(){
        return $this->belongsTo("App\Models\Branches",'branch_id'); 
    }


     //Create A Relation To Get Latest Creditor Inserted
      public static function getcreditors(){
        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];
        


        $getcreditors = Creditor::with('branch')->where('branch_id',$branchid)->where(function($query){
            $query->where('status',1);
        })->latest()->first();
        // dd($getcreditors); die;
        return $getcreditors;
     }
}
