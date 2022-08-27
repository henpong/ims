<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
       //Direct to Sections Page
       public function warehouses(){
        Session::put('page','warehouse');
        $warehouses = Warehouse::orderBy('id','DESC')->get();
        $metaTitle = "Warehouses | CHIBOY ENTERPRISE";

        return view('layouts.admin.warehouse.warehouse')->with(compact('warehouses','metaTitle'));
    }

    //Update Warehouse Status
    public function updateWarehouseStatus(Request $request){
        //Get Request From Ajax
        if($request->ajax()){
            $data = $request->all();

            //echo "<pre>"; print_r($data); die;

            //Set a Value For Status
            if($data['warehouse_status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }

            //Update Warehouse Status
            Warehouse::where('id',$data['warehouse_id'])->update(['warehouse_status'=>$status]);
            return response()->json(['warehouse_status'=>$status, 'warehouse_id'=>$data['warehouse_id']]);

        }
    }


    //Insert & Update Warehouse
    public function addEditWarehouses(Request $request,$id=null){
        if($id == ""){
            //Add Functionality
            $title = "Add Warehouse";
            $metaTitle = "Add Warehouse | CHIBOY ENTERPRISE";


            
            $warehouse = new Warehouse;
            $message = "Congrats, new warehouse added successfully!";
            
            $getWarehouseData = array();

        }else{
            //Update Functionality
            $title = "Update Warehouse";
            $metaTitle = "Update Warehouse | CHIBOY ENTERPRISE";
            $getWarehouseData = Warehouse::where('id',$id)->first();
            //$getWarehouseData = json_decode(json_encode($getWarehouseData),true);

            $warehouse = Warehouse::find($id);
            $message = "Congrats, warehouse updated successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();



                //Make Rules & Custom Messages For Validation
                $rules = [
                    'warehouseName' => 'required',
                    'warehouseLocation' => 'required'
                ];
                $customMessages = [
                    'warehouseName.required' => 'Sorry, warehouse name field is required',
                    'warehouseLocation.required' => 'Sorry, warehouse location is required'
                ];
                $this->validate($request,$rules,$customMessages); 




            
            if($id == ""){

                // Check If Warehouse already exists
                $checkWarehouseNameExists = Warehouse::where('name',$data['warehouseName'])->count();
                // echo "<pre>"; print_r($checkWarehouseNameExists); die;

                if($checkWarehouseNameExists > 0){

                    return redirect('admin/warehouses')->with('error_message','Sorry, this warehouse already exists');

                }else{

                    
                    $warehouse->name = strtoupper($data['warehouseName']);
                    $warehouse->location = $data['warehouseLocation'];
                    $warehouse->warehouse_status = 1;

                    $warehouse->save();

                    $message = "Congrats, new warehouse added successfully!";
                    session::flash('success_message',$message);
                    return redirect('admin/warehouses');
                }

            }else{

                  
                    $warehouse->name = strtoupper($data['warehouseName']);
                    $warehouse->location = $data['warehouseLocation'];
                    $warehouse->warehouse_status = 1;
        
                    $warehouse->save();

                    $message = "Congrats, warehouse updated successfully!";
                    session::flash('success_message',$message);
                    return redirect('admin/warehouses');

            }
            
        }

        return view('layouts.admin.warehouse.add_edit_warehouse')->with(compact('metaTitle','getWarehouseData'));
    }




    //Delete Warehouse
    public function deleteWarehouses($id){
        Warehouse::where('id',$id)->delete();

        $message = "Congrats, warehouse deleted successfully!";

        session::flash('success_message',$message);
        return redirect('admin/warehouses');
    }

}
