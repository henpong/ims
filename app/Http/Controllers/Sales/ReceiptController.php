<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Receipt;
use App\Models\Customers;
use App\Models\Expenses;
use App\Models\Payments;
use BulkSMS\GiantSMS;




class ReceiptController extends Controller
{
       
    // Generate Transaction Receipt
    public function transReceipt(Request $request, $id){
       
        $metaTitle = "Transaction Receipt | CHIBOY ENTERPRISE";
        
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];
        // echo "<pre>"; print_r($userId); die;

        $date = date("Y-m-d");

        $invoicedetails = Receipt::with('branch')->where('customer_id',$id)->whereDate('transaction_date',$date)->where('branch_id',$branchid)->where('status',1)->first();
        $invoicedetails = json_decode(json_encode($invoicedetails));

        // echo "<pre>"; print_r($invoicedetails); die;

        $invoice = Receipt::with(['branch','products','customers'])->where('customer_id',$id)->whereDate('transaction_date',$date)->where('branch_id',$branchid)->where('status',1)->get();
        $invoice = json_decode(json_encode($invoice));
        // echo "<pre>"; print_r($invoice); die;


        // Calculate for total 
        $subtotal = Receipt::select('sub_total')->where('customer_id',$id)->whereDate('transaction_date',$date)->where('branch_id',$branchid)->where('status',1)->get();
        // $subtotal = json_decode(json_encode($subtotal));

        // echo "<pre>"; print_r($subtotal); die;


        return view('layouts.sales.receipt.receipt',['subtotal'=>$subtotal->sum('sub_total')])->with(compact('metaTitle','invoice','invoicedetails'));
    }


    
    // Temporal Transaction Success Message
    public function successmsgTempTrans(Request $request, $id){

        $metaTitle = "Credit Transaction Receipt | CHIBOY ENTERPRISE";
        
        return view('layouts.sales.receipt.temp_receipt')->with(compact('metaTitle'));
    }




    // Generate Credit Transaction Receipt
    public function transCreditReceipt(Request $request, $id){
       
        $metaTitle = "Credit Transaction Receipt | CHIBOY ENTERPRISE";
        
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];
        // echo "<pre>"; print_r($userId); die;


        $date = date("Y-m-d");

        $invoicedetails = Receipt::with('branch')->where('customer_id',$id)->where('branch_id',$branchid)->where('status',2)->latest()->first();
        $invoicedetails = json_decode(json_encode($invoicedetails));


        // echo "<pre>"; print_r($invoicedetails); die;
        $receiptnum = $invoicedetails->receipt_no;
        // echo "<pre>"; print_r($receiptnum); die;

        $invoice = Receipt::with(['branch','products','customers'])->where('customer_id',$id)->where('branch_id',$branchid)->whereDate('transaction_date',$date)->where('receipt_no',$receiptnum)->where('status',2)->latest()->get();
        $invoice = json_decode(json_encode($invoice));

        // echo "<pre>"; print_r($invoice); die;


        // $credithistory = SalesDetails::with(['branch','products','sales','customers','payments'])->where('branch_id',$branchid)->where('customer_id',$id)->where('status',2)->orderBy('id','DESC')->get();
        // $credithistory = json_decode(json_encode($credithistory));

        // echo "<pre>"; print_r($credithistory); die;

        
        // Calculate for total 
        $subtotal = Receipt::select('sub_total')->where('customer_id',$id)->whereDate('transaction_date',$date)->where('branch_id',$branchid)->where('receipt_no',$receiptnum)->where('status',2)->get();
        // $subtotal = json_decode(json_encode($subtotal));

        // echo "<pre>"; print_r($subtotal); die;


        // Payments Made
        // $payments = Payments::with(['branch','sales','customers'])->where('branch_id',$branchid)->where('cust_id',$id)->where('status',"Not Paid")->sum('payment');
        
        // Get All Payments
        $payments = Payments::with(['branch','customers','sales'])->where('branch_id',$branchid)->where('cust_id',$id)->where('or_no',$receiptnum)->where('status','Not Paid')->get();
        $payments = json_decode(json_encode($payments));
        // echo "<pre>"; print_r($payments); die;


        return view('layouts.sales.receipt.credit_receipt',['subtotal'=>$subtotal->sum('sub_total')])->with(compact('metaTitle','invoice','invoicedetails','payments'));
    }






    

    public function reprint(Request $request){
        if($request->isMethod('post')){

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            $metaTitle = "Transaction Receipt | CHIBOY ENTERPRISE";
        
            $userId = session('user')['userid'];
            $branchid = session('user')['branchid'];
            // echo "<pre>"; print_r($userId); die;
    

            $receiptnom = $data['receiptnom'];
            $transDate = date("Y-m-d", strtotime($data['transactionDate']));

            // echo "<pre>"; print_r($transDate); die;
    
            $invoicedetails = Receipt::with('branch')->where('receipt_no',$receiptnom)->whereDate('transaction_date',$transDate)->where('branch_id',$branchid)->where('status',1)->first();
            $invoicedetails = json_decode(json_encode($invoicedetails));
    
            // echo "<pre>"; print_r($invoicedetails); die;
    
            $invoice = Receipt::with(['branch','products','customers'])->where('receipt_no',$receiptnom)->whereDate('transaction_date',$transDate)->where('branch_id',$branchid)->where('status',1)->get();
            $invoice = json_decode(json_encode($invoice));
            // echo "<pre>"; print_r($invoice); die;
    
    
            // Calculate for total 
            $subtotal = Receipt::select('sub_total')->where('receipt_no',$receiptnom)->whereDate('transaction_date',$transDate)->where('branch_id',$branchid)->where('status',1)->get();
            // $subtotal = json_decode(json_encode($subtotal));
    
            // echo "<pre>"; print_r($subtotal); die;
    
    
            // return view('layouts.sales.receipt.receipt',['subtotal'=>$subtotal->sum('sub_total')])->with(compact('metaTitle','invoice','invoicedetails'));
        }

        return view('layouts.sales.receipt.receipt',['subtotal'=>$subtotal->sum('sub_total')])->with(compact('metaTitle','invoice','invoicedetails'));
    }




}
