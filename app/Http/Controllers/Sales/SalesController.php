<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use BulkSMS\GiantSMS;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customers;
use App\Models\Sales;
use App\Models\SalesDetails;
use App\Models\Products;
use App\Models\Payments;
use App\Models\TempTrans;
use App\Models\Terms;
use App\Models\Receipt;
use App\Models\TemporalCredit;
use App\Models\TemporalCreditDetail;
use Session;



class SalesController extends Controller
{
       // Cancel Transaction
       public function cancelTrans(Request $request,  $id){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die; 


            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;


            $customerid = Customers::with('branch')->where('branch_id',$branchid)->first()->id;

            $checkTempTrans = TempTrans::where('branch_id',$branchid)->count();

            if($checkTempTrans > 0){

                $temps = TempTrans::with(['customer','branch'])->where('branch_id',$branchid)->get();
                foreach($temps as $trans){
                    // echo "<pre>"; print_r($trans->id); die;
    
                    $transId = $trans->id;
                   
                }

                TempTrans::where('id',$transId)->delete();
                Customers::where('id',$customerid)->delete();

            }else{
                
                Customers::where('id',$customerid)->delete();
            }

            Session::flash('success_message','Transaction canceled successfully.');

            return redirect('sales/transaction/');
        }
    }


    // Add Sales Transaction
    public function addTrans(Request $request,$id){
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

        return view('layouts.sales.transaction.add_trans')->with(compact('metaTitle'));
    }



    // Update Qty on Sales Transaction
    public function updateQty(Request $request,$id){

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


            
            return redirect('sales/add_transaction/'.$data['insertid']);
                
        }

    }



    

    // Update Discount on Sales Transaction
    public function updateDiscount(Request $request,$id){

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

                return redirect('sales/add_transaction/'.$data['insertid']);

            } 
                
        }

    }



    
    // Complete Transaction
    public function completeTrans(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;


            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;



             //Make Rules & Custom Messages For Validation
             $rules = [
                'paid' => 'required',
                'payMethod' => 'required',
                'payStatus' => 'required'
            ];
            $customMessages = [
                'paid.required' => 'Sorry,  cash paid field is required',
                'payMethod.required' => 'Sorry,  payment type field is required',
                'payStatus.required' => 'Sorry,  payment status field is required'

            ];
            $this->validate($request,$rules,$customMessages);


            
            $date = date("Y-m-d H:i:s");
            $insertid = $data['insertid'];
            $subTotal = $data['subTotalValue'];
            $cashPaid = $data['paid'];
            $amtDue = $data['dueValue'];
            $changeAmt = $data['changeValue'];
            $paymentMethod = $data['payMethod'];
            $paymentStatus = $data['payStatus'];

            

            // Find the total discount
            $totalDiscount = TempTrans::where('branch_id',$branchid)->where('user_id',$userId)->sum('discount');
            // dd($totalDiscount); die; 

            // Insert Details Into Sales Table
            $sales = new Sales;
            
            $sales->cust_id = $insertid;
            $sales->user_id = $userId;
            $sales->branch_id = $branchid;
            $sales->cash_paid = $cashPaid;
            $sales->discount = $totalDiscount;
            $sales->sub_total = $subTotal;
            $sales->amount_due = $amtDue;
            $sales->cash_change = $changeAmt;
            $sales->date_added = $date;
            $sales->modeofpayment = $paymentMethod;
            $sales->payment_status = $paymentStatus;

            $sales->save();
            // Generate Sales Id
            $salesId = $sales->id;



        
            // Insert Details Into Payments Table
            $paycount = Payments::select('or_no')->with(['sales','branch'])->where('branch_id',$branchid)->count();
            // dd($paycount); die;

            $num = 1010001;

            // Set Condition For Payment
            if($paycount <= 0){
                $receiptnum = 'IMSCHB-'.$num;
            }else{

                $newcode = Payments::select('or_no')->with(['sales','branch'])->where('branch_id',$branchid)->latest()->value('or_no');
                $num = explode('-',$newcode,2);
                $receiptnum = $num[0]."-". ($num[1] + 1);
            }

            // Insert Into Payment Table
            $payment = new Payments;

            $payment->user_id = $userId;
            $payment->cust_id = $insertid;
            $payment->sales_id = $salesId;
            $payment->branch_id = $branchid;
            $payment->payment = $cashPaid;
            $payment->due = $amtDue;
            $payment->payment_date = $date;
            $payment->payment_for = $date;
            $payment->or_no = $receiptnum;
            $payment->status = 'Paid';

            $payment->save();

            // Generate Payment Id
            $paymentId = $payment->id;


            // Update Customer Table
            Customers::where('id',$insertid)->where('branch_id', $branchid)->update(['or_no'=>$receiptnum]);



            $checks = TempTrans::where('branch_id',$branchid)->where('user_id',$userId)->get()->toArray();
            // $checks = json_decode(json_encode($checks));
            // echo "<pre>"; print_r($checks); die;
            foreach($checks as $check){
                // echo "<pre>"; print_r($check->qty); die;

                // $qty = $check->qty;
                $productid = $check['product_id'];
                // echo "<pre>"; print_r($productid); die;
                $qty = $check['qty'];
                $price = $check['price'];
                $discount = $check['discount'];
                $newprx = $check['new_price'];
                $username = Auth::guard('user')->user()->name;


                // Now Insert Into Sales Details
                $salesDetails = new SalesDetails;
                $salesDetails->sales_id = $salesId;
                $salesDetails->product_id = $productid;
                $salesDetails->customer_id = $insertid;
                $salesDetails->payment_id = $paymentId;
                $salesDetails->branch_id = $branchid;
                $salesDetails->qty = $qty;
                $salesDetails->price = $price;
                $salesDetails->discount = $discount;
                $salesDetails->newprice = $newprx;
                $salesDetails->status = 2;

                $salesDetails->save();


            }



            // Update Products Table For Quantity Bought
            $temProd = TempTrans::with('product')->where('branch_id',$branchid)->where('user_id',$userId)->get()->toArray();
            // $temProd = json_decode(json_encode($temProd));
            // echo "<pre>"; print_r($temProd); die;
            $temprodCount = TempTrans::select('product_id')->where('branch_id',$branchid)->where('user_id',$userId)->count();
            // echo "<pre>"; print_r($temprodCount); die;

            foreach($temProd as $prodid){

                $id = $prodid['product_id'];
                $productQty = $prodid['product']['product_qty'];
                $qtyBought = $prodid['qty'];
                                

                // Update Products Table 
                Products::with('branch')->where('id',$id)->where('branch_id',$branchid)->update(['product_qty'=>($productQty - $qtyBought)]);

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
            $receipts = TempTrans::where('branch_id',$branchid)->where('user_id',$userId)->get()->toArray();
            // $receipts = json_decode(json_encode($receipts));
            // echo "<pre>"; print_r($receipts); die;
            foreach($receipts as $receipt){
                // echo "<pre>"; print_r($receipt->qty); die;

                // $qty = $receipt->qty;
                $productid = $receipt['product_id'];
                // echo "<pre>"; print_r($productid); die;
                // $proname = Products::where('id',$productid)->get()->toArray();
                // echo "<pre>"; print_r($proname); die;
                // $productName = $proname['product_name'];
                // echo "<pre>"; print_r($productName); die;
                // $productCode = $receipt['product']['product_code'];
                $qty = $receipt['qty'];
                $price = $receipt['price'];
                $discount = $receipt['discount'];
                $newprx = $receipt['new_price'];
                $total = ($qty * $newprx);
                $username = Auth::guard('user')->user()->name;

            
                // Now Insert Into Receipt Table
                $salesreceipt = new Receipt;
                $salesreceipt->user_name = $username;
                $salesreceipt->customer_id = $insertid;
                $salesreceipt->branch_id = $branchid;
                $salesreceipt->sales_id = $salesId;
                $salesreceipt->receipt_no = $receiptnum;
                $salesreceipt->customer_name = $customerName;
                $salesreceipt->customer_address = $customerAddress;
                $salesreceipt->customer_fon = $customerFon;
                $salesreceipt->company = $company;
                $salesreceipt->transaction_date = $date;
                $salesreceipt->product_id = $productid;
                $salesreceipt->user_id = $userId;
                $salesreceipt->qty_bought = $qty;
                $salesreceipt->price = $price;
                $salesreceipt->discount = $discount;
                $salesreceipt->newprice = $newprx;
                $salesreceipt->sub_total = $total;
                $salesreceipt->cash_paid = $cashPaid;
                $salesreceipt->amt_due = $amtDue;
                $salesreceipt->amt_change = $changeAmt;
                $salesreceipt->pay_type = $paymentMethod;
                $salesreceipt->pay_status = $paymentStatus;
                $salesreceipt->status = 1;

                $salesreceipt->save();

                
                
                // Delete From Temp Trans Table
                TempTrans::where('branch_id',$branchid)->where('product_id',$productid)->where('user_id',$userId)->delete();
            }

            
            return redirect('sales/transreceipt/'.$insertid);
        }
    }







    // Daily Sales Details
    public function salesDetails(){

        $metaTitle = "Details of Daily Sales Transaction | CHIBOY ENTERPRISE";

            

            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;



           // Get Today's Date
           $date = date("Y-m-d");
        
           $salesdetails = Receipt::with('branch','products')->where('branch_id',$branchid)
           ->whereDate('transaction_date',$date)->where('status',1)->get();
           $salesdetails = json_decode(json_encode($salesdetails));
        //    echo "<pre>"; print_r($salesdetails); die;

        return view('layouts.sales.transaction.salesdetails')->with(compact('metaTitle','salesdetails'));
    }
 

    

    
    // Delete Transaction
    public function deleteTrans(Request $request,$id){

        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;

            $insertid = $data['insertid'];

           

            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;


            // Get UserId Id
            $userId = Auth::guard('user')->user()->id;


            TempTrans::where('id',$data['id'])->where('branch_id',$branchid)->where('user_id',$userId)->delete();

            $message = "Product deleted successfully!";

            session::flash('success_message',$message);
            return redirect('sales/add_transaction/'.$insertid);
        }
    
    }





}
