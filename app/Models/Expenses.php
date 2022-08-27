<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    // use HasFactory;

    public function branch(){
        return $this->belongsTo("App\Branches","branch_id");
    }


    public function user(){
        return $this->belongsTo('App\User','user_id');
    }


    // Get Total Expenses For The Day
    public static function totalexpenses(){
        
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];


        // Get Today's Date
        $date = date("Y-m-d");
        
        $totalexpenses = Expenses::select('amount')->whereDate('expense_date',$date)->where('branch_id',$branchid)->where('status',1)->sum('amount');
        $totalexpenses = json_decode(json_encode($totalexpenses));

        // echo "<pre>"; print_r($totalexpenses); die;
        return $totalexpenses;
    }



    // Get Total Expenses For The Day
    public static function totalexpensesallshop(){
        
        // Get Today's Date
        $date = date("Y-m-d");
        
        $totalexpensesallshop = Expenses::select('amount')->whereDate('expense_date',$date)->where('status',1)->sum('amount');
        $totalexpensesallshop = json_decode(json_encode($totalexpensesallshop));

        // echo "<pre>"; print_r($totalexpensesallshop); die;
        return $totalexpensesallshop;
    }




     // Get Total Expenses For The Day For Shop One
     public static function branonetotalexpenses(){
        // Get Branch Details
        $branchdetails = Branches::where('status',2)->first();
        $branchdetails = json_decode(json_encode($branchdetails));

        if(!empty($branchdetails)){

            $branid = $branchdetails->id;


            // Get Today's Date
            $date = date("Y-m-d");
            
            $branonetotalexpenses = Expenses::select('amount')->whereDate('expense_date',$date)->where('branch_id',$branid)->where('status',1)->sum('amount');
            $branonetotalexpenses = json_decode(json_encode($branonetotalexpenses));
    
            // echo "<pre>"; print_r($branonetotalexpenses); die;
            return $branonetotalexpenses;
        }

       
    }




     // Get Total Expenses For The Day For Shop Two
     public static function brantwototalexpenses(){
        // Get Branch Details
        $branchdetails = Branches::where('status',3)->first();
        $branchdetails = json_decode(json_encode($branchdetails));
        
        if(!empty($branchdetails)){
            
            $branid = $branchdetails->id;
    
    
            // Get Today's Date
            $date = date("Y-m-d");
            
            $brantwototalexpenses = Expenses::select('amount')->whereDate('expense_date',$date)->where('branch_id',$branid)->where('status',1)->sum('amount');
            $brantwototalexpenses = json_decode(json_encode($brantwototalexpenses));
    
            // echo "<pre>"; print_r($brantwototalexpenses); die;
            return $brantwototalexpenses;
        }

    }



     // Get Total Expenses For The Day For Shop Three
     public static function branthreetotalexpenses(){
        // Get Branch Details
        $branchdetails = Branches::where('status',4)->first();
        $branchdetails = json_decode(json_encode($branchdetails));
        
        if(!empty($branchdetails)){
            
            
            $branid = $branchdetails->id;
    
    
            // Get Today's Date
            $date = date("Y-m-d");
            
            $branthreetotalexpenses = Expenses::select('amount')->whereDate('expense_date',$date)->where('branch_id',$branid)->where('status',1)->sum('amount');
            $branthreetotalexpenses = json_decode(json_encode($branthreetotalexpenses));
    
            // echo "<pre>"; print_r($branthreetotalexpenses); die;
            return $branthreetotalexpenses;
        }

    }





     // Get Total Expenses For The Day For Shop Four
     public static function branfourtotalexpenses(){
        // Get Branch Details
        $branchdetails = Branches::where('status',5)->first();
        $branchdetails = json_decode(json_encode($branchdetails));
        
        if(!empty($branchdetails)){
            
            
            $branid = $branchdetails->id;
    
    
            // Get Today's Date
            $date = date("Y-m-d");
            
            $branfourtotalexpenses = Expenses::select('amount')->whereDate('expense_date',$date)->where('branch_id',$branid)->where('status',1)->sum('amount');
            $branfourtotalexpenses = json_decode(json_encode($branfourtotalexpenses));
    
            // echo "<pre>"; print_r($branfourtotalexpenses); die;
            return $branfourtotalexpenses;
        }

    }





     // Get Total Expenses For The Day For Shop Five
     public static function branfivetotalexpenses(){
        // Get Branch Details
        $branchdetails = Branches::where('status',6)->first();
        $branchdetails = json_decode(json_encode($branchdetails));
        
        if(!empty($branchdetails)){
            
            
            $branid = $branchdetails->id;
    
    
            // Get Today's Date
            $date = date("Y-m-d");
            
            $branfivetotalexpenses = Expenses::select('amount')->whereDate('expense_date',$date)->where('branch_id',$branid)->where('status',1)->sum('amount');
            $branfivetotalexpenses = json_decode(json_encode($branfivetotalexpenses));
    
            // echo "<pre>"; print_r($branfivetotalexpenses); die;
            return $branfivetotalexpenses;
        }

    }






     // Get Total Expenses For The Day For Shop Six
     public static function bransixtotalexpenses(){
        // Get Branch Details
        $branchdetails = Branches::where('status',7)->first();
        $branchdetails = json_decode(json_encode($branchdetails));

        if(!empty($branchdetails)){
            
            
            $branid = $branchdetails->id;
    
    
            // Get Today's Date
            $date = date("Y-m-d");
            
            $bransixtotalexpenses = Expenses::select('amount')->whereDate('expense_date',$date)->where('branch_id',$branid)->where('status',1)->sum('amount');
            $bransixtotalexpenses = json_decode(json_encode($bransixtotalexpenses));
    
            // echo "<pre>"; print_r($bransixtotalexpenses); die;
            return $bransixtotalexpenses;
        }
    }


}
