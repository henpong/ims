<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    // use HasFactory;

    public function sales(){
        return $this->belongsTo("App\Models\Sales","sales_id");
    }


    public function customers(){
        return $this->belongsTo("App\Models\Customers","cust_id");
    }
    

    public function branch(){
        return $this->belongsTo("App\Models\Branches","branch_id");
    }


    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }





    // Get Total Credit Paid For The Day
    public static function totalCreditPaid(){
        
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];

        

        // Get Today's Date
        $date = date("Y-m-d");
        
        $totalCreditPaid = Payments::select('payment')->whereDate('paid_date',$date)->where('branch_id',$branchid)->sum('payment');
        $totalCreditPaid = json_decode(json_encode($totalCreditPaid));

        // echo "<pre>"; print_r($totalCreditPaid); die;

        return $totalCreditPaid;
    }





    // Get Total Credit Paid For The Day For All Branches
    public static function totalCreditPaidAllBranches(){
        
        // $userId = session('user')['userid'];
        // $branchid = session('user')['branchid'];

        

        // Get Today's Date
        $date = date("Y-m-d");
        
        $totalCreditPaidAllBranches = Payments::select('payment')->whereDate('paid_date',$date)->sum('payment');
        $totalCreditPaidAllBranches = json_decode(json_encode($totalCreditPaidAllBranches));

        // echo "<pre>"; print_r($totalCreditPaid); die;

        return $totalCreditPaidAllBranches;
    }



}
