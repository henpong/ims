<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempTrans extends Model
{
    // use HasFactory;


    public function mainwarehouse(){
        return $this->belongsTo("App\Models\MainWarehouse","product_id");
    }


    public function product(){
        return $this->belongsTo("App\Models\Products","product_id");
    }


    public function branch(){
        return $this->belongsTo("App\Models\Branches","branch_id");
    }


    public function customer(){
        return $this->belongsTo("App\Models\Customers");
    }
    

    public static function gettemptrans(){
        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];
        

        
        $gettemptrans = TempTrans::with('product')->where('branch_id',$branchid)->where('user_id',$userId)->orderBy('id','DESC')->get();
        $gettemptrans = json_decode(json_encode($gettemptrans));

        // echo "<pre>"; print_r($gettemptrans); die;
        return $gettemptrans;
    }



    public static function gettemporaltrans(){

        // Get Branch Of The User Doing The Transaction
        $admin = Auth::guard('admin')->user();
        $admin = json_decode(json_encode($admin));
        // echo "<pre>"; print_r($admin); die;
        $userId = $admin->id;
        // echo "<pre>"; print_r($userId); die;
        $branchid = $admin->branchId;
        // dd($branchid); die;
        

        
        $gettemporaltrans = TempTrans::with('mainwarehouse')->where('branch_id',$branchid)->where('user_id',$userId)->orderBy('id','DESC')->get();
        $gettemporaltrans = json_decode(json_encode($gettemporaltrans));

        // echo "<pre>"; print_r($gettemporaltrans); die;
        return $gettemporaltrans;
    }


    public static function gettemptransid(){
        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];

        
        $gettemptransid = TempTrans::select('product_id')->where('branch_id',$branchid)->where('user_id',$userId)->get()->toArray();
        // $gettemptransid = json_decode(json_encode($gettemptransid));

        // foreach($gettemptransid as $transprod){
        //     $transprodid = $transprod->product_id;

        //     echo "<pre>"; print_r($transprodid); die;
        // }

        // echo "<pre>"; print_r($gettemptransid); die;
        return $gettemptransid;
    }


    public static function sum(){
        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];

        
        $sum = TempTrans::with('product')->where('branch_id',$branchid)->where('user_id',$userId)->get();
        // dd($sum); die;
        return $sum;
    }



    public static function calsum(){


        // Get Branch Of The User Doing The Transaction
        $admin = Auth::guard('admin')->user();
        $admin = json_decode(json_encode($admin));
        $userId = $admin->id;
        $branchid = $admin->branchId;


        // $userId = session('user')['userid'];
        // $branchid = session('user')['branchid'];

        
        $calsum = TempTrans::with('mainwarehouse')->where('branch_id',$branchid)->where('user_id',$userId)->get();
        // dd($calsum); die;
        return $calsum;
    }


}
