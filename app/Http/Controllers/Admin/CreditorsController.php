<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\User;
use App\Models\SalesDetails;
use App\Models\Payments;
use Session;




class CreditorsController extends Controller
{
       
    //Get All Credit Requests
    public function creditrequest(Request $request){
        Session::put('page','creditrequest');
        $metaTitle = "Creditors | CHIBOY ENTERPRISE";
        $creditors = Customers::with(['users','branch'])->where('credit_status','<>','')->where('status',2)->orderBy('credit_status','DESC')->get();
        
        // $creditors = json_decode(json_encode($creditors));
        // echo "<pre>"; print_r($creditors); die;

        return view('layouts.admin.stocks.creditors')->with(compact('creditors','metaTitle'));
    }



    // Update Credit Requests
    public function updatecreditrequest(Request $request,$id){
        if($request->isMethod('POST')){
            $data = $request->all();
 
            // echo "<pre>"; print_r($data); die;

            $requestId = $data['request_id'];
            $branchId = $data['branch_id'];
            $requestStatus = $data['request_status'];

            $approvMSG = "Congrats, You Have Approved The Request!!";
            $rejectMSG = "Sorry, You Have Rejected The Request!!";
            $pendMSG = "Ooh No, The Request Is Still Pending!!";

            if($requestStatus == "Approved"){

                Customers::where('id',$data['request_id'])->where('branch_id',$branchId)->update(['credit_status'=>$data['request_status'] ]);

                session::flash('success_message',$approvMSG);
                return redirect('admin/credit_requests');

            }elseif($requestStatus == "Rejected"){

                Customers::where('id',$data['request_id'])->where('branch_id',$branchId)->update(['credit_status'=>$data['request_status'] ]);

                session::flash('error_message',$rejectMSG);
                return redirect('admin/credit_requests');

            }elseif($requestStatus == "Pending"){

                Customers::where('id',$data['request_id'])->where('branch_id',$branchId)->update(['credit_status'=>$data['request_status'] ]);

                session::flash('error_message',$pendMSG);
                return redirect('admin/credit_requests');

            }else{

                session::flash('error_message','Sorry! No option was selected. Please select an option.');
                return redirect('admin/credit_requests');

            }

            
        }
    }



        // Redirect to Creditors Table
        public function creditors(){
            $metaTitle = "Creditors | CHIBOY ENTERPRISE";
            
            // Get Branch Of The User Doing The Transaction
            // Get Branch Id
    
            // $userId = session('user')['userid'];
            // $branchid = session('user')['branchid'];
    
    
            $creditors = Customers::with(['users','branch'])->where('status',2)->orderBy('id','DESC')->get();
    
            // dd($creditors); die;
    
            return view('layouts.admin.creditors.creditors')->with(compact('metaTitle','creditors'));
        }




        // Creditor's Book / Account Summary
        public function creditorsbook(Request $request, $id){
            $metaTitle = "Creditors' Account | CHIBOY ENTERPRISE";

            // Get Branch Of The User Doing The Transaction
            // $userId = session('user')['userid'];
            // $branchid = session('user')['branchid'];
            // dd($branchid); die;


            // Get Customer Details And Balance
            $custdetails = Customers::where('id',$id)->where('status',2)->first();


            // Calculate for Creditor's Balance
            // Amount Due
            $due = Payments::with(['branch','sales','customers'])->where('cust_id',$id)->where('status',"Not Paid")->sum('due');        
            // Payments Made
            $payments = Payments::with(['branch','sales','customers'])->where('cust_id',$id)->where('status',"Not Paid")->sum('payment');
            
            // Balance
            $custbalance = $due - $payments;
            // echo "<pre>"; print_r($custbalance); die;



            $creditorbook = SalesDetails::with(['branch','products','sales','customers'])->where('customer_id',$id)->where('status',1)->orderBy('id','DESC')->get();
            $creditorbook = json_decode(json_encode($creditorbook));

            // echo "<pre>"; print_r($creditorbook); die;

            $subtotal = 0;

            foreach($creditorbook as $credit){
                $qty = $credit->qty;
                $price = $credit->newprice;
                $total = $qty * $price;

                // Calculate for total 
                $subtotal += $total;
            }

            
            // $subtotal = json_decode(json_encode($subtotal));

            // echo "<pre>"; print_r($subtotal); die;



            // Get Transaction Details
            $credithistory = SalesDetails::with(['branch','products','sales','customers','payments'])->where('customer_id',$id)->where('status',2)->orderBy('id','DESC')->get();
            $credithistory = json_decode(json_encode($credithistory));

            // echo "<pre>"; print_r($credithistory); die;



            // Get All Payments
            $payments = Payments::with(['branch','customers','sales'])->where('cust_id',$id)->orderBy('id','DESC')->get();
            $payments = json_decode(json_encode($payments));
            // echo "<pre>"; print_r($payments); die;


            return view('layouts.admin.creditors.creditaccountsummary',['subtotal'=>$subtotal])->with(compact('metaTitle','custdetails','creditorbook','custbalance','credithistory','payments'));
        }


}
