<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    // use HasFactory;

    //Get Branch Name Using Eloquent Relations
    public function branch(){
        return $this->belongsTo('App\Models\Branches','branch_id');
    }


    //Get Customers
    public function customers(){
        return $this->belongsTo("App\Models\Customers","customer_id");
    }


    //Get Products
    public function products(){
        return $this->belongsTo("App\Models\Products","product_id");
    }


    // Count Total Number of Sales For Today
    public static function numbersales(){
        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];
        


        // Get Today's Date
        $date = date("Y-m-d");
        
        $numbersales = Receipt::with('branch')->where('branch_id',$branchid)->whereDate('transaction_date',$date)->where('status',1)->count();
        // dd($numbersales); die;
        return $numbersales;
    }


    // Calculate Total Sales For Today
    public static function totalsales(){
        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];


        // Get Today's Date
        $date = date("Y-m-d");
        
        $totalsales = Receipt::select('sub_total')->whereDate('transaction_date',$date)->where('branch_id',$branchid)->where('status',1)->sum('sub_total');
        $totalsales = json_decode(json_encode($totalsales));

        // echo "<pre>"; print_r($totalsales); die;
        return $totalsales;
    }





    // Calculate Daily Sales For All Branches

    // Sales For Branch One (1)
    public static function branonetotalsales(){
         // Get Branch Details
        
        $branchdetails = Branches::where('status',2)->first();
        $branchdetails = json_decode(json_encode($branchdetails));
        // echo "<pre>"; print_r($branchdetails); die;
        if(!empty($branchdetails)){

            $branid = $branchdetails->id;
            // echo "<pre>"; print_r($branid); die;
            
            // Get Today's Date
            $date = date("Y-m-d");

            // Calculate Total Sales For Branch One (1)
            $branonetotalsales = Receipt::select('sub_total')->whereDate('transaction_date',$date)->where('branch_id',$branid)->where('status',1)->sum('sub_total');
            $branonetotalsales = json_decode(json_encode($branonetotalsales));
            // echo "<pre>"; print_r($branonetotalsales); die;
            
            return $branonetotalsales;

        }
        
    }




    // Sales For Branch Two (2)
    public static function brantwototalsales(){
        // Get Branch Details
        $branchdetails = Branches::where('status',3)->first();
        $branchdetails = json_decode(json_encode($branchdetails));
        // echo "<pre>"; print_r($branchdetails); die;
        
        if(!empty($branchdetails)){

            $branid = $branchdetails->id;
            // echo "<pre>"; print_r($branid); die;
    
            // Get Today's Date
            $date = date("Y-m-d");
    
            // Calculate Total Sales For Branch Two (2)
            $brantwototalsales = Receipt::select('sub_total')->whereDate('transaction_date',$date)->where('branch_id',$branid)->where('status',1)->sum('sub_total');
            $brantwototalsales = json_decode(json_encode($brantwototalsales));
    
            return $brantwototalsales;
        
        }
    }





    // Sales For Branch Three (3)
    public static function branthreetotalsales(){
        // Get Branch Details
        $branchdetails = Branches::where('status',4)->first();
        $branchdetails = json_decode(json_encode($branchdetails));
        // echo "<pre>"; print_r($branchdetails); die;
        
        if(!empty($branchdetails)){
            
            $branid = $branchdetails->id;
            // echo "<pre>"; print_r($branid); die;
    
            // Get Today's Date
            $date = date("Y-m-d");
    
            // Calculate Total Sales For Branch Three (3)
            $branthreetotalsales = Receipt::select('sub_total')->whereDate('transaction_date',$date)->where('branch_id',$branid)->where('status',1)->sum('sub_total');
            $branthreetotalsales = json_decode(json_encode($branthreetotalsales));
    
            // echo "<pre>"; print_r($branthreetotalsales); die;
    
            return $branthreetotalsales;
        }
    }

    
    
    

    // Sales For Branch Four (4)
    public static function branfourtotalsales(){
        // Get Branch Details
        $branchdetails = Branches::where('status',5)->first();
        $branchdetails = json_decode(json_encode($branchdetails));
        // echo "<pre>"; print_r($branchdetails); die;

        if(!empty($branchdetails)){
            
            $branid = $branchdetails->id;
            // echo "<pre>"; print_r($branid); die;
            
            // Get Today's Date
            $date = date("Y-m-d");
    
            // Calculate Total Sales For Branch Four (4)
            $branfourtotalsales = Receipt::select('sub_total')->whereDate('transaction_date',$date)->where('branch_id',$branid)->where('status',1)->sum('sub_total');
            $branfourtotalsales = json_decode(json_encode($branfourtotalsales));
            // echo "<pre>"; print_r($branfourtotalsales); die;
            
            return $branfourtotalsales;
        }
    }





    // Sales For Branch Five (5)
    public static function branfivetotalsales(){
        // Get Branch Details
        $branchdetails = Branches::where('status',6)->first();
        $branchdetails = json_decode(json_encode($branchdetails));
        // echo "<pre>"; print_r($branchdetails); die;
        
         if(!empty($branchdetails)){
             
            $branid = $branchdetails->id;
            // echo "<pre>"; print_r($branid); die;
            
            // Get Today's Date
            $date = date("Y-m-d");
    
            // Calculate Total Sales For Branch Five (5)
            $branfivetotalsales = Receipt::select('sub_total')->whereDate('transaction_date',$date)->where('branch_id',$branid)->where('status',1)->sum('sub_total');
            $branfivetotalsales = json_decode(json_encode($branfivetotalsales));
            // echo "<pre>"; print_r($branfivetotalsales); die;
            
            return $branfivetotalsales;
         }

    }






    // Sales For Branch Six (6)
    public static function bransixtotalsales(){
        // Get Branch Details
        $branchdetails = Branches::where('status',7)->first();
        $branchdetails = json_decode(json_encode($branchdetails));
        // echo "<pre>"; print_r($branchdetails); die;

        if(!empty($branchdetails)){
            
            $branid = $branchdetails->id;
            // echo "<pre>"; print_r($branid); die;
            
            // Get Today's Date
            $date = date("Y-m-d");
    
            // Calculate Total Sales For Branch Six (6)
            $bransixtotalsales = Receipt::select('sub_total')->whereDate('transaction_date',$date)->where('branch_id',$branid)->where('status',1)->sum('sub_total');
            $bransixtotalsales = json_decode(json_encode($bransixtotalsales));
            // echo "<pre>"; print_r($bransixtotalsales); die;
            
            return $bransixtotalsales;
        }
    }

}
