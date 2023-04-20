<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Customers;
use App\Models\User;
use App\Models\TempTrans;
use App\Models\TemporalCredit;
use App\Models\Products;
use App\Models\Sales;
use App\Models\SalesDetails;
use App\Models\Payments;
use App\Models\Receipt;
use App\Models\CreditReceipt;




class CustomersController extends Controller
{
       // Redirect to Customers Table
       public function customer(){
        $metaTitle = "Customers | CHIBOY ENTERPRISE";

        
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];


        $customers = Customers::with('branch')->where('branch_id',$branchid)->where('status',1)->orderBy('id','DESC')->get();
            
        // dd($customers); die;
        // echo "<pre>"; print_r($customers); die;

        return view('layouts.sales.customer.customer')->with(compact('metaTitle','customers'));
    }





    // Sales Transaction (Add New Customer)
    public function transaction(Request $request){
        $metaTitle = "Sales Transaction | CHIBOY ENTERPRISE";
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;


            //  Make Rules & Custom Messages For Validation
             $rules = [
                'fname' => 'required'
            ];
            $customMessages = [
                'fname.required' => 'Sorry, full name field is required'
            ];
            $this->validate($request,$rules,$customMessages);

            

                // Get Branch Of The User Doing The Transaction
                $userId = session('user')['userid'];
                $branchid = session('user')['branchid'];


            
                $customer = new Customers;
                $customer->user_id = Auth::guard('user')->user()->id;
                $customer->fullname = $data['fname'];
                $customer->customer_contact = $data['phone'];
                $customer->customer_address = $data['address'];
                $customer->company = $data['company'];
                $customer->branch_id = $branchid;
                $customer->status = 1;
                $customer->save();

                $insertid = $customer->id;

                // dd($insertid); die;
                return redirect('sales/add_transaction/'.$insertid);
            
        }
        return view('layouts.sales.transaction.transaction')->with(compact('metaTitle'));
    }





    // Redirect to Temporal Creditors Table
    public function temp_creditors(){
        $metaTitle = "Temporal Creditors | CHIBOY ENTERPRISE";

        
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];



        $tempcreditors = TemporalCredit::with(['branch'=>function($query){
            $query->select('id','branch_name');
        },'customers'=>function($query){
            $query->select('id','fullname','customer_contact');
        }])->where('branch_id',$branchid)->orderBy('id','DESC')->get()->toArray();
        $tempcreditors = json_decode(json_encode($tempcreditors));
        // echo "<pre>"; print_r($tempcreditors); die;

        return view('layouts.sales.transaction.temp_trans_table')->with(compact('metaTitle','tempcreditors'));
    }




    // Temporal Credit Begins
    public function temp_transaction(Request $request){
        $metaTitle = "Sales Transaction | CHIBOY ENTERPRISE";
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;


            //  Make Rules & Custom Messages For Validation
             $rules = [
                'fname' => 'required',
                'phone' => 'required',
                'address' => 'required'
            ];
            $customMessages = [
                'fname.required' => 'Sorry, full name field is required',
                'phone.required' => 'Sorry, phone number field is required',
                'address.required' => 'Sorry, address or location field is required'
            ];
            $this->validate($request,$rules,$customMessages);

            
            // Check Whether The Customer Already Exists
            $cust = Customers::with('branch')->where('fullname',$data['fname'])->count();
            // dd($cust); die;

            if($cust > 0){

                Session::flash('error_message','Sorry, customer already exists');
                return redirect()->back();

            }else{

                // Get Branch Of The User Doing The Transaction
                $userId = session('user')['userid'];
                $branchid = session('user')['branchid'];


            
                $customer = new Customers;
                $customer->user_id = Auth::guard('user')->user()->id;
                $customer->fullname = $data['fname'];
                $customer->customer_contact = $data['phone'];
                $customer->customer_address = $data['address'];
                $customer->company = $data['company'];
                $customer->branch_id = $branchid;
                $customer->status = 1;
                $customer->save();

                $insertid = $customer->id;

                // dd($insertid); die;
                return redirect('sales/add_temp_transaction/'.$insertid);
            }
        }
        return view('layouts.sales.transaction.temp_transaction')->with(compact('metaTitle'));

    }


































    

    // Redirect to Creditors Table
    public function creditors(){
        $metaTitle = "Creditors | CHIBOY ENTERPRISE";
        
        // Get Branch Of The User Doing The Transaction
        // Get Branch Id

        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];


        $creditors = Customers::with(['users','branch'])->where('branch_id',$branchid)->where('status',2)->orderBy('id','DESC')->get();

        // dd($creditors); die;

        return view('layouts.sales.creditors.creditors')->with(compact('metaTitle','creditors'));
    }






    // Add Credit Request
    public function addcreditor(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;

            // $creditlimit = 500;

             // Get Branch Of The User Doing The Transaction
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // dd($branchid); die;

            $creditDate = date("Y-m-d H:i:s");
            // echo "<pre>"; print_r($creditDate); die;


            
            $countcreditors = Customers::with('branch')->where('fullname',$data['fname'])->where('branch_id',$branchid)->where('status',2)->count();
          

            if($countcreditors > 0){

                $creditorid = Customers::with('branch')->where('fullname',$data['fname'])->where('branch_id',$branchid)->first()->id;
                // dd($creditorid); die;
                
                // Update Customer Table
                Customers::where('id',$creditorid)->where('branch_id', $branchid)->update(['customer_contact'=>$data['phone'], 'credit_status'=>'Pending']);

                Session::flash('success_message','Your application has been resubmitted for approval.  Please wait for your boss response.');
                return redirect('sales/creditors');

            }else{
                 

                // Insert New Creditor
                $creditor = new Customers;
                $creditor->user_id = Auth::guard('user')->user()->id;
                $creditor->fullname = $data['fname'];
                $creditor->customer_address = $data['address'];
                $creditor->customer_contact = $data['phone'];
                $creditor->years = $data['yrsbiz'];
                $creditor->company = $data['company'];
                $creditor->income = $data['bincome'];
                $creditor->guarantor = $data['gname'];
                $creditor->guarantor_contact = $data['gphone'];
                $creditor->branch_id = $branchid;
                $creditor->credit_status = 'Pending';
                $creditor->status = 2;
                $creditor->date_credited = $creditDate;

                $creditor->save();

                Session::flash('success_message','New creditor added successfully!  Your request has been sent for approval.');
                return redirect('sales/creditors');

            }




        }
    }





    // Creditor's Book / Account Summary
    public function creditorsbook(Request $request, $id){
        $metaTitle = "Creditors' Account | CHIBOY ENTERPRISE";

         // Get Branch Of The User Doing The Transaction
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];
        // dd($branchid); die;


        // Get Customer Details And Balance
        $custdetails = Customers::where('id',$id)->where('status',2)->first();
        // echo "<pre>"; print_r($custdetails); die;


        // Calculate for Creditor's Balance
        // Amount Due
        $due = Payments::with(['branch','sales','customers'])->where('branch_id',$branchid)->where('cust_id',$id)->where('status',"Not Paid")->sum('due');        
        // Payments Made
        $payments = Payments::with(['branch','sales','customers'])->where('branch_id',$branchid)->where('cust_id',$id)->where('status',"Not Paid")->sum('payment');
        
        // Balance
        $custbalance = $due - $payments;
        // echo "<pre>"; print_r($custbalance); die;



        $creditorbook = SalesDetails::with(['branch','products','sales','customers'])->where('branch_id',$branchid)->where('customer_id',$id)->where('status',1)->orderBy('id','DESC')->get();
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
        $credithistory = SalesDetails::with(['branch','products','sales','customers','payments'])->where('branch_id',$branchid)->where('customer_id',$id)->where('status',2)->orderBy('id','DESC')->get();
        $credithistory = json_decode(json_encode($credithistory));

        // echo "<pre>"; print_r($credithistory); die;



        // Get All Payments
        $payments = Payments::with(['branch','customers','sales'])->where('branch_id',$branchid)->where('cust_id',$id)->orderBy('id','DESC')->get();
        $payments = json_decode(json_encode($payments));
        // echo "<pre>"; print_r($payments); die;


        return view('layouts.sales.creditors.creditaccountsummary',['subtotal'=>$subtotal])->with(compact('metaTitle','custdetails','creditorbook','custbalance','credithistory','payments'));
    }



 



      // Begin Credit Sales Transaction
     // Add Sales Transaction
    public function addCreditTrans(Request $request,$id){
        $metaTitle = "Add Sales Transaction | CHIBOY ENTERPRISE";
        if($request->isMethod('post')){
            $data = $request->all();


            // dd($data); die;

            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;


            // $customer = Customers::with('branch')->where('branch_id',$branchid)->get();
            // dd($customer); die;

            // Get Product Details
            $productdetail = Products::where('id',$data['productid'])->where('branch_id',$branchid)->first();
            $productdetail = json_decode(json_encode($productdetail),true);
            // echo "<pre>"; print_r($productdetail); die;

            $unitpx = $productdetail['product_price'];
            // echo "<pre>"; print_r($unitpx); die;
            $wholesalepx = $productdetail['product_wholesale_price'];
            $productqty = $productdetail['product_qty'];
            $wholesaleqtypoint = $productdetail['wholesale_qty'];
            // echo "<pre>"; print_r($productqty); die;

            // dd($unitpx); die;

            // Set Condition
            if($productqty <= 0){
                Session::flash('error_message','Sorry, quantity left in your shop is too low to sell.  Please send a stock request.');
                return redirect()->back();
            }else{
                if($data['qty'] > $productqty){
                    Session::flash('error_message','Sorry, quantity entered is more than the quantity in your shop.  Please enter the quantity available.');
                    return redirect()->back();
                }else {
                    if($data['qty'] <= 0){
                        Session::flash('error_message','Sorry, quantity cannot be less than one.  Please enter one and above.');
                        return redirect()->back();
                    }else{

                        if($data['qty'] >= $wholesaleqtypoint){
                            
                            $count = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->count();
                            
                            if($count > 0 ){

                                Session::flash('error_message','Sorry, this product already exist.  Kindly use the Update Button to make the necessary updates.');
                                return redirect()->back();

                                // $tempqty = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->first()->qty;
                                // $tempprice = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->first()->price;

                                // $total = $data['qty'] * $wholesalepx;

                                // // Update Temporal Transaction Table
                                // TempTrans::where('product_id',$data['productid'])->where('branch_id', $branchid)->where('user_id',$userId)->update(['qty'=>$tempqty + $data['qty'], 'price'=>$tempprice + $total]);
                                
                            }else{

                                // Insert Details Into Temporal Transaction
                                $temp = new TempTrans;
                                $temp->product_id = $data['productid'];
                                $temp->branch_id = $branchid;
                                $temp->user_id = $userId;
                                $temp->price = $wholesalepx;
                                $temp->discount = "0.00";
                                $temp->new_price = $wholesalepx;
                                $temp->qty = $data['qty'];
                                $temp->save();
                            }
    
    
                            return redirect()->back();
                            
                        }else{

                            $count = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->count();
    
                            // $retailpx = $unitpx * $data['qty'];
    
                            if($count > 0 ){


                                Session::flash('error_message','Sorry, this product already exist.  Kindly use the Update Button to make the necessary updates.');
                                return redirect()->back();

                                // $tempqty = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->first()->qty;
                                // $tempprice = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->first()->price;

                                // $total = $data['qty'] * $retailpx;
                                // // Update Temporal Transaction Table
                                // TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->update(['qty'=>$tempqty + $data['qty'], 'price'=>$tempprice + $retailpx]);
                                
                            }else{
                                // Insert Details Into Temporal Transaction
                                $temp = new TempTrans;
                                $temp->product_id = $data['productid'];
                                $temp->branch_id = $branchid;
                                $temp->user_id = $userId;
                                $temp->price = $unitpx;
                                $temp->discount = "0.00";
                                $temp->new_price = $unitpx;
                                $temp->qty = $data['qty'];
                                $temp->save();
                            }
    
                            return redirect()->back();
                        }

                    }
                }
            }
            
            
        }

        
          // Get User Id & Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];
        // echo "<pre>"; print_r($branchid); die;


        $insertid = Customers::where('id',$id)->with('branch')->where('branch_id',$branchid)->where('status',2)->first()->id;
        $insertid = json_decode(json_encode($insertid));

        return view('layouts.sales.transaction.add_credit_trans')->with(compact('metaTitle','insertid'));
    }





    
    

    // Update Qty on Credit Sales Transaction
    public function updateCreditQty(Request $request,$id){

        if($request->isMethod('post')){
            $data = $request->all();


            // dd($data); die;


            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;


            // Get Product Details
            $prodrequest = Products::where('id',$data['productid'])->where('branch_id',$branchid)->first();
            $prodrequest = json_decode(json_encode($prodrequest),true);
            // echo "<pre>"; print_r($prodrequest); die;

            $unitprice = $prodrequest['product_price'];
            // echo "<pre>"; print_r($unitpx); die;
            $wholesaleprice = $prodrequest['product_wholesale_price'];
            $prodqty = $prodrequest['product_qty'];
            $wholepoint = $prodrequest['wholesale_qty'];

            
            // Get Old Price
            $dataqty = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->first();
            $dataqty = json_decode(json_encode($dataqty),true);
            // dd($dataqty); die;

            $discou = $dataqty['discount'];


            if( $data['qtypcs'] >= $wholepoint ){

                $newpx = $wholesaleprice - $discou;

                
                // Update Temporal Transaction Table
                TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->update(['price'=>$wholesaleprice, 'qty'=>$data['qtypcs'], 'new_price'=>$newpx ]);
        
            }else{

                
                $retailpx = $unitprice - $discou;

                // Update Temporal Transaction Table
                TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->update(['price'=>$unitprice, 'qty'=>$data['qtypcs'], 'new_price'=>$retailpx]);
        
            }


            
            return redirect('sales/credit_transaction/'.$data['insertid']);
                
        }

    }



    

    // Update Discount on Credit Sales Transaction
    public function updateCreditDiscount(Request $request,$id){

        if($request->isMethod('post')){
            $data = $request->all();


            // dd($data); die;


            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;


            // Check Whether Discount is Less Than Zero
            if($data['discount'] < 0){

                Session::flash('error_message','Sorry, discount cannot be less than zero.  Please enter an amount from zero upwards.');
                return redirect('sales/add_transaction/'.$data['insertid']); 
                
            }else{

                
                // Set Condition On Discount
                if($data['discount'] > 0){

                    // Update New Price
                    $price = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->first()->price;
                    // dd($price); die;

                    // Calculate For New Price
                    $newprice = $price - $data['discount'];


                    // Update Temporal Transaction Table
                    TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->update(['discount'=>$data['discount'],'new_price'=>$newprice]);
                
                }elseif($data['discount'] == 0){

                    // Update New Price
                    $price = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->first()->price;
                    // dd($price); die;

                    // Calculate For New Price
                    $newprice = $price - $data['discount'];


                    // Update Temporal Transaction Table
                    TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->update(['discount'=>$data['discount'],'new_price'=>$newprice]);
                
                }

                return redirect('sales/credit_transaction/'.$data['insertid']);

            } 
                
        }

    }







     // Delete Credit Transaction
     public function deleteCreditTrans(Request $request,$id){

        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;

            $insertid = $data['insertid'];

            

            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;


            TempTrans::where('id',$data['id'])->where('branch_id',$branchid)->delete();

            $message = "Product deleted successfully!";

            session::flash('success_message',$message);
            return redirect('sales/credit_transaction/'.$insertid);
        }
    
    }





    // Cancel Credit Transaction
    public function cancelCreditTrans(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die; 

            

            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;


            $customerid = Customers::where('id',$id)->with('branch')->where('branch_id',$branchid)->where('status',2)->first()->id;

            $checkTempTrans = TempTrans::where('branch_id',$branchid)->count();

            if($checkTempTrans > 0){

                $temps = TempTrans::with('branch')->where('branch_id',$branchid)->get();
                $temps = json_decode(json_encode($temps));
                // echo "<pre>"; print_r($temps); die;
                foreach($temps as $trans){
                    // echo "<pre>"; print_r($trans->id); die;
    
                    $transId = $trans->id;
                    $productid = $trans->product_id;
                   
                }

                TempTrans::where('id',$transId)->where('product_id',$productid)->delete();
                // Customers::where('id',$customerid)->->where('status',2)->delete();
            }else{
                
                Customers::where('id',$customerid)->where('status',2)->delete();
            }

            Session::flash('success_message','Credit transaction canceled successfully.');

            return redirect('sales/creditors/');
        }
    }






    // Complete Credit Transaction
    public function completeCreditTrans(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;
            

            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;




            

             //Make Rules & Custom Messages For Validation
             $rules = [
                'creditsubTotalValue' => 'required',
                'creditDiscount' => 'required',
                'partpay' => 'required',
                'amtdueValue' => 'required',
                'duration' => 'required',
                'payDays' => 'required'
            ];
            $customMessages = [
                'creditsubTotalValue.required' => 'Sorry,  Sub Total field is required',
                'creditDiscount.required' => 'Sorry,  Discount field is required',
                'partpay.required' => 'Sorry,  part payment field is required',
                'amtdueValue.required' => 'Sorry,  Amount Due field is required',
                'duration.required' => 'Sorry,  Payment Terms field is required',
                'payDays.required' => 'Sorry,  Payable For field is required',

            ];
            $this->validate($request,$rules,$customMessages);


            
            $insertid = $data['insertid'];
            $subTotal = $data['creditsubTotalValue'];
            $discount = $data['creditDiscount'];
            $grandTotal = $subTotal - $discount;
            $partpayment = $data['partpay'];
            $amountdue = $data['amtdueValue'];
            $duration = $data['duration'];
            $payabledays = $data['payDays'];
            $duedate = date("Y-m-d", strtotime(" + $payabledays months"));
            $date = date("Y-m-d H:i:s");
 

            // Insert Details Into Sales Table
            $sales = new Sales;
            
            $sales->cust_id = $insertid;
            $sales->user_id = $userId;
            $sales->branch_id = $branchid;
            $sales->cash_paid = $partpayment;
            $sales->discount = $discount;
            $sales->sub_total = $subTotal;
            $sales->amount_due = $amountdue;
            $sales->cash_change = 0;
            $sales->date_added = $date;
            $sales->modeofpayment = 'Credit';
            $sales->payment_status = 'Part Payment';

            $sales->save();
            // Generate Sales Id
            $salesId = $sales->id;

            // echo "<pre>"; print_r($salesId); die;




             $creditpaycount = Payments::select('or_no')->with(['sales','branch'])->where('branch_id',$branchid)->count();
            // dd($creditpaycount); die;

            $num = 9110001;

            // Set Condition For Payment
            if($creditpaycount <= 0){
                $receiptnum = 'IMSCHB-'.$num;
            }else{

                $newcode = Payments::select('or_no')->with(['sales','branch'])->where('branch_id',$branchid)->latest()->value('or_no');
                $num = explode('-',$newcode,2);
                $receiptnum = $num[0]."-". ($num[1] + 1);
            }
            // dd($receiptnum); die;
            
          

            // Insert Details Into Payments Table
            $payment = new Payments;
            $payment->user_id = $userId;
            $payment->cust_id = $insertid;
            $payment->sales_id = $salesId;
            $payment->branch_id = $branchid;
            $payment->payment = $partpayment;
            $payment->due = $amountdue;
            $payment->payment_date = $date;
            $payment->payment_for = $payabledays;
            $payment->or_no = $receiptnum;
            $payment->status = 'Part Payment';
            $payment->paid_date = $date;

            $payment->save();
            // Generate Payment Id
            $paymentid = $payment->id;


            
            // Update Sales Table
            Sales::where('cust_id',$insertid)->where('branch_id', $branchid)->update(['cash_paid'=> $partpayment,'discount'=> $discount,'amount_due'=> $amountdue,'sub_total'=> $subTotal]);





            $checks = TempTrans::where('branch_id',$branchid)->where('user_id',$userId)->get();
            foreach($checks as $check){
                // echo "<pre>"; print_r($check->qty); die;

                $qty = $check->qty;
                $productid = $check->product_id;
                $price = $check->price;
                $discount = $check->discount;


                // Now Insert Into Sales Details
                $salesDetails = new SalesDetails;
                $salesDetails->sales_id = $salesId;
                $salesDetails->customer_id = $insertid;
                $salesDetails->payment_id = $paymentid;
                $salesDetails->product_id = $productid;
                $salesDetails->branch_id = $branchid;
                $salesDetails->qty = $qty;
                $salesDetails->price = $price;
                $salesDetails->discount = $discount;
                $salesDetails->newprice = $price - $discount;
                $salesDetails->status = 1;

                $salesDetails->save();

                $productQty = Products::with('branch')->where('id',$productid)->where('branch_id',$branchid)->first()->product_qty;

                // Update Products Table 
                Products::with('branch')->where('id',$productid)->where('branch_id',$branchid)->update(['product_qty'=>($productQty - $qty)]);

                

            }





            // Generate Credit Receipt Id & Insert Details Into Payments Table
               

            // Calculate The Amount To Pay Every Month
            if($duration == 'Monthly'){
                // Monthly Amount To Pay
                if($payabledays == 1){

                    $amttopay = ($amountdue/1);
                    // $amttopay = number_format($amttopay,2);

                    
                    for($i=1; $i<=$payabledays; $i++){
                        $newduedate = date("Y-m-d", strtotime($date. " + $i month(s)"));

                        // Insert Details Into Payments Table
                        $payment = new Payments;
                        $payment->user_id = $userId;
                        $payment->cust_id = $insertid;
                        $payment->sales_id = $salesId;
                        $payment->branch_id = $branchid;
                        $payment->payment = 0.00;
                        $payment->due = $amttopay;
                        $payment->payment_date = $newduedate;
                        $payment->payment_for = $payabledays;
                        $payment->or_no = $receiptnum;
                        $payment->status = 'Not Paid';

                        $payment->save();

                    }

                }elseif($payabledays == 2){

                    
                    $amttopay = ($amountdue/2);
                    // $amttopay = number_format($amttopay,2);


                    for($i=1; $i<=$payabledays; $i++){
                        $newduedate = date("Y-m-d", strtotime($date. " + $i month(s)"));

                        // Insert Details Into Payments Table
                        $payment = new Payments;
                        $payment->user_id = $userId;
                        $payment->cust_id = $insertid;
                        $payment->sales_id = $salesId;
                        $payment->branch_id = $branchid;
                        $payment->payment = 0.00;
                        $payment->due = $amttopay;
                        $payment->payment_date = $newduedate;
                        $payment->payment_for = $payabledays;
                        $payment->or_no = $receiptnum;
                        $payment->status = 'Not Paid';

                        $payment->save();

                    }


                }elseif($payabledays == 3){

                    
                    $amttopay = ($amountdue/3);
                    // $amttopay = number_format($amttopay,2);
                    

                    for($i=1; $i<=$payabledays; $i++){
                        $newduedate = date("Y-m-d", strtotime($date. " + $i month(s)"));

                        // Insert Details Into Payments Table
                        $payment = new Payments;
                        $payment->user_id = Auth::guard('user')->user()->id;
                        $payment->cust_id = $insertid;
                        $payment->sales_id = $salesId;
                        $payment->branch_id = $branchid;
                        $payment->payment = 0.00;
                        $payment->due = $amttopay;
                        $payment->payment_date = $newduedate;
                        $payment->payment_for = $payabledays;
                        $payment->or_no = $receiptnum;
                        $payment->status = 'Not Paid';

                        $payment->save();

                    }
                }elseif($payabledays == 4){

                    
                    $amttopay = ($amountdue/4);
                    // $amttopay = number_format($amttopay,2);
                    

                    for($i=1; $i<=$payabledays; $i++){
                        $newduedate = date("Y-m-d", strtotime($date. " + $i month(s)"));

                        // Insert Details Into Payments Table
                        $payment = new Payments;
                        $payment->user_id = $userId;
                        $payment->cust_id = $insertid;
                        $payment->sales_id = $salesId;
                        $payment->branch_id = $branchid;
                        $payment->payment = 0.00;
                        $payment->due = $amttopay;
                        $payment->payment_date = $newduedate;
                        $payment->payment_for = $payabledays;
                        $payment->or_no = $receiptnum;
                        $payment->status = 'Not Paid';

                        $payment->save();

                    }
                }elseif($payabledays == 5){

                    
                    $amttopay = ($amountdue/5);
                    // $amttopay = number_format($amttopay,2);
                    

                    for($i=1; $i<=$payabledays; $i++){
                        $newduedate = date("Y-m-d", strtotime($date. " + $i month(s)"));

                        // Insert Details Into Payments Table
                        $payment = new Payments;
                        $payment->user_id = $userId;
                        $payment->cust_id = $insertid;
                        $payment->sales_id = $salesId;
                        $payment->branch_id = $branchid;
                        $payment->payment = 0.00;
                        $payment->due = $amttopay;
                        $payment->payment_date = $newduedate;
                        $payment->payment_for = $payabledays;
                        $payment->or_no = $receiptnum;
                        $payment->status = 'Not Paid';

                        $payment->save();

                    }
                }elseif($payabledays == 6){

                    
                    $amttopay = ($amountdue/6);
                    // $amttopay = number_format($amttopay,2);
                    

                    for($i=1; $i<=$payabledays; $i++){
                        $newduedate = date("Y-m-d", strtotime($date. " + $i month(s)"));

                        // Insert Details Into Payments Table
                        $payment = new Payments;
                        $payment->user_id = $userIdd;
                        $payment->cust_id = $insertid;
                        $payment->sales_id = $salesId;
                        $payment->branch_id = $branchid;
                        $payment->payment = 0.00;
                        $payment->due = $amttopay;
                        $payment->payment_date = $newduedate;
                        $payment->payment_for = $payabledays;
                        $payment->or_no = $receiptnum;
                        $payment->status = 'Not Paid';

                        $payment->save();

                    }
                }

            }else{

                // Daily Amount To Pay
                $amttopay = ($amountdue/1);
                // $amttopay = number_format($amttopay,2);
                

                for($i=1; $i<=1; $i++){
                    $newduedate = date("Y-m-d", strtotime($date. " + 21 Day(s)"));

                    // Insert Details Into Payments Table
                    $payment = new Payments;
                    $payment->user_id = $userId;
                    $payment->cust_id = $insertid;
                    $payment->sales_id = $salesId;
                    $payment->branch_id = $branchid;
                    $payment->payment = 0.00;
                    $payment->due = $amttopay;
                    $payment->payment_date = $newduedate;
                    $payment->payment_for = $payabledays;
                    $payment->or_no = $receiptnum;
                    $payment->status = 'Not Paid';

                    $payment->save();

                }

            }



            


            // Get Customer Details
            $custdetails = Sales::with(['branch','customers'])->where('id',$salesId)->where('branch_id', $branchid)->first();
            $custdetails = json_decode(json_encode($custdetails));

            $customerName = $custdetails->customers->fullname;
            $customerFon = $custdetails->customers->customer_contact;
            $customerAddress = $custdetails->customers->customer_address;
            $company = $custdetails->customers->company;
            
            // dd($company); die;
             

            // Now Insert Into Receipt Table
            $invoice = TempTrans::where('branch_id',$branchid)->where('user_id',$userId)->get();

            foreach($invoice as $receipt){
                // echo "<pre>"; print_r($receipt->qty); die;

                
                
                $productid = $receipt->product_id;
                $qty = $receipt->qty;
                $price = $receipt->price;
                $username = Auth::guard('user')->user()->name;
                $discount = $receipt->discount;
                $newprx = $price - $discount;
                $total = $qty * $newprx;

			
            
                // Now Insert Into Receipt Table
                $salesreceipt = new Receipt;
                $salesreceipt->user_name = $username;
                $salesreceipt->customer_id = $insertid;
                $salesreceipt->branch_id = $branchid;
                $salesreceipt->sales_id = $salesId;
                $salesreceipt->user_id = $userId;
                $salesreceipt->receipt_no = $receiptnum;
                $salesreceipt->customer_name = $customerName;
                $salesreceipt->customer_address = $customerAddress;
                $salesreceipt->customer_fon = $customerFon;
                $salesreceipt->company = $company;
                $salesreceipt->transaction_date = $date;
                $salesreceipt->product_id = $productid;
                // $salesreceipt->product_name = $productName;
                $salesreceipt->qty_bought = $qty;
                $salesreceipt->price = $price;
                $salesreceipt->discount = $discount;
                $salesreceipt->newprice = $newprx;
                $salesreceipt->sub_total = $total;
                $salesreceipt->cash_paid = $partpayment;
                $salesreceipt->amt_due = $amountdue;
                $salesreceipt->amt_change = 0;
                $salesreceipt->pay_type = "Credit";
                $salesreceipt->pay_status = "Part Payment";
                $salesreceipt->status = 2;

                $salesreceipt->save();


                // Delete From Temp Trans Table
                TempTrans::where('branch_id',$branchid)->where('product_id',$productid)->where('user_id',$userId)->delete();

            }

            
            return redirect('sales/credit_transreceipt/'.$insertid);
        }
    }




}
