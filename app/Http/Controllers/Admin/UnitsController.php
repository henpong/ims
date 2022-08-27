<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Unit;



class UnitsController extends Controller
{
         //Direct to Units Page
         public function units(){
            Session::put('page','units');
            $units = Unit::orderBy('id','DESC')->get();
            $metaTitle = "Units | CHIBOY ENTERPRISE";
    
            return view('layouts.admin.units.units')->with(compact('units','metaTitle'));
        }
    
        //Update Unit Status
        public function updateUnitStatus(Request $request){
            //Get Request From Ajax
            if($request->ajax()){
                $data = $request->all();
    
                //echo "<pre>"; print_r($data); die;
    
                //Set a Value For Status
                if($data['unit_status'] == "Active"){
                    $status = 0;
                }else{
                    $status = 1;
                }
    
                //Update Section Status
                Unit::where('id',$data['unit_id'])->update(['unit_status'=>$status]);
                return response()->json(['unit_status'=>$status, 'unit_id'=>$data['unit_id']]);
    
            }
        }
    
    
        //Insert & Update Unit
        public function addEditUnits(Request $request,$id=null){
            if($id == ""){
                //Add Functionality
                $title = "Add Unit";
                $metaTitle = "Add Unit | CHIBOY ENTERPRISE";
    
    
                
                $units = new Unit;
                $message = "Congrats, new unit added successfully!";
                
                $getUnitsData = array();
    
            }else{
                //Update Functionality
                $title = "Update Unit";
                $metaTitle = "Update Unit | CHIBOY ENTERPRISE";
                $getUnitsData = Unit::where('id',$id)->first();
                //$getUnitsData = json_decode(json_encode($getUnitsData),true);
    
                $units = Unit::find($id);
                $message = "Congrats, unit updated successfully!";
            }
    
            if($request->isMethod('post')){
                $data = $request->all();
    
    
    
                    //Make Rules & Custom Messages For Validation
                    $rules = [
                        'unitName' => 'required',
                        'shortName' => 'required'
                    ];
                    $customMessages = [
                        'unitName.required' => 'Sorry, unit name field is required',
                        'shortName.required' => 'Sorry, short name field is required'
                    ];
                    $this->validate($request,$rules,$customMessages); 
    
    
    
    
                
                if($id == ""){
    
                    // Check If Unit already exists
                    $checkUnitNameExists = Unit::where('unit_name',$data['unitName'])->count();
                    // echo "<pre>"; print_r($checkUnitNameExists); die;
    
                    if($checkUnitNameExists > 0){
    
                        return redirect('admin/units')->with('error_message','Sorry, this unit already exists');
    
                    }else{
    
                        
                        $units->unit_name = $data['unitName'];
                        $units->short_name = $data['shortName'];
                        $units->unit_status = 1;
    
                        $units->save();
    
                        $message = "Congrats, new unit added successfully!";
                        session::flash('success_message',$message);
                        return redirect('admin/units');
                    }
    
                }else{
    
                      
                        $units->unit_name = $data['unitName'];
                        $units->short_name = $data['shortName'];
                        $units->unit_status = 1;
            
                        $units->save();
    
                        $message = "Congrats, section updated successfully!";
                        session::flash('success_message',$message);
                        return redirect('admin/units');
    
                }
                
            }
    
            return view('layouts.admin.units.add_edit_units')->with(compact('title','metaTitle','getUnitsData'));
        }
    
    
        //Delete Units
        public function deleteUnits($id){
            Unit::where('id',$id)->delete();
    
            $message = "Congrats, unit deleted successfully!";
    
            session::flash('success_message',$message);
            return redirect('admin/units');
        }
    
}
