<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StockRequest;
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
}
