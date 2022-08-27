<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Customers;
use App\Models\Payments;
use App\Models\Receipt;
use App\Models\CreditReceipt;
use App\Models\Products;
use App\Models\Sales;
use App\Models\SalesDetails;
use App\Models\MainWarehouse;
use App\Models\MainWarehouseLog;
use App\Models\TempTrans;
use Session;


class BigCustomersController extends Controller
{
       // Redirect to Big Customers Page
       public function bigcustomers(){
        
        $metaTitle = "Distributors | CHIBOY ENTERPRISE";

        // Get Branch Id
        $admin = Auth::guard('admin')->user();
        $admin = json_decode(json_encode($admin));
        // echo "<pre>"; print_r($admin); die;
        $userId = $admin->id;
        // echo "<pre>"; print_r($userId); die;
        $branchid = $admin->branchId;

        $creditors = Customers::with('admins')->where('branch_id',$branchid)->where('status',3)->orderBy('id','DESC')->get();
        // echo "<pre>"; print_r($creditors); die;

        return view('layouts.admin.distributors.distributor')->with(compact('metaTitle','creditors'));
    }





    // Add Big Customer
    public function addbigcustomer(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;


            // Get Branch Of The User Doing The Transaction
            $admin = Auth::guard('admin')->user();
            $admin = json_decode(json_encode($admin));
            // echo "<pre>"; print_r($admin); die;
            $userId = $admin->id;
            // echo "<pre>"; print_r($userId); die;
            $branchid = $admin->branchId;
            // echo "<pre>"; print_r($userId); die;
            // dd($branchid); die;


            $creditDate = date("Y-m-d H:i:s");
            // echo "<pre>"; print_r($creditDate); die;


            
            $countcreditors = Customers::where('fullname',$data['fname'])->where('branch_id', $branchid)->where('status',3)->count();
            // echo "<pre>"; print_r($countcreditors); die;
          

            if($countcreditors > 0){

                Session::flash('error_message','Sorry, this Customer already exist. Please use another name');
                return redirect('admin/big_customers');

            }else{
                 

                // Insert New Creditor
                $creditor = new Customers;
                $creditor->user_id = $userId;
                $creditor->fullname = $data['fname'];
                $creditor->customer_address = $data['address'];
                $creditor->customer_contact = $data['phone'];
                $creditor->company = $data['company'];
                $creditor->branch_id = $branchid;
                $creditor->credit_status = 'Approved';
                $creditor->status = 3;
                $creditor->date_credited = $creditDate;

                $creditor->save();

                Session::flash('success_message','New customer added successfully and approved at the same time.');
                return redirect('admin/big_customers');

            }




        }
    }





    // Creditor's Book / Account Summary
    public function creditorsbook(Request $request, $id){

        $metaTitle = "Creditors' Account | CHIBOY ENTERPRISE";


        // Get Branch Of The User Doing The Transaction
        $admin = Auth::guard('admin')->user();
        $admin = json_decode(json_encode($admin));
        // echo "<pre>"; print_r($admin); die;
        $userId = $admin->id;
        // echo "<pre>"; print_r($userId); die;
        $branchid = $admin->branchId;
        // dd($branchid); die;


        // Get Customer Details And Balance
        $custdetails = Customers::where('id',$id)->where('status',3)->first();


        // Calculate for Creditor's Balance
        // Amount Due
        $due = Payments::with(['branch','sales','customers'])->where('branch_id',$branchid)->where('cust_id',$id)->where('status',"Not Paid")->sum('due');        
        // Payments Made
        $payment = Payments::with(['branch','sales','customers'])->where('branch_id',$branchid)->where('cust_id',$id)->where('status',"Not Paid")->sum('payment');
        
        // Balance
        $custbalance = $due - $payment;
        // echo "<pre>"; print_r($custbalance); die;



        $creditorbook = SalesDetails::with(['branch','mainwarehouse','sales','customers'])->where('branch_id',$branchid)->where('customer_id',$id)->where('status',1)->orderBy('id','DESC')->get();
        $creditorbook = json_decode(json_encode($creditorbook));

        // echo "<pre>"; print_r($creditorbook); die;

        $subtotal = 0;

        foreach($creditorbook as $credit){
            $qty = $credit->qty;
            $discount = $credit->discount;
            $price = $credit->mainwarehouse->prodcost;
            $total = ($qty * ($price - $discount));

            // Calculate for total 
            $subtotal += $total;
        }

        



        // Get Transaction Details
        $credithistory = SalesDetails::with(['branch','mainwarehouse','sales','customers','payments'])->where('branch_id',$branchid)->where('customer_id',$id)->where('status',3)->orderBy('id','DESC')->get();
        $credithistory = json_decode(json_encode($credithistory));

        // echo "<pre>"; print_r($credithistory); die;



        // Get All Payments
        $payments = Payments::with(['branch','customers','sales'])->where('branch_id',$branchid)->where('cust_id',$id)->orderBy('id','DESC')->get();
        $payments = json_decode(json_encode($payments));
        // echo "<pre>"; print_r($payments); die;


        return view('layouts.admin.distributors.creditaccountsummary',['subtotal'=>$subtotal])->with(compact('metaTitle','custdetails','creditorbook','custbalance','credithistory','payments'));
    }







    // Begin Credit Sales Transaction
    // Add Sales Transaction
    public function addCreditTrans(Request $request,$id){

        $metaTitle = "Add Sales Transaction | CHIBOY ENTERPRISE";

        if($request->isMethod('post')){

            $data = $request->all();


            // dd($data); die;

            // Get Branch Of The User Doing The Transaction
            $admin = Auth::guard('admin')->user();
            $admin = json_decode(json_encode($admin));
            // echo "<pre>"; print_r($admin); die;
            $userId = $admin->id;
            // echo "<pre>"; print_r($userId); die;
            $branchid = $admin->branchId;
            // dd($branchid); die;



            // Get Product Details
            $productdetail = MainWarehouse::where('id',$data['productid'])->first();
            $productdetail = json_decode(json_encode($productdetail),true);
            // echo "<pre>"; print_r($productdetail); die;

            
            $wholesalepx = $productdetail['prodcost'];
            $productInCarton = $productdetail['newprod_qtyctn'];
            $qtyInCarton = $productdetail['qtybox'];
            $qtyInPcs = ($data['qty'] * $qtyInCarton);

            // $wholesaleqtypoint = $productdetail['wholesale_qty'];

            // echo "<pre>"; print_r($qtyInPcs); die;


            // Set Condition
            if($productInCarton <= 0){

                Session::flash('error_message','Sorry, quantity left in the warehouse is too low to sell.  The transaction cannot be completed');
                return redirect()->back();

            }else{
                if($data['qty'] > $productInCarton){

                    Session::flash('error_message','Sorry, quantity entered is more than the quantity in the warehouse.  Please enter the quantity available.');
                    return redirect()->back();

                }else {
                    if($data['qty'] <= 0){

                        Session::flash('error_message','Sorry, quantity cannot be less than one carton.  Please enter one carton and above.');
                        return redirect()->back();

                    }else{

                            
                            $count = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->count();
                            
                            if($count > 0 ){

                                Session::flash('error_message','Sorry, this product already exist.  Kindly use the Update Button to make the necessary updates.');
                                return redirect()->back();

                                
                            }else{


                                // Insert Details Into Temporal Transaction
                                $temp = new TempTrans;
                                $temp->product_id = $data['productid'];
                                $temp->branch_id = $branchid;
                                $temp->user_id = $userId;
                                $temp->price = $wholesalepx;
                                $temp->discount = "0.00";
                                $temp->new_price = $wholesalepx;
                                $temp->qty = $qtyInPcs;
                                $temp->save();

                            }
    
    
                            return redirect()->back();
                        

                    }
                }
            }
            
            
        }

        
        // Get Branch Of The User Doing The Transaction
        $admin = Auth::guard('admin')->user();
        $admin = json_decode(json_encode($admin));
        // echo "<pre>"; print_r($admin); die;
        $userId = $admin->id;
        // echo "<pre>"; print_r($userId); die;
        $branchid = $admin->branchId;
        // dd($branchid); die;


        $insertid = Customers::where('id',$id)->with('branch')->where('branch_id',$branchid)->where('status',3)->first()->id;
        $insertid = json_decode(json_encode($insertid));

        return view('layouts.admin.transaction.add_credit_trans')->with(compact('metaTitle','insertid'));
    }





    
    
    
    // Complete Credit Transaction
    public function completeCreditTrans(Request $request,$id){

        if($request->isMethod('post')){

            $data = $request->all();

            // dd($data); die;
            

            // Get Branch Of The User Doing The Transaction
            $admin = Auth::guard('admin')->user();
            $admin = json_decode(json_encode($admin));
            $userId = $admin->id;
            $branchid = $admin->branchId;




            

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
                // echo "<pre>"; print_r($qty); die;
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

                // Get Quantity Available For That Particular Product(s) In Main Warehouse
                $checkProduct = MainWarehouse::where('id',$productid)->first();
                // echo "<pre>"; print_r($checkProduct); die;
                // $warehouseid = $checkProduct->id;
                $productInCarton = $checkProduct->newprod_qtyctn;
                // Get Quantity In Carton For That Particular Product
                $qtyInBox = $checkProduct->qtybox;
                // echo "<pre>"; print_r($qtyInBox); die;

                $qtyCTN = ($qty / $qtyInBox);
                // echo "<pre>"; print_r($qtyCTN); die;

                $totalQtyPCS = $checkProduct->total_prodqtypcs;

                $cust = Customers::where('id',$insertid)->first();
                // echo "<pre>"; print_r($cust); die;

                $activity = "has supplied to ". " ".$cust->fullname;

                // Update Main Warehouse Table 
                MainWarehouse::where('id',$productid)->update(['newprod_qtyctn'=>($productInCarton - $qtyCTN), 'total_prodqtypcs'=>($totalQtyPCS - $qty)]);


                // Get Transaction History In Main Warehouse
                $mainwarelog = new MainWarehouseLog;
                // echo "<pre>"; print_r($mainwarelog); die;
                $mainwarelog->main_warehouse_id = $checkProduct->id;
                $mainwarelog->user_id = Auth::guard('admin')->user()->id;
                $mainwarelog->brand_id = $checkProduct->brand_id;
                $mainwarelog->category_id = $checkProduct->category_id;
                $mainwarelog->unit_id = $checkProduct->unit_id;
                $mainwarelog->warehouse = $checkProduct->warehouse;
                $mainwarelog->action = $activity;
                $mainwarelog->qty_takenctn = $qtyCTN;
                $mainwarelog->qty_takenpcs = $qty;
                $mainwarelog->date_taken = date("Y-m-d H:i:s");
                $mainwarelog->prodcost = $checkProduct->prodcost;
                $mainwarelog->total_prodcost = ($price * $qty);
                $mainwarelog->log = 2;
                $mainwarelog->delog = 2;
                $mainwarelog->save();

                // die;
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
            // echo "<pre>"; print_r($invoice); die;

            foreach($invoice as $receipt){
                // echo "<pre>"; print_r($receipt->qty); die;

                
                
                $productid = $receipt->product_id;
                $qty = $receipt->qty;
                $price = $receipt->price;
                $username = Auth::guard('admin')->user()->name;
                $discount = $receipt->discount;
                $newprx = $price - $discount;
                $total = ($qty * $newprx);

			
            
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
                $salesreceipt->status = 3;

                $salesreceipt->save();


                // Delete From Temp Trans Table
                TempTrans::where('branch_id',$branchid)->where('product_id',$productid)->where('user_id',$userId)->delete();

            }

            
            return redirect('admin/credit_transreceipt/'.$insertid);
        }
    }






    // Update Qty on Credit Sales Transaction
    public function updateCreditQty(Request $request,$id){

        if($request->isMethod('post')){

            $data = $request->all();


            // dd($data); die;


            // Get Branch Id
            $admin = Auth::guard('admin')->user();
            $admin = json_decode(json_encode($admin));
            $userId = $admin->id;
            $branchid = $admin->branchId;


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


            
            return redirect('admin/credit_transaction/'.$data['insertid']);
                
        }

    }



    

    // Update Discount on Credit Sales Transaction
    public function updateCreditDiscount(Request $request,$id){

        if($request->isMethod('post')){
            $data = $request->all();


            // dd($data); die;


            // Get Branch Id
            $admin = Auth::guard('admin')->user();
            $admin = json_decode(json_encode($admin));
            $userId = $admin->id;
            $branchid = $admin->branchId;


            // Check Whether Discount is Less Than Zero
            if($data['discount'] < 0){

                Session::flash('error_message','Sorry, discount cannot be less than zero.  Please enter an amount from zero upwards.');
                return redirect('admin/credit_transaction/'.$data['insertid']); 
                
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

                return redirect('admin/credit_transaction/'.$data['insertid']);

            } 
                
        }

    }







     // Delete Credit Transaction
     public function deleteCreditTrans(Request $request,$id){

        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;

            $insertid = $data['insertid'];

            

            // Get Branch Id
            $admin = Auth::guard('admin')->user();
            $admin = json_decode(json_encode($admin));
            $userId = $admin->id;
            $branchid = $admin->branchId;



            TempTrans::where('id',$data['id'])->where('branch_id',$branchid)->where('user_id',$userId)->delete();

            $message = "Product deleted successfully!";

            session::flash('success_message',$message);
            return redirect('admin/credit_transaction/'.$insertid);
        }
    
    }





    // Cancel Credit Transaction
    public function cancelCreditTrans(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die; 

            

            // Get Branch Id
            $admin = Auth::guard('admin')->user();
            $admin = json_decode(json_encode($admin));
            $userId = $admin->id;
            $branchid = $admin->branchId;


            $customerid = Customers::where('id',$id)->with('branch')->where('branch_id',$branchid)->where('status',3)->first()->id;

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

                TempTrans::where('id',$transId)->where('product_id',$productid)->where('branch_id',$branchid)->delete();
                // Customers::where('id',$customerid)->->where('status',3)->delete();
            }else{
                
                Customers::where('id',$customerid)->where('status',3)->delete();
            }

            Session::flash('success_message','Credit transaction canceled successfully.');

            return redirect('admin/creditors/');
        }
    }









}
