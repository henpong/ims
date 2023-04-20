<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockRequest;
use App\Models\SpoiltGoods;
use Session;

class StockRequestController extends Controller
{
       //Get Request For Low Stocks
       public function stocks(Request $request){
        Session::put('page','stockrequest');
        $metaTitle = "Stock Requests | CHIBOY ENTERPRISE";
        $stockrequests = StockRequest::with(['products'=>function($query){
            $query->select('id','product_name','product_code','product_price');
        },'branch'=>function($query){
            $query->select('id','branch_name');
        }])->where(function($query){
            $query->where('del_id',1);
        
        })->orderBy('id','DESC')->get();

 
        // $stockrequests = json_decode(json_encode($stockrequests));
        // echo "<pre>"; print_r($stockrequests); die;
        
        return view('layouts.admin.stocks.stock_request')->with(compact('stockrequests','metaTitle'));
    }

 
    //Take Decision On Stock Request
    public function stockrequest(Request $request){
        if($request->isMethod('POST')){
            $data = $request->all();
 
            // echo "<pre>"; print_r($data); die;

            $requestId = $data['request_id'];
            $requestStatus = $data['request_status'];

            $approvMSG = "Congrats, You Have Approved The Request!!";
            $rejectMSG = "Sorry, You Have Rejected The Request!!";
            $pendMSG = "Ooh No, The Request Is Still Pending!!";

            if($requestStatus == "Approved"){

                StockRequest::where('id',$data['request_id'])->update(['request_status'=>$data['request_status']]);

                session::flash('success_message',$approvMSG);
                return redirect('admin/stock_request');

            }elseif($requestStatus == "Rejected"){

                StockRequest::where('id',$data['request_id'])->update(['request_status'=>$data['request_status']]);

                session::flash('error_message',$rejectMSG);
                return redirect('admin/stock_request');

            }elseif($requestStatus == "Pending"){

                StockRequest::where('id',$data['request_id'])->update(['request_status'=>$data['request_status']]);

                session::flash('error_message',$pendMSG);
                return redirect('admin/stock_request');

            }else{

                session::flash('error_message','Sorry! No option was selected. Please select an option.');
                return redirect('admin/stock_request');

            }

            
        }
    }



    
    // View Spoilt Goods Awaiting Approval
    public function spoiltgoods(Request $request){

        $metaTitle = "Spoilt Goods Entered | CHIBOY ENTERPRISE";

        $spoiltgoods = SpoiltGoods::with(['products','branch','user'])->where('spoilt_status',1)->orderBy('id','DESC')->get();

        // $stockrequests = json_decode(json_encode($spoiltgoods));
        // echo "<pre>"; print_r($spoiltgoods); die;

        return view('layouts.admin.stocks.spoilt_goods')->with(compact('metaTitle', 'spoiltgoods'));
    }




    // Check Spoilt Goods
    public function checkgoods(Request $request){
        if($request->isMethod('POST')){
            $data = $request->all();
 
            // echo "<pre>"; print_r($data); die;

            $requestId = $data['request_id'];
            $requestStatus = $data['request_status'];
            $productid = $data['product_id'];
            $branchid = $data['branch_id'];


            $approvMSG = "Congrats, You Have Checked The Goods!!";
            $rejectMSG = "Sorry, You Have Rejected The Request!!";
            $pendMSG = "Ooh No, The Request Is Still Pending!!";


            if($requestStatus == 2){

                
                // Get Product Quantity
                $getProd = Products::where('id',$productid)->where('branch_id',$branchid)->where('status',1)->first();
                $getProd = json_decode(json_encode($getProd));

                // echo "<pre>"; print_r($getProd); die;
                $productQTY = $getProd->product_qty;


                // Get Stock Quantity
                $getStock = SpoiltGoods::where('product_id',$productid)->where('branch_id',$branchid)->where('spoilt_status',1)->where('check_status',1)->first();
                $getStock = json_decode(json_encode($getStock));

                // echo "<pre>"; print_r($getStock); die;
                $stockQTY = $getStock->qty_spoilt;


                // Update Product Qty In Product Table
                Products::where('id',$productid)->where('branch_id',$branchid)->where('status',1)->update(['product_qty'=> $productQTY - $stockQTY ]);


                // Update Stock Request Table
                SpoiltGoods::where('id',$data['request_id'])->update(['check_status'=>$data['request_status']]);


                session::flash('success_message',$approvMSG);
                return redirect('admin/spoilt_goods');

            }elseif($requestStatus == 3){

                SpoiltGoods::where('id',$data['request_id'])->update(['check_status'=>$data['request_status']]);

                session::flash('error_message',$rejectMSG);
                return redirect('admin/spoilt_goods');

            }elseif($requestStatus == 1){

                SpoiltGoods::where('id',$data['request_id'])->update(['check_status'=>$data['request_status']]);

                session::flash('error_message',$pendMSG);
                return redirect('admin/spoilt_goods');

            }else{

                session::flash('error_message','Sorry! No option was selected. Please select an option.');
                return redirect('admin/spoilt_goods');

            }

            
        }
    }



}
