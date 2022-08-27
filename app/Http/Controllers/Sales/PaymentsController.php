<?php

namespace App\Http\Controllers\Sales;

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
       // Daily Expenses
       public function expenses(){
        $metaTitle = "Expenses | CHIBOY ENTERPRISE";

        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];


        $date = date("Y-m-d");


        $expenses = Expenses::with('branch','user')->whereDate('expense_date',$date)->where('branch_id',$branchid)->where('status',1)->orderBy('id','DESC')->get();
            
        // dd($expenses); die;

        return view('layouts.sales.expenses.expenses')->with(compact('metaTitle','expenses'));
    }





    // Add Expenses
    public function addexpense(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;

            // Get Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];



            $expdate = date("Y-m-d  H:i:s");
            $expdated = date("Y-m-d");


            // Prevent Double Entries
            $getExpen = Expenses::where('branch_id', $branchid)->where('description',$data['description'])
                        ->where('amount',$data['amount'])->whereDate('expense_date',$expdated)->count();

                        // dd($getExpen); die;
            
            if($getExpen > 0 ){

                Session::flash('error_message','Sorry, you have entered this expenses already.  kindly check the entries well and try again.');
                return redirect()->back();

            }else{


                // Calculate Total Sales For Today
                $totalsales = Receipt::totalsales();
                // echo "<pre>"; print_r($totalsales); die;

                $totalexpenses = Expenses::totalexpenses();
                // echo "<pre>"; print_r($totalexpenses); die;


                // Prevent negative sales
                if(($data['amount'] > $totalsales) || ($totalexpenses > $totalsales) || ($totalsales == 0 )){

                    
                    Session::flash('error_message','Sorry, your sales for today is not enough to make these expenses.');
                    return redirect()->back();

                }else{

                    
                    $expense = new Expenses;
                    $expense->branch_id = $branchid;
                    $expense->user_id = $userId;
                    $expense->description = $data['description'];
                    $expense->amount = $data['amount'];
                    $expense->expense_date = $expdate;
                    $expense->status = 1;
        
                    $expense->save();
        
                    Session::flash("success_message","Record added successfully");
                    return redirect()->back();

                }


            }
            
        }
    }




    // Daily Expenses
    public function expensesdetails(){
        $metaTitle = " Expenses Details | CHIBOY ENTERPRISE";

        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];

        $date = date("Y-m-d");


        $expensesdetail = Expenses::with(['branch','user'])->where('branch_id',$branchid)->where('user_id',$userId)->whereDate('expense_date',$date)->where('status',1)->orderBy('id','DESC')->get();
            
        // echo "<pre>"; print_r($expensesdetail); die;

        return view('layouts.sales.expenses.expensedetail')->with(compact('metaTitle','expensesdetail'));
    }

    
    

    


    // Credit Paid
    public function creditPaid(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            
            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;



             //Make Rules & Custom Messages For Validation
             $rules = [
                'payment_made' => 'required',
            ];
            $customMessages = [
                'payment_made.required' => 'Sorry,  Amount Being Paid field is required',

            ];
            $this->validate($request,$rules,$customMessages);


            $paymentid = $data['payment_id'];
            $payment = $data['payment_made'];
            $salesid = $data['sales_id'];
            $date = date("Y-m-d H:i:s");
            

            // Check Whether The Amount Entered Is Equal To The Amount Due
            $amtDue = Payments::with(['branch','sales'])->where('id',$paymentid)->where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('status','Not Paid')->first()->due;
            // echo "<pre>"; print_r($amtDue); die;

            if($payment < $amtDue){

                Session::flash('error_message','Sorry, the amount entered is not equal to the amount due for this month.  Please enter the amount due or more');
                return redirect()->back();

            }elseif($payment == $amtDue){


                // Check Whether This Is The Final Payment Of The Credit
                $amtDueCount = Payments::with(['branch','sales'])->where('branch_id',$branchid)->where('user_id',$userId)->where('sales_id',$salesid)->where('payment',0)->where('status','Not Paid')->count();
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


            return redirect('sales/credit_account_summary/'.$id);
        }
    }






    // Credit Paid Details
    public function creditPaidDetail(Request $request){
       
        $metaTitle = "Credit Paid Details | CHIBOY ENTERPRISE";

        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];

        $date = date("Y-m-d");


        $creditpaiddetail = Payments::with(['branch','customers'])->where('branch_id',$branchid)->whereDate('paid_date',$date)->orderBy('id','DESC')->get();
            
        // echo "<pre>"; print_r($creditpaiddetail); die;


        return view('layouts.sales.creditors.credit_paid_details')->with(compact('metaTitle','creditpaiddetail'));
    }









    // Open Cashbook
    public function cashbook(Request $request){
        $metaTitle = "Cash Book | CHIBOY ENTERPRISE";

        
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];

        $cashbooks = Cashbooks::with(['branch','user'])->where('branch_id',$branchid)->orderBy('id','DESC')->get();

        return view('layouts.sales.cashbook.cashbook')->with(compact('metaTitle', 'cashbooks'));
    }



    // Add Cash In Hand For Today
    public function addcash(Request $request){

        if($request->isMethod('post')){

            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];

            $data = $request->all();

            // Get Cash Entered
            $cash = $data['amount'];
            // echo "<pre>"; print_r($data); die;


            // Calculate Total Sales For Today
            $totalsales = Receipt::totalsales();
            // echo "<pre>"; print_r($totalsales); die;


            // Calculate Total Expenses For Today
            $totalexpenses = Expenses::totalexpenses();
            // echo "<pre>"; print_r($totalexpenses); die;
            if($totalexpenses == "" || $totalexpenses == 0){

                $totalexpenses = 0;

                // echo "<pre>"; print_r($totalexpenses); die;
            }




            $date = date("Y-m-d");


            // Enter Cash Into System
            
            // Check if the Cash In Hand is equal to the sales minus expenses
            if(($cash != ($totalsales - $totalexpenses))){

                Session::flash('error_message', 'Sorry, the amount entered is NOT equal to today\'s sales');
                return redirect()->back();

            }else{

                $cashCount = Cashbooks::where('branch_id',$branchid)->where('total_sales',$totalsales)->where('total_expenses',$totalexpenses)->where('trans_date',$date)->count();

                // echo "<pre>"; print_r($cashCount); die;

                if($cashCount > 0){

                    Session::flash('error_message', 'Sorry, this amount has been entered already. Kindly check well.');
                    return redirect()->back();

                }else{

                    $cashInHand = new Cashbooks;

                    $cashInHand->user_id = $userId;
                    $cashInHand->branch_id = $branchid;
                    $cashInHand->total_sales = $totalsales;
                    $cashInHand->total_expenses = $totalexpenses;
                    $cashInHand->total_cash = $cash;
                    $cashInHand->trans_date = $date;
                    $cashInHand->status = 1;

                    $cashInHand->save();

                    Session::flash('success_message', 'Cash checked successfully.  Thank you');
                    return redirect()->back();

                }

            }


        }
    }


}
