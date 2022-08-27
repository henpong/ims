<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\Creditor;
use App\Models\User;
use App\Models\Expenses;
use Session;


class CustomersController extends Controller
{
    //Get Customers & Creditors 
    public function customers(Request $request){
        
        Session::put('page','customers');
        $metaTitle = "Customers | CHIBOY ENTERPRISE";
        $customers = Customers::with(['users','branch'])->where('status',1)->orderBy('id','DESC')->get();
        $customers = json_decode(json_encode($customers));
        // echo "<pre>"; print_r($customers); die;

        return view('layouts.admin.stocks.customers')->with(compact('customers','metaTitle'));
    }

 




    // Daily Expenses
    public function expenses(){
        $metaTitle = "Daily Expenses | CHIBOY ENTERPRISE";

        // $userId = session('user')['userid'];
        // $branchid = session('user')['branchid'];

        $date = date("Y-m-d");


        $expenses = Expenses::with('branch','user')->whereDate('expense_date',$date)->where('status',1)->orderBy('id','DESC')->get();
            
        // echo "<pre>"; print_r($expenses); die;

        return view('layouts.admin.expenses.expenses')->with(compact('metaTitle','expenses'));
    }



}
