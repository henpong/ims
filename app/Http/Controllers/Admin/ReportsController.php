<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Receipt;
use App\Models\Expenses;
use Carbon\Carbon;



class ReportsController extends Controller
{
       // Daily Sales
       public function dailysales(){
        Session::put('page','dailysales');
         $metaTitle = "Daily Sales | CHIBOY ENTERPRISE";
        
        
        return view('layouts.admin.reports.daily_report')->with(compact('metaTitle'));
    }




     //View Previous Sales Transaction
     public function previoussalestransaction(Request $request){
        
        $metaTitle = "Sales Transaction | CHIBOY ENTERPRISE";

        if($request->isMethod('post')){

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;


             //Make Rules & Custom Messages For Validation
             $rules = [
                'branchid' => 'required',
                'transactionDate' => 'required',
            ];
            $customMessages = [
                'branchid.required' => 'Sorry,  branch name field is required',
                'transactionDate.required' => 'Sorry,  transaction date field is required'

            ];
            $this->validate($request,$rules,$customMessages);

            // Get Branch Id
            // $userId = session('user')['userid'];
            $branchid = $data['branchid'];

            $date = $data['transactionDate'];
            $trans_date = date("Y-m-d",strtotime($date));

            $salestrans = Receipt::with(['branch','products'])->where('branch_id',$branchid)->whereDate('transaction_date', $trans_date)->where('status',1)->orderBy('id','DESC')->get();
            $salesdate = Receipt::where('branch_id',$branchid)->whereDate('transaction_date', $trans_date)->where('status',1)->first();
            

            // echo "<pre>"; print_r($salestrans); die;

        }

        
        return view('layouts.admin.reports.daily_report')->with(compact('metaTitle','salestrans','salesdate'));
    }



    // Monthly Sales
    public function monthlysales(){
        Session::put('page','monthlysales');
         $metaTitle = "Monthly Sales | CHIBOY ENTERPRISE";
        
        return view('layouts.admin.reports.monthly_report')->with(compact('metaTitle'));
    }




     //View Previous Sales Transaction
     public function monthlysalestransaction(Request $request){
        
        $metaTitle = "Sales Transaction | CHIBOY ENTERPRISE";

        if($request->isMethod('post')){

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;


             //Make Rules & Custom Messages For Validation
             $rules = [
                'branchid' => 'required',
                'monthTransactionDate' => 'required',
            ];
            $customMessages = [
                'branchid.required' => 'Sorry,  branch name field is required',
                'monthTransactionDate.required' => 'Sorry,  transaction date field is required'

            ];
            $this->validate($request,$rules,$customMessages);

            // Get Branch Id
            // $userId = session('user')['userid'];
            $branchid = $data['branchid'];

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

        
        return view('layouts.admin.reports.monthly_report')->with(compact('metaTitle','salestrans','startDate','endDate'));
    }





    // Daily Shop Expenses
    public function shopdailyexpenses(){
        Session::put('page','shopdailyexpenses');
         $metaTitle = "Daily Expenses | CHIBOY ENTERPRISE";
        
        
        return view('layouts.admin.reports.daily_expenses_report')->with(compact('metaTitle'));
    }



    
     //View Previous Sales Transaction
     public function previousshopexpenses(Request $request){
        
        $metaTitle = "Expenses Transaction | CHIBOY ENTERPRISE";

        if($request->isMethod('post')){

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;


             //Make Rules & Custom Messages For Validation
             $rules = [
                'branchid' => 'required',
                'expensesDate' => 'required',
            ];
            $customMessages = [
                'branchid.required' => 'Sorry,  branch name field is required',
                'expensesDate.required' => 'Sorry,  date field is required'

            ];
            $this->validate($request,$rules,$customMessages);

            // Get Branch Id
            // $userId = session('user')['userid'];
            $branchid = $data['branchid'];
            // echo "<pre>"; print_r($branchid); die;


            $date = $data['expensesDate'];
            $trans_date = date("Y-m-d",strtotime($date));

            $expensetrans = Expenses::with(['branch'])->where('branch_id',$branchid)->whereDate('expense_date', $trans_date)->where('status',1)->orderBy('id','DESC')->get();
            $expensedate = Expenses::select('expense_date')->where('branch_id',$branchid)->whereDate('expense_date', $trans_date)->where('status',1)->first();
            

            // echo "<pre>"; print_r($expensedate); die;

        }

        
        return view('layouts.admin.reports.daily_expenses_report')->with(compact('metaTitle','expensetrans','expensedate'));
    }




    // Monthly Sales
    public function shopmonthexpenses(){
        Session::put('page','monthlysales');
         $metaTitle = "Monthly Expenses | CHIBOY ENTERPRISE";
        
        return view('layouts.admin.reports.monthly_expenses_report')->with(compact('metaTitle'));
    }




     //View Previous Sales Transaction
     public function monthlyexpenses(Request $request){
        
        $metaTitle = "Monthly Expenses | CHIBOY ENTERPRISE";

        if($request->isMethod('post')){

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;


            //Make Rules & Custom Messages For Validation
            $rules = [
                'branchid' => 'required',
                'monthExpensesDate' => 'required',
            ];
            $customMessages = [
                'branchid.required' => 'Sorry,  branch name field is required',
                'monthExpensesDate.required' => 'Sorry,  expenses date field is required'

            ];
            $this->validate($request,$rules,$customMessages);

            // Get Branch Id
            // $userId = session('user')['userid'];
            $branchid = $data['branchid'];

            // $transDate = $data['monthTransactionDate'];
            // $transactionDate = date("Y-m-d - Y-m-d",strtotime($transDate));

            // echo "<pre>"; print_r($transDate); die;



            $transDate = explode("-", $data['monthExpensesDate']);
            // echo "<pre>"; print_r($transDate[1]); die;

            $startDate = date('Y-m-d',strtotime($transDate[0]));
            $endDate = date('Y-m-d',strtotime($transDate[1]));

            // echo "<pre>"; print_r($startDate);
            // echo "<pre>"; print_r($endDate); die;

            $expensetrans = Expenses::with(['branch'])->where('branch_id',$branchid)->whereBetween('expense_date',[$startDate, Carbon::parse($endDate)->endOfDay() ])->where('status',1)->orderBy('id','DESC')->get();
            // echo "<pre>"; print_r($expensetrans); die;
            // $salesdate = Receipt::where('branch_id',$branchid)->whereDate('transaction_date', $trans_date)->where('status',1)->first();
            
            // echo "<pre>"; print_r($salestrans); die;

        }

        
        return view('layouts.admin.reports.monthly_expenses_report')->with(compact('metaTitle','expensetrans','startDate','endDate'));
    }






}
