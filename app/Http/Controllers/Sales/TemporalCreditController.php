<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Customers;
use App\Models\Products;
use App\Models\TempTrans;
use App\Models\Terms;
use App\Models\Receipt;
use App\Models\TemporalCredit;
use App\Models\TemporalCreditDetail;
use Session;



class TemporalCreditController extends Controller
{
       // Temporal Credit Begins
    // Add Sales Transaction
    public function addTempTrans(Request $request,$id){
        $metaTitle = "Add Temporal Sales Transaction | CHIBOY ENTERPRISE";
        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data); die;

            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;



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

                                
                                $tempqty = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->first()->qty;
                                $tempprice = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->first()->price;

                                $total = $data['qty'] * $wholesalepx;

                                // Update Temporal Transaction Table
                                TempTrans::where('product_id',$data['productid'])->where('branch_id', $branchid)->where('user_id',$userId)->update(['qty'=>$tempqty + $data['qty'], 'price'=>$tempprice + $total]);
                                
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
    
                            $retailpx = $unitpx * $data['qty'];
    
                            if($count > 0 ){

                                $tempqty = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->first()->qty;
                                $tempprice = TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->first()->price;

                                $total = $data['qty'] * $wholesalepx;
                                // Update Temporal Transaction Table
                                TempTrans::where('product_id',$data['productid'])->where('branch_id',$branchid)->where('user_id',$userId)->update(['qty'=>$tempqty + $data['qty'], 'price'=>$tempprice + $retailpx]);
                                
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

        return view('layouts.sales.transaction.add_temp_trans')->with(compact('metaTitle'));
    }





    // Delete Temp Transaction
    public function deleteTempTrans(Request $request,$id){

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
            return redirect('sales/add_temp_transaction/'.$insertid);
        }
    
    }




    

    // Update Qty on Sales Transaction
    public function updateTempQty(Request $request,$id){

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


            
            return redirect('sales/add_temp_transaction/'.$data['insertid']);
                
        }

    }



    

    // Update Discount on Sales Transaction
    public function updateTempDiscount(Request $request,$id){

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

                return redirect('sales/add_temp_transaction/'.$data['insertid']);

            } 
                
        }

    }



    

    
    // Complete Transaction
    public function completeTempTrans(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;


            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;

            $date = date("Y-m-d H:i:s");

            


            // Insert Into Temporal Credit
            $temp = new TemporalCredit;

            $temp->branch_id = $branchid;
            $temp->customer_id = $id;
            $temp->user_id = $userId;
            $temp->temp_credit_date = $date;
            $temp->totalamt = $data['subTotalValue'];
            $temp->amtpaid = "0.00";
            $temp->receivedby = "";
            $temp->temp_credit_status = 1;

            $temp->save();
            // Generate Temporal Credit Id
            $tempCreditId = $temp->id;

            // echo "<pre>"; print_r($tempCreditId); die;



            
            $getTrans = TempTrans::where('branch_id',$branchid)->where('user_id',$userId)->get()->toArray();
            // echo "<pre>"; print_r($getTrans); die;


            // Insert Into Temporal Credit Details
            foreach($getTrans as $trans){

                $tempdetail = new TemporalCreditDetail;

                $tempdetail->temp_credit_id = $tempCreditId;
                $tempdetail->branch_id = $branchid;
                $tempdetail->user_id = $userId;
                $tempdetail->product_id = $trans['product_id'];
                $tempdetail->customer_id = $id;
                $tempdetail->temp_credit_qty = $trans['qty'];
                $tempdetail->discount = $trans['discount'];
                $tempdetail->unitprice = $trans['price'];
                $tempdetail->temp_credit_date = $date;
                $tempdetail->totalamt = $data['subTotalValue'];
                $tempdetail->amtpaid = "0.00";
                $tempdetail->receivedby = "";
                $tempdetail->log_status = 1;

                $tempdetail->save();


                
                // Delete From Temp Trans Table
                TempTrans::where('branch_id',$branchid)->where('product_id',$trans['product_id'])->where('user_id',$userId)->delete();
            

            }
            


            
            return redirect('sales/temp_credit_success/'.$id);
        }
    }



      // Cancel Transaction
      public function cancelTempTrans(Request $request,  $id){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die; 


            // Get User Id & Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($branchid); die;


            $customerid = Customers::with('branch')->where('branch_id',$branchid)->first()->id;

            $checkTempTrans = TempTrans::where('branch_id',$branchid)->where('user_id',$userId)->count();

            if($checkTempTrans > 0){

                $checktemp = TempTrans::with(['customer','branch'])->where('branch_id',$branchid)->where('user_id',$userId)->get();
                foreach($checktemp as $trans){
                    // echo "<pre>"; print_r($trans->id); die;
    
                    $transId = $trans->id;
                   
                }

                TempTrans::where('id',$transId)->delete();
                Customers::where('id',$customerid)->delete();

            }else{
                
                Customers::where('id',$customerid)->delete();
            }

            Session::flash('success_message','Transaction canceled successfully.');

            return redirect('sales/temp_transaction/');
        }
    }




    // View Transaction Details
    public function tempTransDetails(Request $request, $id){
        $metaTitle = "Temporal Transaction Details | CHIBOY ENTERPRISE";
        
        // Get User Id & Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];
        // echo "<pre>"; print_r($branchid); die;


        $tempcreditors  = TemporalCreditDetail::with(['customers','products','users'])->where('branch_id',$branchid)->where('temp_credit_id',$id)->get();
        

        $customer  = TemporalCreditDetail::with(['customers'=>function($query){
            $query->select('id','fullname','customer_contact');
        }])->where('branch_id',$branchid)->where('temp_credit_id',$id)->first();

        // echo "<pre>"; print_r($customer); die;



        return view('layouts.sales.transaction.temp_trans_table_details')->with(compact('metaTitle','tempcreditors','customer'));
    }


}
