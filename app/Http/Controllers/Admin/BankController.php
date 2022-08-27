<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banks;
use Session;

class BankController extends Controller
{
     //Direct to Bank Page
     public function banks(){
        Session::put('page','bankers');
        $metaTitle = "Bank Accounts | CHIBOY ENTERPRISE";
        $banks = Banks::orderBy('id','DESC')->get();
        return view('layouts.admin.bank.bank')->with(compact('banks','metaTitle'));
    }

    //Update Bank Status
    public function updateBankStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

           // echo "<pre>"; print_r($data); die;

            //Set Condition
            if($data['ac_status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }

            //Update Bank Status
            Banks::where('id',$data['bank_id'])->update(['ac_status'=>$status]);
            return response()->json(['ac_status'=>$status, 'bank_id'=>$data['bank_id']]);
        }
    }


    //Insert & Update Bank Table
    public function addEditBank(Request $request,$id=null){
        if($id == ""){
            //Add Functionality
            $title = "Add Account Details";
            $metaTitle = "Add Accounts | CHIBOY ENTERPRISE";
            
            $getBankData = array();
            
            $banks = new Banks;
            $message = "Congrats, account details added successfully!";

        }else{
            //Add Functionality
            $title = "Update Account Details";
            $metaTitle = "Update Accounts | CHIBOY ENTERPRISE";
            
            $getBankData = Banks::where('id',$id)->first();

            $banks = Banks::find($id);
            $message = "Congrats, account details updated successfully!";


        }

        if($request->isMethod('post')){
            $data = $request->all();


            // Check If Bank already exists
            $checkBankNameExists = Banks::where('acnumber',$data['acNomba'])->count();
            if($checkBankNameExists > 0){

                return redirect('admin/bankers')->with('error_message','Sorry, this account already exists');

            }


                //Make Rules & Custom Messages For Validation
                $rules = [
                    'bankName' => 'required',
                    'acName' => 'required',
                    'branch' => 'required',
                    'acNomba' => 'required',
                    'actype' => 'required'
                ];
                $customMessages = [
                    'bankName.required' => 'Sorry, bank name field is required',
                    'acName.required' => 'Sorry, account name field is required',
                    'branch.required' => 'Sorry, account branch field is required',
                    'acNomba.required' => 'Sorry, account number field is required',
                    'actype.required' => 'Sorry, account type field is required'
                ];
                $this->validate($request,$rules,$customMessages); 


            $banks->bankname = strtoupper($data['bankName']);
            $banks->acname = strtoupper($data['acName']);
            $banks->acbranch = strtoupper($data['branch']);
            $banks->acnumber = strtoupper($data['acNomba']);
            $banks->actype = strtoupper($data['actype']);
            $banks->ac_status = 1;

            $banks->save();
            session::flash('success_message',$message);
            return redirect('admin/bankers');
        }

        return view('layouts.admin.bank.add_edit_bank')->with(compact('getBankData','title','metaTitle'));
    }


    //Delete Data From Bank
    public function deleteBank($id){
        Banks::where('id',$id)->delete();

        $message = "Congrats, account deleted successfully!";
        session::flash('success_message',$message);
        return redirect('admin/bankers');
    }

}
