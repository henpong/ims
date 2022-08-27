<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TemporalCredit;
use App\Models\TemporalCreditDetail;
use App\Models\Products;
use App\Models\Admin;
use Session;

class TemporalCreditController extends Controller
{
       //Fetch Records From Temporal Credit Table
       public function credit(){
        Session::put('page','temporalcredit');
        $metaTitle = "Temporal Transaction Details | CHIBOY ENTERPRISE";
        $tempcredits = TemporalCredit::with(['branch'=>function($query){
            $query->select('id','branch_name');
        },'customers'=>function($query){
            $query->select('id','fullname','customer_contact');
        },'user'=>function($query){
            $query->select('id','name');
        }])->orderBy('id','DESC')->get();

        $tempcredits = json_decode(json_encode($tempcredits));
        // echo "<pre>"; print_r($tempcredits); die;

        return view('layouts.admin.stocks.temporal_credit')->with(compact('tempcredits','metaTitle'));
    }




    // Temporal Credit Details
    
    // View Temporal Credit Transaction Details
    public function temporalcreditdetails(Request $request, $id){
        $metaTitle = "Temporal Transaction Details | CHIBOY ENTERPRISE";
        
        $tempcredits   = TemporalCreditDetail::with(['customers','products','users'])->where('temp_credit_id',$id)->get();
        // echo "<pre>"; print_r($tempcredits); die;

        $customer  = TemporalCreditDetail::with(['customers'=>function($query){
            $query->select('id','fullname','customer_contact');
        }])->where('temp_credit_id',$id)->first();

        // echo "<pre>"; print_r($customer); die;



        return view('layouts.admin.stocks.temporal_credit_details')->with(compact('metaTitle','tempcredits','customer'));
    }


    

    //Make Payment For Temporal Credit
    public function payment(Request $request,$id){
        if($request->isMethod('POST')){
            $data = $request->all();

        //    echo "<pre>"; print_r($data); die;
            
            $tempcreditId = $id;
            $payment_made  =  $data['payment_made'];
            // echo "<pre>"; print_r($paymentId); die;
            $branch_id = $data['branch_id'];
            $customerid = $data['customer_id'];
            $admin = Auth::guard('admin')->user()->name;
            // echo "<pre>"; print_r($admin); die;

            $amtOwned = TemporalCredit::where('customer_id',$customerid)->first()->totalamt;
            
            // echo "<pre>"; print_r($amtOwned); die;


            //Set Condition
            if($payment_made == ""){

                Session::flash("error_message","Sorry, No amount entered. Please enter an amount. ");
                return redirect()->back();

            }elseif($payment_made != $amtOwned){

                Session::flash("error_message","Sorry, the amount entered is not the amount owed.  Please enter the exact amount owed");
                return redirect()->back();

            }else{



            //Update Temporal Credit Table
            $temp =  TemporalCredit::where('customer_id',$customerid)->update(['receivedby'=> $admin, 'amtpaid'=>$payment_made, 'temp_credit_status'=>2]);
            // echo "<pre>"; print_r($temp); die;

            
            // Update Temporal Credit Table
            $custid =  TemporalCredit::where('customer_id',$customerid)->get()->toArray();
            // echo "<pre>"; print_r($custid); die;

            foreach($custid as $custoid){

                $customerId = $custoid['customer_id'];
                $cuId = $custoid['id'];
                $payment = $custoid['amtpaid'];


                $temptrans =   TemporalCreditDetail::where('temp_credit_id',$cuId)->where('customer_id',$customerId)
                                    ->update(['receivedby'=> $admin, 'amtpaid'=>$payment, 'log_status'=>2]);
                // echo "<pre>"; print_r($temptrans); die;

            }



            //Update Products Table
            $updateTemp = TemporalCreditDetail::where('customer_id',$customerid)->get()->toArray();
            // $updateTemp = json_encode(json_decode($updateTemp));
            // echo "<pre>"; print_r($updateTemp); die;

            foreach($updateTemp as $updateTrans){

                         
                // Get Product Qty Sold From Temporal Credit Details
                $temptransbranchid   = $updateTrans['branch_id'];
                $temptransproductid   = $updateTrans['product_id'];
                $temptransqty   = $updateTrans['temp_credit_qty'];
                // echo "<pre>"; print_r($temptransdetail); die;




                //Update Products Table
                $prodQty = Products::where('id',$temptransproductid)->where('branch_id',$temptransbranchid)->first()->product_qty;
                $prodQty = json_encode(json_decode($prodQty));
                // echo "<pre>"; print_r($prodQty); die;
               
                Products::where('id',$temptransproductid)->where('branch_id',$temptransbranchid)
                            ->update(['product_qty'=> ($prodQty - $temptransqty) ]);
                

            }

                Session::flash("success_message","Payment received successfully! Thank you.");
                return redirect('admin/temporal_credit');

            }

        }

    }


}
