<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    public function branch(){
        return $this->hasMany("App\Models\StockRequest");
    }

    public function userbranch(){
        return $this->hasMany("App\Models\User")->where("branch_status",1);
    }


    public function prodbranch(){
        return $this->hasMany('App\Models\Products','branch_id');
    }


    // Get All Branches
    public static function getbranch(){
        $branches = Branches::where('branch_status',1)->where('branch_name','!=','MAIN OFFICE')->get()->toArray();
        // dd($branches); die;
        return $branches;
    }


    public static function getbranches(){
        $getbranches = Branches::where('branch_name','!=','HEAD OFFICE')->get();
        return $getbranches;
    }
}
