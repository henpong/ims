<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stocks;
use App\Models\User;
use App\Models\Customers;
use App\Models\Branches;
use App\Models\Products;
use App\Models\StockRequest;
use App\Models\MainWarehouse;
use App\Models\MainWarehouseLog;
use App\Models\History;
use App\Models\ReturnedGoods;
use App\Models\SalesDetails;
use App\Models\Sales;
use App\Models\SpoiltGoods;
use App\Models\OtherShopGoods;
use App\Models\Receipt;
use Session;



class StocksController extends Controller
{
       // Redirect to stocks table
       public function lowstocks(){
        $metaTitle = "Low Stocks | IMS CHI-BOY ENTERPRISE";

        // Get Branch Id
        // $user = Auth::guard('user')->user();
        // $user = json_decode(json_encode($user));
        // echo "<pre>"; print_r($user); die;
        // $branchid = $user->branchId;
        // dd($branchid); die;
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];



        $lowstocks = Products::with(['branch','category','warehouse'])->whereColumn('product_qty','<=','lowstock_point')->where('branch_id',$branchid)
                    ->orderBy('id','DESC')->where('status',1)->get();
         
        $lowstocks = json_decode(json_encode($lowstocks));

        // echo "<pre>"; print_r($lowstocks); die;

        return view('layouts.sales.stocks.lowstocks')->with(compact('metaTitle','lowstocks'));
    }


    // Low Stocks / Requests
    public function lowstockrequest(){
        $metaTitle = "Low Stock Request | IMS CHI-BOY ENTERPRISE";

        // Get Branch Id
        // $user = Auth::guard('user')->user();
        // $user = json_decode(json_encode($user));
        // echo "<pre>"; print_r($user); die;
        // $branchid = $user->branchId;
        // dd($branchid); die;
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];



        $lowstockrequest = StockRequest::with(['branch'=>function($query){
            $query->select('id','branch_name');
        },'products'=>function($query){
            $query->select('id','product_name','product_code');
        }])->where('del_id',1)->orderBy('date_requested','DESC')->where('branch_id',$branchid)->get();
            
        // dd($lowstockrequest); die;

        // $lowstocks = json_decode(json_encode($lowstockrequest),true);
        // echo "<pre>"; print_r($lowstockrequest); die;


        return view('layouts.sales.stocks.lowstockrequest')->with(compact('metaTitle','lowstockrequest'));
    }



    

    // Add Low Stock Request
    public function stockrequest(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;

             // Get Branch Id
            //  $user = Auth::guard('user')->user();
            // $user = json_decode(json_encode($user));
            // echo "<pre>"; print_r($user); die;
            // $branchid = $user->branchId;
            // dd($branchid); die;
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];



             $warehouseId = $data['warehouseid'];
             $productid = $data['productid'];

            //  Set Condition to check values
             $qtyrequestctns = $data['qtyrequestctns'];
             if($qtyrequestctns == ""){ $qtyrequestctns = 0; }else{ $qtyrequestctns = $data['qtyrequestctns'];}
             $qtyrequestpcs = $data['qtyrequestpcs'];
             if($qtyrequestpcs == ""){ $qtyrequestpcs = 0; }else{ $qtyrequestpcs = $data['qtyrequestpcs'];}
             $addqtypcs = $data['addqtypcs'];
             if($addqtypcs == ""){ $addqtypcs = 0; }else{ $addqtypcs = $data['addqtypcs'];}
            //  End of conditions

            // echo "<pre>"; print_r($addqtypcs); die;

            // Prevent Multiple Requests
            $checkRequest = StockRequest::where('product_id',$productid)->where('branch_id',$branchid)
                                ->where('request_status','Pending')->where('del_id',1)->count();
            
            // dd($checkRequest); die;

            if($checkRequest > 0 ){
                Session::flash("error_message","Sorry, you have already sent a request for this product.  Please wait for approval or inform your boss to approve it.  Thank you.");
                return redirect()->back();
            }else{

                // Check whether there is enough quantity in the warehouse to complete the request
                $qtyBox = Products::with(['branch','warehouse'])->where('id',$productid)->where('branch_id',$branchid)->first()->warehouse->qtybox;
                $qtyInWarehouse = Products::with(['branch','warehouse'])->where('id',$productid)->where('branch_id',$branchid)->first()->warehouse->newprod_qtyctn;
                $qtyInWarehouseaddPCS = Products::with(['branch','warehouse'])->where('id',$productid)->where('branch_id',$branchid)->first()->warehouse->addprod_qtypcs;


                // echo "<pre>"; print_r($qtyInWarehouseaddPCS); die;

                $totalQtyPcs = ($qtyrequestctns * $qtyBox) + $addqtypcs;

                // echo "<pre>"; print_r($totalQtyPcs); die;

                // dd($qtyBox); die;

                if(($qtyInWarehouse <= 0) AND ($qtyInWarehouseaddPCS <= 0)){
                    // echo "<pre>"; print_r($qtyInWarehouse); die;
                    
                    Session::flash("error_message","Sorry, there is not enough quantity in the warehouse to complete your request.  Kindly contact your boss.  Thank you.");
                    return redirect()->back();

                }elseif(($qtyInWarehouse < $qtyrequestctns) OR ($qtyInWarehouseaddPCS < $addqtypcs)){

                    Session::flash("error_message","Sorry, too much quantity requested.  Reduce your quantity and try again else your request would NOT be completed. ");
                    return redirect()->back();

                }else{

                    // echo "<pre>"; print_r($qtyInWarehouseaddPCS); die;

                    // Insert data into Stock Request table
                    $stocks = new StockRequest;
                    $stocks->product_id = $productid;
                    $stocks->main_warehouse_id = $warehouseId;
                    $stocks->qty_requestedCTNS = $qtyrequestctns;
                    $stocks->qty_requestedPCS = $qtyrequestpcs;
                    $stocks->additional_qty_requested = $addqtypcs;
                    $stocks->requested_by = Auth::guard('user')->user()->name;
                    $stocks->date_requested = date("Y-m-d H:i:s");
                    $stocks->branch_id = $branchid;
                    $stocks->request_status = "Pending";
                    $stocks->status_id = 1;
                    $stocks->del_id = 1;

                    $stocks->save();

                    Session::flash("success_message","Congrats, you have successfully sent a new stock request.  Please wait for approval.  Thank you.");
                    return redirect()->back();
                }
            }

        }
    }



    // Cancel Lowstock Request
    public function cancelrequest(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;

            // Get Branch Id
            // $user = Auth::guard('user')->user();
            // $user = json_decode(json_encode($user));
            // echo "<pre>"; print_r($user); die;
            // $branchid = $user->branchId;
            // dd($branchid); die;
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];



            // Get the product name and quantity in cartons
            $productname = StockRequest::with(['branch','products'])->where('branch_id',$branchid)->where('product_id',$data['productId'])->first()->products->product_name;
            $qtyrequested = StockRequest::with(['branch','products'])->where('branch_id',$branchid)->where('product_id',$data['productId'])->first()->qty_requestedCTNS;

            // dd($qtyrequested); die;

            // Update Stock Request Table 
            StockRequest::where('id',$data['requestId'])->where('branch_id',$branchid)->update(['del_id'=> 2 ]);

            // Insert into history table
            $statement = "Has deleted $qtyrequested "."pcs "." ". " of $productname From Stock Request";

            $history = new History;
            $history->user_id = Auth::guard('user')->user()->id;
            $history->activity = $statement;
            $history->status = $data['requestStatus'];

            $history->save();

            Session::flash('success_message','Stock request deleted successfully');
            return redirect()->back();


        }

    }



    // Product Stocking
    public function stocks(){
        $metaTitle = "Product Stocking | IMS CHI-BOY ENTERPRISE";


        // Get Branch Id
        // $user = Auth::guard('user')->user();
        // $user = json_decode(json_encode($user));
        // echo "<pre>"; print_r($user); die;
        // $branchid = $user->branchId;
        // dd($branchid); die;
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];



        $stocks = Stocks::with(['branch','products'])->where('branch_id',$branchid)->where('stock_status',1)->orderBy('id','DESC')->get();
        $stocks = json_decode(json_encode($stocks));
        // echo "<pre>"; print_r($stocks); die;

        return view('layouts.sales.stocks.stocks')->with(compact('metaTitle','stocks'));
    }



    // Add Stock
    public function addstock(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;


            // Get Branch Id
            // $user = Auth::guard('user')->user();
            // $user = json_decode(json_encode($user));
            // echo "<pre>"; print_r($user); die;
            // $branchid = $user->branchId;
            // dd($branchid); die;
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];



            $productid = $data['productid'];
            $qtyCARTNS = $data['qtyctn'];
            if($qtyCARTNS == ""){ $qtyCARTNS = 0 ;}else{ $qtyCARTNS = $data['qtyctn'];}
            $qtyPCSS = $data['qtypcs'];
            if($qtyPCSS == ""){ $qtyPCSS = 0 ;}else{ $qtyPCSS = $data['qtypcs'];}
            $stockedby = Auth::guard('user')->user()->name;
            // echo "<pre>"; print_r($qtyPCSS); die;

            // Set Condition
            $checkproduct = StockRequest::with(['branch','warehouse','products'=>function($query){
                $query->whereColumn('product_qty','<=','lowstock_point');
            }])->where('status_id',1)->where('del_id',1)->where('product_id',$productid)->where('branch_id',$branchid)->first();
            $checkproduct = json_decode(json_encode($checkproduct));
            
            // echo "<pre>"; print_r($checkproduct); die;


            if($checkproduct == ""){

                Session::flash("error_message","Sorry, you cannot stock this product because no request has been made.  Please send a stock request.  Thank you.");
                return redirect()->back();

            }else{


                
            $warehouseid = $checkproduct->warehouse->id;
            // echo "<pre>"; print_r($warehouseid); die;
            $requestid = $checkproduct->id;
            $requeststatus = $checkproduct->request_status;
            $productname = $checkproduct->products->product_name;
            $additionalQty = $checkproduct->additional_qty_requested;
            $qtyPCS = $checkproduct->qty_requestedPCS;
            $brandid = $checkproduct->warehouse->brand_id;
            $unitid = $checkproduct->warehouse->unit_id;
            $warehousetypeid = $checkproduct->warehouse->warehouse;
            $productcost = $checkproduct->warehouse->prodcost;
            // echo "<pre>"; print_r($productcost); die;


            $totalqtyPCS = $qtyPCS + $additionalQty;

            // dd($totalqtyPCS); die;

            $activity = "has taken";

            if($requeststatus == "Pending"){

                Session::flash("error_message","Sorry, your request is not approved.  Please contact your boss.  Thank you.");
                return redirect()->back();

            }elseif($requeststatus == "Approved"){

                // Check if qty requested is equal to qty being stocked
                $checks = StockRequest::with('branch')->where('id',$requestid)->where('product_id',$productid)->where('status_id',1)->where('branch_id',$branchid)->first();
                $checks = json_decode(json_encode($checks));
                // echo "<pre>"; print_r($checks); die;

                $checkrequestId = $checks->id;
                $checkstockQTYCTNS = $checks->qty_requestedCTNS;
                $checkstockQTYPCS = $checks->qty_requestedPCS;
                $checkstockADDPCS = $checks->additional_qty_requested;
                

                $checkstockTOTALQTYPCS = ($checkstockQTYPCS + $checkstockADDPCS);
                
                $totalProductcost = ($checkstockTOTALQTYPCS * $productcost);
                
                // dd($checkstockTOTALQTYPCS); die;

                if(($qtyCARTNS != $checkstockQTYCTNS) || ($qtyPCSS != $checkstockTOTALQTYPCS)){

                    Session::flash("error_message","Sorry, the quantity you entered is NOT equal to the quantity requested.  Please try again.");
                    return redirect()->back();

                }else{


                    // Insert into Mainware_Log Table
                    $mainwarelog = new MainWarehouseLog;
                    $mainwarelog->main_warehouse_id = $warehouseid;
                    $mainwarelog->user_id = Auth::guard('user')->user()->id;
                    $mainwarelog->brand_id = $brandid;
                    $mainwarelog->unit_id = $unitid;
                    $mainwarelog->warehouse = $warehousetypeid;
                    $mainwarelog->action = $activity;
                    $mainwarelog->total_qtypcs = $totalqtyPCS;
                    $mainwarelog->qty_takenctn = $qtyCARTNS;
                    $mainwarelog->qty_takenpcs = $totalqtyPCS;
                    $mainwarelog->date_taken = date("Y-m-d H:i:s");
                    $mainwarelog->prodcost = $productcost;
                    $mainwarelog->total_prodcost = $totalProductcost;
                    $mainwarelog->log = 2;
                    $mainwarelog->delog = 2;
                    $mainwarelog->stockrequestid = $checkrequestId;
                    $mainwarelog->save();


                    // Update Products Table
                    $prodQTY = Products::where('id',$productid)->where('branch_id',$branchid)->first()->product_qty;
                    Products::where('id',$productid)->where('branch_id',$branchid)->update(['product_qty'=> $prodQTY + $totalqtyPCS ]);

                    // Update Stock Request Table
                    StockRequest::where('id',$requestid)->where('branch_id',$branchid)->where('product_id',$productid)->update(['status_id'=> 2 ]);

                    // Update Mainwarehouse Table
                    $updateware = StockRequest::with(['branch','warehouse'])->where('request_status','Approved')->where('status_id',2)->where('del_id',1)->where('branch_id',$branchid)->first();
                    $updateware = json_decode(json_encode($updateware));
                    // echo "<pre>"; print_r($updateware); die;
                    $qtyTakenCTNS = $updateware->qty_requestedCTNS;
                    $qtyTakenPCS = $updateware->qty_requestedPCS;
                    $additionalqtyTakenPCS = $updateware->additional_qty_requested;
                    $wareid = $updateware->warehouse->id;
                    
                    // Now Update Warehouse
                    $mainware = MainWarehouse::where('id',$wareid)->first();
                    $mainware = json_decode(json_encode($mainware));
                    // echo "<pre>"; print_r($addprodQTY); die;
                    $newprodQTY = $mainware->newprod_qtyctn;
                    $totalprodQTY = $mainware->total_prodqtypcs;
                    $addprodQTY = $mainware->addprod_qtypcs;
                    // echo "<pre>"; print_r($addprodQTY); die;

                    MainWarehouse::where('id',$wareid)->update(['newprod_qtyctn'=>($newprodQTY - $qtyTakenCTNS), 'total_prodqtypcs'=>($totalprodQTY - $totalqtyPCS), 'addprod_qtypcs'=>($addprodQTY - $additionalqtyTakenPCS) ]);
                    

                    // Insert Into Stocks Table
                    $stocking = new Stocks;
                    $stocking->product_id = $productid;
                    $stocking->branch_id = $branchid;
                    $stocking->qty_ctn = $qtyCARTNS;
                    $stocking->qty_pcs = $qtyPCSS;
                    $stocking->stocked_by = $stockedby;
                    $stocking->stock_date = date("Y-m-d H:i:s");
                    $stocking->stock_status = 1;

                    $stocking->save();


                    // Update Stock Request Table Again
                    StockRequest::where('id',$requestid)->where('branch_id',$branchid)->where('product_id',$productid)->update(['status_id'=> 4 ]);


                    Session::flash("success_message","Congrats, Product has been stocked in your shop successfully.  Thank you.");
                    return redirect()->back();

                }

            }elseif($requeststatus == "Rejected"){

                // Update stock request
                StockRequest::where('id',$requestid)->where('branch_id',$branchid)->where('product_id',$productid)->update(['status_id'=> 3 ]);


                Session::flash("error_message","Sorry, your request was rejected.  Please contact your boss.  Thank you.");
                return redirect()->back();

            }else{

                Session::flash("error_message","Sorry, you cannot stock this product because no stock has been requested.  Please send a stock request.  Thank you.");
                return redirect()->back();

            }

        }

        }
    }
    // End of Add Stock



    // Returned Goods
    public function returnedgoods(){
        $metaTitle = "Returned Goods | IMS CHI-BOY ENTERPRISE";
        
        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];



        $returned = ReturnedGoods::with(['user'=>function($query){
            $query->select('id','name');
        },'categories'=>function($query){
            $query->select('id','category_name');
        },'products'=>function($query){
            $query->select('id','product_code','product_name');
        },'customer'=>function($query){
            $query->select('id','fullname','or_no');
        }])->where('branch_id',$branchid)->orderBy('id','DESC')->get();
        $returned = json_decode(json_encode($returned));

        // echo "<pre>"; print_r($returned); die;

        return view('layouts.sales.stocks.returned_goods')->with(compact('metaTitle','returned'));
    }




    // Get Customer Name Using Ajax
    public function getcustomername(Request $request){
        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];



        $data = Customers::where('id',$request->id)->where('branch_id',$branchid)
				->select('id','fullname')->get();
				return response()->json($data);
    }




    // Add Returned Goods
    public function addreturned(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;


            // Get Branch Id
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];


            $date = date("Y-m-d");

            // Get Product Quantity
            $getProd = Products::with('branch')->where('id',$data['productid'])->where('branch_id',$branchid)->where('status',1)->first();
            $getProd = json_decode(json_encode($getProd));

            $productQTY = $getProd->product_qty;
            // echo "<pre>"; print_r($productQTY); die;


            // Get Qty Bought & Receipt No From Receipt Table
            $custreceipt = Receipt::where('branch_id',$branchid)->where('customer_id',$data['custid'])->where('product_id',$data['productid'])->first();
            $custreceipt = json_decode(json_encode($custreceipt));

            // echo "<pre>"; print_r($custreceipt); die;

            $qtybought = $custreceipt->qty_bought;
            $recepNum = $custreceipt->receipt_no;
            $price = $custreceipt->newprice;


            if(($qtybought - $data['qtyreturnedpcs']) == 0 ){

                

                // Insert Into Returned Goods Table
                $returned = new ReturnedGoods;
                $returned->user_id = $userId;
                $returned->branch_id = $branchid;
                $returned->customer_id = $data['custid'];
                $returned->product_id = $data['productid'];
                $returned->qty_returned = $data['qtyreturnedpcs'];
                $returned->reason = $data['prodcondition'];
                $returned->description = $data['description'];
                $returned->receipt_no = $recepNum;
                $returned->returned_date = date("Y-m-d H:i:s");
                $returned->returned_status = 1;

                $returned->save();

                
                // Remove It From Receipt Table
                Receipt::where('branch_id',$branchid)->where('customer_id',$data['custid'])->where('product_id',$data['productid'])->delete();
                // echo "<pre>"; print_r($rect); die;

                // Remove It From Sales Details Table
                SalesDetails::where('branch_id',$branchid)->where('customer_id',$data['custid'])->where('product_id',$data['productid'])->delete();
                // echo "<pre>"; print_r($rectsales); die;



                

                // Session::flash("success_message","Congrats, returned goods have been added to the stock in your shop. ");
                // return redirect()->back();

                
                        $totalcount = Receipt::where('branch_id',$branchid)->where('customer_id',$data['custid'])->count();

                        if($totalcount == 0){

                            // Update Product Qty In Product Table
                            Products::where('id',$data['productid'])->where('branch_id',$branchid)->update(['product_qty'=> ($productQTY + $data['qtyreturnedpcs']) ]);


                            Session::flash("success_message","Congrats, returned goods have been added to the stock in your shop. ");
                            return redirect()->back();

                            
                        }else{

                            

                                $total = Receipt::select('sub_total')->where('branch_id',$branchid)->where('customer_id',$data['custid'])->get()->sum('sub_total');
                                $total = json_decode(json_encode($total));
                                // echo "<pre>"; print_r($total); die;


                                // Update Receipt Table Again For Cash Paid
                                Receipt::where('branch_id',$branchid)->where('customer_id',$data['custid'])->update(['cash_paid'=> $total]);


                                // Update Sales Table
                                Sales::where('branch_id',$branchid)->where('cust_id',$data['custid'])->update(['cash_paid'=> $total, 'sub_total'=>$total]);
                            

                                // Update Sales Details Table
                                SalesDetails::where('branch_id',$branchid)->where('customer_id',$data['custid'])->where('product_id',$data['productid'])->update(['qty'=> ($qtybought - $data['qtyreturnedpcs']) ]);
                                // echo "<pre>"; print_r($rectsales); die;



                                // Update Product Qty In Product Table
                                Products::where('id',$data['productid'])->where('branch_id',$branchid)->update(['product_qty'=> ($productQTY + $data['qtyreturnedpcs']) ]);



                                Session::flash("success_message","Congrats, returned goods have been added to the stock in your shop. ");
                                return redirect()->back();


                        }

            }else{


                $subtotal = 0;

                // Insert Into Returned Goods Table
                $returned = new ReturnedGoods;
                $returned->user_id = $userId;
                $returned->branch_id = $branchid;
                $returned->customer_id = $data['custid'];
                $returned->product_id = $data['productid'];
                $returned->qty_returned = $data['qtyreturnedpcs'];
                $returned->reason = $data['prodcondition'];
                $returned->description = $data['description'];
                $returned->receipt_no = $recepNum;
                $returned->returned_date = date("Y-m-d H:i:s");
                $returned->returned_status = 1;

                $returned->save();


                
                
                // Update Receipt Table
                Receipt::where('branch_id',$branchid)->where('customer_id',$data['custid'])->where('product_id',$data['productid'])->update(['qty_bought'=> ($qtybought - $data['qtyreturnedpcs']),  'sub_total'=> (($qtybought - $data['qtyreturnedpcs']) * $price)]);
                
                
                // $totalcount = Receipt::where('branch_id',$branchid)->where('customer_id',$data['custid'])->count();

                $total = Receipt::select('sub_total')->where('branch_id',$branchid)->where('customer_id',$data['custid'])->get()->sum('sub_total');
                $total = json_decode(json_encode($total));
                // echo "<pre>"; print_r($total); die;


                // Update Receipt Table Again For Cash Paid
                Receipt::where('branch_id',$branchid)->where('customer_id',$data['custid'])->update(['cash_paid'=> $total]);


                // Update Sales Table
                Sales::where('branch_id',$branchid)->where('cust_id',$data['custid'])->update(['cash_paid'=> $total, 'sub_total'=>$total]);
               

                // Update Sales Details Table
                SalesDetails::where('branch_id',$branchid)->where('customer_id',$data['custid'])->where('product_id',$data['productid'])->update(['qty'=> ($qtybought - $data['qtyreturnedpcs']) ]);
                // echo "<pre>"; print_r($rectsales); die;


                // Update Product Qty In Product Table
                Products::where('id',$data['productid'])->where('branch_id',$branchid)->update(['product_qty'=> ($productQTY + $data['qtyreturnedpcs']) ]);


                Session::flash("success_message","Congrats, returned goods have been added to the stock in your shop. ");
                return redirect()->back();


            }
            
            
        }
    }



    

    // Spoilt Goods In Shop
    public function spoiltgoods(){
        $metaTitle = "Spoilt Goods | IMS CHI-BOY ENTERPRISE";
        
        // Get Branch Id
        // $user = Auth::guard('user')->user();
        // $user = json_decode(json_encode($user));
        // echo "<pre>"; print_r($user); die;
        // $branchid = $user->branchId;
        // dd($branchid); die;
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];



        $spoilt = SpoiltGoods::with(['user'=>function($query){
            $query->select('id','name');
        },'products'=>function($query){
            $query->select('id','product_code','product_name');
        }])->where('branch_id',$branchid)->get();
        $spoilt = json_decode(json_encode($spoilt));

        // echo "<pre>"; print_r($spoilt); die;

        return view('layouts.sales.stocks.spoilt_goods')->with(compact('metaTitle','spoilt'));
    }



    // Remove Spoilt Goods From Shop
    public function addspoilt(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;


            
            // Get Branch Id
            // $user = Auth::guard('user')->user();
            // $user = json_decode(json_encode($user));
            // echo "<pre>"; print_r($user); die;
            // $branchid = $user->branchId;
            // dd($branchid); die;
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];



            // Get Product Quantity
            $getProd = Products::with('branch')->where('id',$data['productid'])->where('branch_id',$branchid)->where('status',1)->first();
            $getProd = json_decode(json_encode($getProd));

            // echo "<pre>"; print_r($getProd); die;
            $productQTY = $getProd->product_qty;

            if($productQTY <= 0){
                Session::flash('error_message','Sorry, there is not enough quantity in your shop to perform this transaction.  Please send a stock request. Thank you.');
                return redirect()->back();
            }


            // Insert Into Returned Goods Table
            $spoilt = new SpoiltGoods;
            $spoilt->user_id = $userId;
            $spoilt->branch_id = $branchid;
            $spoilt->product_id = $data['productid'];
            $spoilt->qty_spoilt = $data['qtyspoiltpcs'];
            $spoilt->condition = $data['prodcondition'];
            $spoilt->description = $data['description'];
            $spoilt->spoilt_date = date("Y-m-d H:i:s");
            $spoilt->spoilt_status = 1;

            $spoilt->save();



            // Update Product Qty In Product Table
            Products::where('id',$data['productid'])->where('branch_id',$branchid)->update(['product_qty'=> $productQTY - $data['qtyspoiltpcs'] ]);


            Session::flash("success_message","Congrats, spoilt goods removed from your stock successfully. Please inform your boss to discard them.");
            return redirect()->back();

        }

    }



    // Temporal Credit
    public function goodshop(){
        $metaTitle = "Temporal Credit | IMS CHI-BOY ENTERPRISE";
        
        // Get Branch Id
        // $user = Auth::guard('user')->user();
        // $user = json_decode(json_encode($user));
        // echo "<pre>"; print_r($user); die;
        // $branchid = $user->branchId;
        // dd($branchid); die;
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];



        $goodshop = OtherShopGoods::with(['branch'=>function($query){
            $query->select('id','branch_name');
        },'user'=>function($query){
            $query->select('id','name');
        },'products'=>function($query){
            $query->select('id','product_code','product_name');
        }])->where('branch_id',$branchid)->get();
        $goodshop = json_decode(json_encode($goodshop));

        // echo "<pre>"; print_r($goodshop); die;

        return view('layouts.sales.stocks.goods_othershop')->with(compact('metaTitle','goodshop'));
    }



    // Add Goods Sold To Other Shops
    public function addgoods(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;


            // Get Branch Id
            // $user = Auth::guard('user')->user();
            // $user = json_decode(json_encode($user));
            // echo "<pre>"; print_r($user); die;
            // $branchid = $user->branchId;
            // dd($branchid); die;
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];



            // Get Details From Products Table
            $prod = Products::with('branch')->where('id',$data['productid'])->where('branch_id',$branchid)->first();
            $prod = json_decode(json_encode($prod),true);
            // echo "<pre>"; print_r($prod); die;

            $producQTY = $prod['product_qty'];
            $wholesaleQTY = $prod['wholesale_qty'];
            $prodUnitpx = $prod['product_price'];
            $prodWholepx = $prod['product_wholesale_price'];


            // Set Product Qty Condition
            if($producQTY <= 0){

                Session::flash("error_message","Sorry, Product quantity left in your shop is too low to perform this transaction.  Kindly send a stock request.");
                return redirect()->back();
            }else{

                // Set Condition On Product Qty
                if($data['qtysold'] >= $wholesaleQTY){
                  
                    $totalamt = $data['qtysold'] * $prodWholepx;

                    $goods = new OtherShopGoods;
                    $goods->branch_id = $branchid;
                    $goods->product_id = $data['productid'];
                    $goods->goods_qty = $data['qtysold'];
                    $goods->unit_price = $prodWholepx;
                    $goods->total_amt = $totalamt;
                    $goods->amt_paid = 0.00;
                    $goods->cust_name = $data['cusname'];
                    $goods->receivedby = "";
                    $goods->goods_date = date("Y-m-d H:i:s");
                    $goods->status = 1;
                    $goods->user_id = $userId;

                    $goods->save();

                    Session::flash("success_message","Details recorded successfully.  Goods can be given out now");
                    return redirect()->back();
                }else{

                    $totalamt = $data['qtysold'] * $prodUnitpx;

                    $goods = new OtherShopGoods;
                    $goods->branch_id = $branchid;
                    $goods->product_id = $data['productid'];
                    $goods->goods_qty = $data['qtysold'];
                    $goods->unit_price = $prodUnitpx;
                    $goods->total_amt = $totalamt;
                    $goods->amt_paid = 0.00;
                    $goods->cust_name = $data['cusname'];
                    $goods->receivedby = "";
                    $goods->goods_date = date("Y-m-d H:i:s");
                    $goods->status = 1;
                    $goods->user_id = $userId;

                    $goods->save();

                    Session::flash("success_message","Details recorded successfully.  Goods can be given out now");
                    return redirect()->back();
                }
            }
        }
    }




    // Fetch Gas Pounds
    public function gaspds(){
        $metaTitle = "Fetch Gas Pounds | IMS CHI-BOY ENTERPRISE";
        
        // Get Branch Id
        // $user = Auth::guard('user')->user();
        // $user = json_decode(json_encode($user));
        // echo "<pre>"; print_r($user); die;
        // $branchid = $user->branchId;
        // dd($branchid); die;
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];



        $gaspds = GasPds::with(['branch'=>function($query){
            $query->select('id','branch_name');
        },'user'=>function($query){
            $query->select('id','name');
        },'category'=>function($query){
            $query->select('id','category_name');
        },'products'=>function($query){
            $query->select('id','product_code','product_name');
        }])->where('branch_id',$branchid)->get();
        $gaspds = json_decode(json_encode($gaspds));

        // echo "<pre>"; print_r($gaspds); die;

        return view('layouts.sales.stocks.gaspds')->with(compact('metaTitle','gaspds'));

    }


    // Open New Gas Cylinder
    public function opengas(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            // dd($data); die;


            // Get Branch Id
            // $user = Auth::guard('user')->user();
            // $user = json_decode(json_encode($user));
            // echo "<pre>"; print_r($user); die;
            // $branchid = $user->branchId;
            // dd($branchid); die;
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];




            $productId = $data['productid'];
            $qtyOPEN = $data['qtyopen'];

            $weight1 = $qtyOPEN * 27;
            $weight2 = $qtyOPEN * 11;
            $weight3 = $qtyOPEN * 19;
            $weight4 = $qtyOPEN * 23;


            // Get Category Id
            $category = Products::with(['branch','category'])->where('id',$productId)->where('branch_id',$branchid)->first();
            $category = json_decode(json_encode($category));

            // echo "<pre>"; print_r($category); die;

            $categoryId = $category->category->id;
            $prodname = $category->product_name;
            $prodQty = $category->product_qty;


            // echo "<pre>"; print_r($categoryId); die;

            // Set Condition for Product Name
            if($prodname == 'R134 Gas Pds (Ref)'){

                // Update Product Table for Gas Pds
                Products::where('id',$productId)->where('branch_id',$branchid)->update(['product_qty'=> $prodQty + $weight1 ]);


                // Query Products Table to Get Main Cylinder of The Pds
                $cylinder = Products::where('branch_id',$branchid)->where('product_name','R134 Gas Cylinder (Ref)')->first();
                $cylinder = json_decode(json_encode($cylinder));

                // echo "<pre>"; print_r($cylinder); die;

                $prodId = $cylinder->id;
                $prodName = $cylinder->product_name;
                $prodQuantity = $cylinder->product_qty;


                // Update Product Table for Gas Cylinder
                Products::where('product_name',$prodName)->where('branch_id',$branchid)->update(['product_qty'=> $prodQuantity - $qtyOPEN ]);


                // Insert Details Into Gas Pds Table
                $gaspds = new GasPds;
                $gaspds->category_id = $categoryId;
                $gaspds->product_id = $productId;
                $gaspds->branch_id = $branchid;
                $gaspds->qty_open = $qtyOPEN;
                $gaspds->weight_pds = $weight1;
                $gaspds->date_open = date("Y-m-d H:i:s");
                $gaspds->status = 1;

                Session::flash("sucess_message","Congrats, you have successfully opened new gas cylinder as pounds.");
                return redirect()->back();

            }elseif($prodname == 'R406 Gas Pds (Ref)'){

                 // Update Product Table for Gas Pds
                 Products::where('id',$productId)->where('branch_id',$branchid)->update(['product_qty'=> $prodQty + $weight1 ]);


                 // Query Products Table to Get Main Cylinder of The Pds
                 $cylinder = Products::where('id',$productId)->where('branch_id',$branchid)->where('product_name','R406 Gas Cylinder (Ref)')->first();
                 $cylinder = json_decode(json_encode($cylinder));
 
                 $prodId = $cylinder->id;
                 $prodName = $cylinder->product_name;
                 $prodQuantity = $cylinder->product_qty;
 
 
                 // Update Product Table for Gas Cylinder
                 Products::wwhere('product_name',$prodName)->where('branch_id',$branchid)->update(['product_qty'=> $prodQuantity - $qtyOPEN ]);
 
 
                 // Insert Details Into Gas Pds Table
                 $gaspds = new GasPds;
                 $gaspds->category_id = $categoryId;
                 $gaspds->product_id = $productId;
                 $gaspds->branch_id = $branchid;
                 $gaspds->qty_open = $qtyOPEN;
                 $gaspds->weight_pds = $weight1;
                 $gaspds->date_open = date("Y-m-d H:i:s");
                 $gaspds->status = 1;
 
                 Session::flash("sucess_message","Congrats, you have successfully opened new gas cylinder as pounds.");
                 return redirect()->back();

            }elseif($prodname == 'R407 Gas Pds (Ref)'){

                 // Update Product Table for Gas Pds
                 Products::where('id',$productId)->where('branch_id',$branchid)->update(['product_qty'=> $prodQty + $weight4 ]);


                 // Query Products Table to Get Main Cylinder of The Pds
                 $cylinder = Products::where('id',$productId)->where('branch_id',$branchid)->where('product_name','R407 Gas Cylinder (Ref)')->first();
                 $cylinder = json_decode(json_encode($cylinder));
 
                 $prodId = $cylinder->id;
                 $prodName = $cylinder->product_name;
                 $prodQuantity = $cylinder->product_qty;
 
 
                 // Update Product Table for Gas Cylinder
                 Products::where('product_name',$prodName)->where('branch_id',$branchid)->update(['product_qty'=> $prodQuantity - $qtyOPEN ]);
 
 
                 // Insert Details Into Gas Pds Table
                 $gaspds = new GasPds;
                 $gaspds->category_id = $categoryId;
                 $gaspds->product_id = $productId;
                 $gaspds->branch_id = $branchid;
                 $gaspds->qty_open = $qtyOPEN;
                 $gaspds->weight_pds = $weight4;
                 $gaspds->date_open = date("Y-m-d H:i:s");
                 $gaspds->status = 1;
 
                 Session::flash("sucess_message","Congrats, you have successfully opened new gas cylinder as pounds.");
                 return redirect()->back();


            }elseif($prodname == 'R22 Gas Pds (Ref)'){

                 // Update Product Table for Gas Pds
                 Products::where('id',$productId)->where('branch_id',$branchid)->update(['product_qty'=> $prodQty + $weight1 ]);


                 // Query Products Table to Get Main Cylinder of The Pds
                 $cylinder = Products::where('id',$productId)->where('branch_id',$branchid)->where('product_name','R22 Gas Cylinder (Ref)')->first();
                 $cylinder = json_decode(json_encode($cylinder));
 
                 $prodId = $cylinder->id;
                 $prodName = $cylinder->product_name;
                 $prodQuantity = $cylinder->product_qty;
 
 
                 // Update Product Table for Gas Cylinder
                 Products::where('product_name',$prodName)->where('branch_id',$branchid)->update(['product_qty'=> $prodQuantity - $qtyOPEN ]);
 
 
                 // Insert Details Into Gas Pds Table
                 $gaspds = new GasPds;
                 $gaspds->category_id = $categoryId;
                 $gaspds->product_id = $productId;
                 $gaspds->branch_id = $branchid;
                 $gaspds->qty_open = $qtyOPEN;
                 $gaspds->weight_pds = $weight1;
                 $gaspds->date_open = date("Y-m-d H:i:s");
                 $gaspds->status = 1;
 
                 Session::flash("sucess_message","Congrats, you have successfully opened new gas cylinder as pounds.");
                 return redirect()->back();


            }elseif($prodname == 'R600 Gas Pds'){

                // Update Product Table for Gas Pds
                Products::where('id',$productId)->where('branch_id',$branchid)->update(['product_qty'=> $prodQty + $weight2 ]);


                // Query Products Table to Get Main Cylinder of The Pds
                $cylinder = Products::where('id',$productId)->where('branch_id',$branchid)->where('product_name','R600 Gas Cylinder')->first();
                $cylinder = json_decode(json_encode($cylinder));

                $prodId = $cylinder->id;
                $prodName = $cylinder->product_name;
                $prodQuantity = $cylinder->product_qty;


                // Update Product Table for Gas Cylinder
                Products::where('product_name',$prodName)->where('branch_id',$branchid)->update(['product_qty'=> $prodQuantity - $qtyOPEN ]);


                // Insert Details Into Gas Pds Table
                $gaspds = new GasPds;
                $gaspds->category_id = $categoryId;
                $gaspds->product_id = $productId;
                $gaspds->branch_id = $branchid;
                $gaspds->qty_open = $qtyOPEN;
                $gaspds->weight_pds = $weight2;
                $gaspds->date_open = date("Y-m-d H:i:s");
                $gaspds->status = 1;

                Session::flash("sucess_message","Congrats, you have successfully opened new gas cylinder as pounds.");
                return redirect()->back();

            }elseif($prodname == 'R404 Gas Pds (Ref)'){

                // Update Product Table for Gas Pds
                Products::where('id',$productId)->where('branch_id',$branchid)->update(['product_qty'=> $prodQty + $weight4]);


                // Query Products Table to Get Main Cylinder of The Pds
                $cylinder = Products::where('id',$productId)->where('branch_id',$branchid)->where('product_name','R404 Gas Cylinder (Ref)')->first();
                $cylinder = json_decode(json_encode($cylinder));

                $prodId = $cylinder->id;
                $prodName = $cylinder->product_name;
                $prodQuantity = $cylinder->product_qty;


                // Update Product Table for Gas Cylinder
                Products::where('product_name',$prodName)->where('branch_id',$branchid)->update(['product_qty'=> $prodQuantity - $qtyOPEN ]);


                // Insert Details Into Gas Pds Table
                $gaspds = new GasPds;
                $gaspds->category_id = $categoryId;
                $gaspds->product_id = $productId;
                $gaspds->branch_id = $branchid;
                $gaspds->qty_open = $qtyOPEN;
                $gaspds->weight_pds = $weight4;
                $gaspds->date_open = date("Y-m-d H:i:s");
                $gaspds->status = 1;

                Session::flash("sucess_message","Congrats, you have successfully opened new gas cylinder as pounds.");
                return redirect()->back();

            }elseif($prodname == 'R410 Gas Pds (Ref)'){

                // Update Product Table for Gas Pds
                Products::where('id',$productId)->where('branch_id',$branchid)->update(['product_qty'=> $prodQty + $weight4]);


                // Query Products Table to Get Main Cylinder of The Pds
                $cylinder = Products::where('id',$productId)->where('branch_id',$branchid)->where('product_name','R410 Gas Cylinder (Ref)')->first();
                $cylinder = json_decode(json_encode($cylinder));

                $prodId = $cylinder->id;
                $prodName = $cylinder->product_name;
                $prodQuantity = $cylinder->product_qty;


                // Update Product Table for Gas Cylinder
                Products::where('product_name',$prodName)->where('branch_id',$branchid)->update(['product_qty'=> $prodQuantity - $qtyOPEN ]);


                // Insert Details Into Gas Pds Table
                $gaspds = new GasPds;
                $gaspds->category_id = $categoryId;
                $gaspds->product_id = $productId;
                $gaspds->branch_id = $branchid;
                $gaspds->qty_open = $qtyOPEN;
                $gaspds->weight_pds = $weight4;
                $gaspds->date_open = date("Y-m-d H:i:s");
                $gaspds->status = 1;

                Session::flash("sucess_message","Congrats, you have successfully opened new gas cylinder as pounds.");
                return redirect()->back();

            }elseif($prodname == 'Fridge Cap. (cut)'){

                // Update Product Table for Gas Pds
                Products::where('id',$productId)->where('branch_id',$branchid)->update(['product_qty'=> $prodQty + $weight3]);


                // Query Products Table to Get Main Cylinder of The Pds
                $cylinder = Products::where('id',$productId)->where('branch_id',$branchid)->where('product_name','Fridge Cap. (Roll)')->first();
                $cylinder = json_decode(json_encode($cylinder));

                $prodId = $cylinder->id;
                $prodName = $cylinder->product_name;
                $prodQuantity = $cylinder->product_qty;


                // Update Product Table for Gas Cylinder
                Products::where('product_name',$prodName)->where('branch_id',$branchid)->update(['product_qty'=> $prodQuantity - $qtyOPEN ]);


                // Insert Details Into Gas Pds Table
                $gaspds = new GasPds;
                $gaspds->category_id = $categoryId;
                $gaspds->product_id = $productId;
                $gaspds->branch_id = $branchid;
                $gaspds->qty_open = $qtyOPEN;
                $gaspds->weight_pds = $weight3;
                $gaspds->date_open = date("Y-m-d H:i:s");
                $gaspds->status = 1;

                Session::flash("sucess_message","Congrats, you have successfully cut one roll of fridge cap.");
                return redirect()->back();

            }elseif($prodname == ""){

                Session::flash("error_message","Sorry your product name was not included in the system.  Please contact your Software Engineer.");
                return redirect()->back();

            }


        }
    }



    // View Product Price List
    public function viewprice(){

        $metaTitle = "Product Price List | IMS CHI-BOY ENTERPRISE";


        // Get Branch Id
        // $user = Auth::guard('user')->user();
        // $user = json_decode(json_encode($user));
        // echo "<pre>"; print_r($user); die;
        // $branchid = $user->branchId;
        // dd($branchid); die;
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];



        $viewprices = Products::with('category')->where('branch_id',$branchid)->where('status',1)->get();
        $viewprices = json_decode(json_encode($viewprices));

        // echo "<pre>"; print_r($viewprices); die;


        return view('layouts.sales.stocks.view_price')->with(compact('metaTitle','viewprices'));
    }
}
