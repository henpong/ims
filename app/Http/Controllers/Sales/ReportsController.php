<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Receipt;
use App\Models\Expenses;

class ReportsController extends Controller
{
         //View Previous Sales Transaction
         public function salestrans(Request $request){
        
            $metaTitle = "Sales Transaction | CHIBOY ENTERPRISE";
    
            
            return view('layouts.sales.reports.salestrans')->with(compact('metaTitle'));
        }
    
    
    
        //View Previous Sales Transaction
        public function previoussalestransaction(Request $request){
            
            $metaTitle = "Sales Transaction | CHIBOY ENTERPRISE";
    
            if($request->isMethod('post')){
    
                $data = $request->all();
    
                // echo "<pre>"; print_r($data); die;
    
                 //Make Rules & Custom Messages For Validation
                 $rules = [
    
                    'transactionDate' => 'required',
                ];
                $customMessages = [
    
                    'transactionDate.required' => 'Sorry,  transaction date field is required'
    
                ];
                $this->validate($request,$rules,$customMessages);
                
    
               if(empty($data['transactionDate'])){
    
                    Session::flash('error_message','Sorry, no date entered.  Please select a date');
                    return redirect()->back();
    
               }else{
    
                     // Get Branch Id
                    $userId = session('user')['userid'];
                    $branchid = session('user')['branchid'];
    
                    $date = $data['transactionDate'];
                    $trans_date = date("Y-m-d",strtotime($date));
    
                    $salestrans = Receipt::with(['branch','products'])->where('branch_id',$branchid)->whereDate('transaction_date', $trans_date)->where('status',1)->orderBy('id','DESC')->get();
                    $salesdate = Receipt::where('branch_id',$branchid)->whereDate('transaction_date', $trans_date)->where('status',1)->first();
                
               }
    
                // echo "<pre>"; print_r($salesdate); die;
    
            }
    
            
            return view('layouts.sales.reports.salestrans')->with(compact('metaTitle','salestrans','salesdate'));
        }
    
    
    
           // Monthly Sales
           public function monthlysales(){
            Session::put('page','monthlysales');
             $metaTitle = "Monthly Sales | CHIBOY ENTERPRISE";
            
            return view('layouts.sales.reports.monthly_reports')->with(compact('metaTitle'));
        }
    
    
    
    
         //View Previous Sales Transaction
         public function monthlysalestransaction(Request $request){
            
            $metaTitle = "Sales Transaction | CHIBOY ENTERPRISE";
    
            if($request->isMethod('post')){
    
                $data = $request->all();
    
                // echo "<pre>"; print_r($data); die;
    
    
                 //Make Rules & Custom Messages For Validation
                 $rules = [
    
                    'monthTransactionDate' => 'required',
                ];
                $customMessages = [
    
                    'monthTransactionDate.required' => 'Sorry,  transaction date field is required'
    
                ];
                $this->validate($request,$rules,$customMessages);
    
                
                // Get Branch Id
                $userId = session('user')['userid'];
                $branchid = session('user')['branchid'];
    
                // $transDate = $data['monthTransactionDate'];
                // $transactionDate = date("Y-m-d - Y-m-d",strtotime($transDate));
    
                // echo "<pre>"; print_r($transDate); die;
    
    
    
                $transDate = explode("-", $data['monthTransactionDate']);
                // echo "<pre>"; print_r($transDate[1]); die;
    
                $startDate = date('Y-m-d',strtotime($transDate[0]));
                $endDate = date('Y-m-d',strtotime($transDate[1]));
    
                // echo "<pre>"; print_r($startDate);
                // echo "<pre>"; print_r($endDate); die;
    
                $salestrans = Receipt::with(['branch','products'])->where('branch_id',$branchid)->whereBetween('transaction_date',[$startDate, Carbon::parse($endDate)->endOfDay() ])->where('status',1)->orderBy('id','DESC')->get();
                // echo "<pre>"; print_r($salestrans); die;
                // $salesdate = Receipt::where('branch_id',$branchid)->whereDate('transaction_date', $trans_date)->where('status',1)->first();
                
                // echo "<pre>"; print_r($salestrans); die;
    
            }
    
            
            return view('layouts.sales.reports.monthly_reports')->with(compact('metaTitle','salestrans','startDate','endDate'));
        }
    
    
    
    
    
    
        
        // Previous Expenses
        public function expensesmade(){
    
            Session::put('page','monthlysales');
            $metaTitle = "Previous Expenses | CHIBOY ENTERPRISE";
    
    
            return view('layouts.sales.reports.prev_expenses')->with(compact('metaTitle'));
        }
    
    
    
         //View Previous Expenses
         public function prev_expenses(Request $request){
            
            $metaTitle = "Previous Expenses | CHIBOY ENTERPRISE";
    
            if($request->isMethod('post')){
    
                $data = $request->all();
    
                // echo "<pre>"; print_r($data); die;
    
                 //Make Rules & Custom Messages For Validation
                 $rules = [
    
                    'expenseDate' => 'required',
                ];
                $customMessages = [
    
                    'expenseDate.required' => 'Sorry,  expenses date field is required'
    
                ];
                $this->validate($request,$rules,$customMessages);
                
    
               if(empty($data['expenseDate'])){
    
                    Session::flash('error_message','Sorry, no expense date entered.  Please select a date');
                    return redirect()->back();
    
               }else{
    
                     // Get Branch Id
                    $userId = session('user')['userid'];
                    $branchid = session('user')['branchid'];
    
                    $date = $data['expenseDate'];
                    $trans_date = date("Y-m-d",strtotime($date));
    
                    $expensetrans = Expenses::with('branch','user')->where('branch_id',$branchid)->whereDate('expense_date',$trans_date)->where('status',1)->orderBy('id','DESC')->get();
                    $expensedate = Expenses::where('branch_id',$branchid)->whereDate('expense_date', $trans_date)->where('status',1)->first();
                
               }
    
                // echo "<pre>"; print_r($salesdate); die;
    
            }
    
            
            return view('layouts.sales.reports.prev_expenses')->with(compact('metaTitle','expensetrans','expensedate'));
        }
    
    
    
    
}
