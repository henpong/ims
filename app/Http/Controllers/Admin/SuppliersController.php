<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Suppliers;

class SuppliersController extends Controller
{
           //Direct to Suppliers Page
           public function suppliers(){
            Session::put('page','suppliers');
            $metaTitle = "Suppliers | CHIBOY ENTERPRISE";
            $getSuppliers = Suppliers::orderBy('id','DESC')->get();
            // $getSuppliers = json_decode(json_encode($getSuppliers));
            // echo "<pre>"; print_r($getSuppliers); die;
            return view('layouts.admin.suppliers.suppliers')->with(compact('getSuppliers','metaTitle'));
        }
     
    
        //Add & Edit Suppliers
        public function addEditSuppliers(Request $request, $id=null){
            if($id == ""){
                // Add Functionality
                $title = "Add Suppliers";
                $metaTitle = "Add Suppliers | CHIBOY ENTERPRISE";
    
                $getSupplierData = array();
    
    
                $supply = new Suppliers;
                $message = "Congrats, new supplier added successfully!";
    
            }else{
                // Edit Functionality
                $title = "Update Suppliers";
                $metaTitle = "Update Suppliers | CHIBOY ENTERPRISE";
    
                $getSupplierData = Suppliers::where('id',$id)->first();
    
                $supply = Suppliers::find($id);
                $message = "Congrats, supplier updated successfully!";
    
            }
    
           if($request->isMethod('post')){
               $data = $request->all();
    
    
               //Make Rules & Custom Messages For Validation
               $rules = [
                'supplierName' => 'required',
                'supplierAddress' => 'required',
                'supplierPhone' => 'required',
                'supplierCountry' => 'required'
                ];
                $customMessages = [
                    'supplierName.required' => 'Sorry, supplier name field is required',
                    'supplierAddress.required' => 'Sorry, supplier address field is required',
                    'supplierPhone.required' => 'Sorry, supplier phone field is required',
                    'supplierCountry.required' => 'Sorry, supplier country field is required'
                ];
                $this->validate($request,$rules,$customMessages);
    
    
                // Check whether supplier already exists
                if($id == ""){
    
                    // Check If Supplier already exists
                    $checkSupplierNameExists = Suppliers::where('supplier_name',$data['supplierName'])->count();
                    
                    if($checkSupplierNameExists > 0){
                        return redirect('admin/suppliers')->with('error_message','Sorry, this supplier already exists');
                    }
                }
    
               $supply->supplier_name = $data['supplierName'];
               $supply->supplier_address = $data['supplierAddress'];
               $supply->supplier_contact = $data['supplierPhone'];
               $supply->supplier_country = $data['supplierCountry'];
               $supply->supplier_status = 1;
       
               $supply->save();
       
               Session::flash('success_message',$message);
               return redirect('admin/suppliers');
           }
    
           
           return view('layouts.admin.suppliers.add_edit_supplier')->with(compact('title','metaTitle','getSupplierData'));
        }
    
    
    
    
        //Update Supplier Status
        public function updateSupplierStatus(Request $request){
            if($request->ajax()){
                $data = $request->all();
    
                //echo "<pre>"; print_r($data); die;
    
                //Set A Value For Status
                if($data['supplier_status'] == "Active"){
                    $status = 0;
                }else{
                    $status = 1;
                }
    
                //Update Supplier Status
                Suppliers::where('id',$data['supplier_id'])->update(['supplier_status'=>$status]);
                return response()->json(['supplier_status'=>$status,'supplier_id'=>$data['supplier_id']]);
            }
        }
     
    
        //Delete Supplier
        public function deleteSupplier($id){
            Suppliers::where('id',$id)->delete();
    
            $message = "Congrats, supplier has been deleted successfully!";
            session::flash('success_message',$message);
            return redirect('admin/suppliers');
        }
}
