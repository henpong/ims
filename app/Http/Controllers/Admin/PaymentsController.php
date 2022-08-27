<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expenses;
use App\Models\User;
use App\Models\Creditor;
use App\Models\Customers;
use App\Models\Products;
use App\Models\TempTrans;
use App\Models\Terms;
use App\Models\Sales;
use App\Models\SalesDetails;
use App\Models\Payments;
use App\Models\Receipt;
use App\Models\Cashbooks;
use Session;

class PaymentsController extends Controller
{
    
    
    // Credit Paid
    public function creditPaid(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            
            // Get Branch Of The User Doing The Transaction
            $admin = Auth::guard('admin')->user();
            $admin = json_decode(json_encode($admin));
            $userId = $admin->id;
            $branchid = $admin->branchId;






             //Make Rules & Custom Messages For Validation
             $rules = [
                'payment_made' => 'required',
            ];
            $customMessages = [
                'payment_made.required' => 'Sorry,  Amount Being Paid field is required',

            ];
            $this->validate($request,$rules,$customMessages);


            $paymentid = $data['payment_id'];
            // echo "<pre>"; print_r($paymentid); die;
            $payment = $data['payment_made'];
            $salesid = $data['sales_id'];
            $date = date("Y-m-d H:i:s");
            

            // Check Whether The Amount Entered Is Equal To The Amount Due
            $amtDue = Payments::with(['branch','sales'])->where('id',$paymentid)->where('branch_id',$branchid)->where('sales_id',$salesid)->where('status','Not Paid')->first()->due;
            // echo "<pre>"; print_r($amtDue); die;

            if($payment < $amtDue){

                Session::flash('error_message','Sorry, the amount entered is not equal to the amount due for this month.  Please enter the amount due or more');
                return redirect()->back();

            }elseif($payment == $amtDue){


                // Check Whether This Is The Final Payment Of The Credit
                $amtDueCount = Payments::with(['branch','sales'])->where('branch_id',$branchid)->where('sales_id',$salesid)->where('payment',0)->where('status','Not Paid')->count();
                // echo "<pre>"; print_r($amtDueCount); die;


                if($amtDueCount == 1){

                    // Update Payments Table
                    Payments::where('id',$paymentid)->where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->update(['payment'=>$payment,'status'=>'Final Payment','paid_date'=>$date]);

                    SalesDetails::where('branch_id',$branchid)->where('sales_id',$salesid)->where('customer_id',$id)->update(['status'=>2]);

                    Session::flash('success_message','Congrats, final payment received. Thank you for doing business with us.');
                    return redirect()->back();


                }else{

                    // Update Payments Table
                    Payments::where('id',$paymentid)->where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->update(['payment'=>$payment,'status'=>'Part Payment','paid_date'=>$date]);

                    
                    Session::flash('success_message','Congrats, payment received for this month. Thank you for doing business with us.');
                    return redirect()->back();


                }



            }elseif($payment > $amtDue){

                // Check Whether This Is The Final Payment Of The Credit
                $amtDueCounts = Payments::with(['branch','sales'])->where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('payment',0)->where('status','Not Paid')->count();
                // echo "<pre>"; print_r($amtDueCounts); die;

                // Check Total Sum For Two Or More Months
                if($amtDueCounts == 2){

                    $totalAmt = Payments::with(['branch','sales'])->where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('payment',0)->where('status','Not Paid')->sum('due');
                    // echo "<pre>"; print_r($totalAmt); die;

                    if($payment != $totalAmt){

                        Session::flash('error_message','Sorry, the amount entered cannot pay for 2 or more months.  Please enter the amount due for this month or add the remaining amount to clear debt.');
                        return redirect()->back();

                    }elseif($payment == $totalAmt){

                        // Devide The Total Amount By The Number Of Months Remaining
                        $totalAmtForMonth = ($payment/$amtDueCounts);
                        // echo "<pre>"; print_r($totalAmtForMonth); die;


                        // Insert Each Amount For Every Month
                        for($i=1; $i <= $amtDueCounts; $i++){

                            // echo "<pre>"; print_r($i); die;

                            
                                // Update Payments Table
                                Payments::where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('payment',0)->update(['payment'=>$totalAmtForMonth,'status'=>'Final Payment','paid_date'=>$date]);

                                SalesDetails::where('branch_id',$branchid)->where('sales_id',$salesid)->where('customer_id',$id)->update(['status'=>2]);


                        }

                        
                                Session::flash('success_message','Congrats, final payment received. Thank you for doing business with us.');
                                return redirect()->back();

                    }

                }elseif($amtDueCounts == 3){

                     $totalAmt = Payments::with(['branch','sales'])->where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('payment',0)->where('status','Not Paid')->sum('due');
                    // echo "<pre>"; print_r($totalAmt); die;

                    if($payment != $totalAmt){

                        Session::flash('error_message','Sorry, the amount entered cannot pay for 3 or more months.  Please enter the amount due for this month or add the remaining amount to clear debt.');
                        return redirect()->back();

                    }elseif($payment == $totalAmt){

                        // Devide The Total Amount By The Number Of Months Remaining
                        $totalAmtForMonth = ($payment/$amtDueCounts);
                        // echo "<pre>"; print_r($totalAmtForMonth); die;


                        // Insert Each Amount For Every Month
                        for($i=1; $i <= $amtDueCounts; $i++){

                            // echo "<pre>"; print_r($i); die;

                            
                                // Update Payments Table
                                Payments::where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('payment',0)->update(['payment'=>$totalAmtForMonth,'status'=>'Final Payment','paid_date'=>$date]);

                                SalesDetails::where('branch_id',$branchid)->where('sales_id',$salesid)->where('customer_id',$id)->update(['status'=>2]);


                        }

                        
                                Session::flash('success_message','Congrats, final payment received. Thank you for doing business with us.');
                                return redirect()->back();

                    }


                }elseif($amtDueCounts == 4){

                     $totalAmt = Payments::with(['branch','sales'])->where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('payment',0)->where('status','Not Paid')->sum('due');
                    // echo "<pre>"; print_r($totalAmt); die;

                    if($payment != $totalAmt){

                        Session::flash('error_message','Sorry, the amount entered cannot pay for 4 or more months.  Please enter the amount due for this month or add the remaining amount to clear debt.');
                        return redirect()->back();

                    }elseif($payment == $totalAmt){

                        // Devide The Total Amount By The Number Of Months Remaining
                        $totalAmtForMonth = ($payment/$amtDueCounts);
                        // echo "<pre>"; print_r($totalAmtForMonth); die;


                        // Insert Each Amount For Every Month
                        for($i=1; $i <= $amtDueCounts; $i++){

                            // echo "<pre>"; print_r($i); die;

                            
                                // Update Payments Table
                                Payments::where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('payment',0)->update(['payment'=>$totalAmtForMonth,'status'=>'Final Payment','paid_date'=>$date]);

                                SalesDetails::where('branch_id',$branchid)->where('sales_id',$salesid)->where('customer_id',$id)->update(['status'=>2]);


                        }

                        
                                Session::flash('success_message','Congrats, final payment received. Thank you for doing business with us.');
                                return redirect()->back();

                    }

                    
                }elseif($amtDueCounts == 5){

                     $totalAmt = Payments::with(['branch','sales'])->where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('payment',0)->where('status','Not Paid')->sum('due');
                    // echo "<pre>"; print_r($totalAmt); die;

                    if($payment != $totalAmt){

                        Session::flash('error_message','Sorry, the amount entered cannot pay for 5 or more months.  Please enter the amount due for this month or add the remaining amount to clear debt.');
                        return redirect()->back();

                    }elseif($payment == $totalAmt){

                        // Devide The Total Amount By The Number Of Months Remaining
                        $totalAmtForMonth = ($payment/$amtDueCounts);
                        // echo "<pre>"; print_r($totalAmtForMonth); die;


                        // Insert Each Amount For Every Month
                        for($i=1; $i <= $amtDueCounts; $i++){

                            // echo "<pre>"; print_r($i); die;

                            
                                // Update Payments Table
                                Payments::where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('payment',0)->update(['payment'=>$totalAmtForMonth,'status'=>'Final Payment','paid_date'=>$date]);

                                SalesDetails::where('branch_id',$branchid)->where('sales_id',$salesid)->where('customer_id',$id)->update(['status'=>2]);


                        }

                        
                                Session::flash('success_message','Congrats, final payment received. Thank you for doing business with us.');
                                return redirect()->back();

                    }

                    
                }elseif($amtDueCounts == 6){

                     $totalAmt = Payments::with(['branch','sales'])->where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('payment',0)->where('status','Not Paid')->sum('due');
                    // echo "<pre>"; print_r($totalAmt); die;

                    if($payment != $totalAmt){

                        Session::flash('error_message','Sorry, the amount entered cannot pay for 6 or more months.  Please enter the amount due for this month or add the remaining amount to clear debt.');
                        return redirect()->back();

                    }elseif($payment == $totalAmt){

                        // Devide The Total Amount By The Number Of Months Remaining
                        $totalAmtForMonth = ($payment/$amtDueCounts);
                        // echo "<pre>"; print_r($totalAmtForMonth); die;


                        // Insert Each Amount For Every Month
                        for($i=1; $i <= $amtDueCounts; $i++){

                            // echo "<pre>"; print_r($i); die;

                            
                                // Update Payments Table
                                Payments::where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('payment',0)->update(['payment'=>$totalAmtForMonth,'status'=>'Final Payment','paid_date'=>$date]);

                                SalesDetails::where('branch_id',$branchid)->where('sales_id',$salesid)->where('customer_id',$id)->update(['status'=>2]);


                        }

                        
                                Session::flash('success_message','Congrats, final payment received. Thank you for doing business with us.');
                                return redirect()->back();

                    }

                    
                }



            }


            return redirect('admin/credit_account_summary/'.$id);
        }
    }






    // Credit Paid Details
    public function creditPaidDetails(Request $request){
       
        $metaTitle = " Credit Paid Details | CHIBOY ENTERPRISE";

        // $userId = session('user')['userid'];
        // $branchid = session('user')['branchid'];

        $date = date("Y-m-d");


        $creditpaiddetail = Payments::with(['branch','customers'])->whereDate('paid_date',$date)->orderBy('id','DESC')->get();
            
        // echo "<pre>"; print_r($creditpaiddetail); die;


        return view('layouts.admin.creditors.credit_paid_details')->with(compact('metaTitle','creditpaiddetail'));
    }





    // Open Cashbook
    public function cashbook(Request $request){
        $metaTitle = "Cash Book | CHIBOY ENTERPRISE";


        $cashbooks = Cashbooks::with(['branch','user'])->orderBy('id','DESC')->get();

        return view('layouts.admin.cashbook.cashbook')->with(compact('metaTitle', 'cashbooks'));
    }


}
