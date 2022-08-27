<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Branches;

class BranchesController extends Controller
{
        //Direct to Branches Page
        public function branches(){
            Session::put('page','branches');
            $metaTitle = "Branches | CHIBOY ENTERPRISE";
            $branches = Branches::orderBy('id','DESC')->get();
            return view('layouts.admin.branch.branches')->with(compact('branches','metaTitle'));
        }
    
        //Update Branch Status
        public function updateBranchStatus(Request $request){
            if($request->ajax()){
                $data = $request->all();
    
                // dd($data);
    
                //Set a value for status
                if($data['branch_status'] == "Active"){
                    $status = 0;
                }else{
                    $status = 1;
                }
     
                //Update Branch Status
                Branches::where('id',$data['branch_id'])->update(['branch_status'=>$status]);
                return response()->json(['branch_status'=>$status, 'branch_id'=>$data['branch_id']]);
            }
        }
    
    
    
        //Add & Update 
        public function addEditBranches(Request $request, $id=null){
            if($id == ""){
                //Add Functionality
                $title = "Add Branches";
                $metaTitle = "Add Branches | CHIBOY ENTERPRISE";
    
       
    
                $getBranchData = array();
    
                $branches = new Branches;
    
                
                $message = "Congrats, new branch added successfully!";
    
            }else{
                //Update Functionality
                $title = "Update Branches";
                $metaTitle = "Update Branches | CHIBOY ENTERPRISE";
    
                $getBranchData = Branches::where('id',$id)->first();
                //$getBranchData = json_decode(json_encode($getBranchData), true);
                
                //echo "<pre>"; print_r($getBranchData); die;
                $branches = Branches::find($id);
    
                $message = "Congrats, branch updated successfully!";
    
            }
    
                if($request->isMethod('post')){
                    $data = $request->all();
    
                //echo "<pre>"; print_r($data); die;
    
                
    
                    //Make Rules & Custom Messages For Validation
                    $rules = [
                        'branchName' => 'required',
                        'branchColour' => 'required',
                        'branchPhone' => 'required',
                        'branchAddress' => 'required'
                    ];
                    $customMessages = [
                        'branchName.required' => 'Sorry, branch name field is required',
                        'branchColour.required' => 'Sorry, branch colour field is required',
                        'branchPhone.required' => 'Sorry, branch phone field is required',
                        'branchAddress.required' => 'Sorry, branch address field is required'
                    ];
                    $this->validate($request,$rules,$customMessages); 
    
    
    
                    if($id == ""){
                        // Check If Branch already exists
                        $checkBranchNameExists = Branches::where('branch_name',$data['branchName'])->count();
                        //echo "<pre>"; print_r($checkBranchNameExists); die;
                        if($checkBranchNameExists > 0){
    
                            return redirect('admin/branches')->with('error_message','Sorry, this branch already exists');
    
                        }
                    }
    
                    $countbranch = Branches::count();
    
                    if($countbranch <= 0 ){
    
                        $branches->branch_name = strtoupper($data['branchName']);
                        $branches->branch_colour = strtoupper($data['branchColour']);
                        $branches->branch_contact = strtoupper($data['branchPhone']);
                        $branches->branch_address = strtoupper($data['branchAddress']);
                        $branches->branch_status = 1;
                        $branches->status = 1;
    
                        $branches->save();
    
                        session::flash('success_message',$message);
                        return redirect('admin/branches');
                        
                    }else{
    
                        $branstatus = Branches::select('status')->latest()->value('status');
                        $branstatus = $branstatus + 1;
    
                        $branches->branch_name = strtoupper($data['branchName']);
                        $branches->branch_colour = strtoupper($data['branchColour']);
                        $branches->branch_contact = strtoupper($data['branchPhone']);
                        $branches->branch_address = strtoupper($data['branchAddress']);
                        $branches->branch_status = 1;
                        $branches->status = $branstatus;
    
                        $branches->save();
    
                        session::flash('success_message',$message);
                        return redirect('admin/branches');
    
                    }
    
                
            }
    
            return view('layouts.admin.branch.add_edit_branches')->with(compact('title','metaTitle','getBranchData'));
        }
    
    
    
    
        //Delete Branch
        public function deleteBranch($id){
            Branches::where('id',$id)->delete();
    
            $message = "Congrats, Branch deleted successfully!";
            
            session::flash('success_message',$message);
            return redirect('admin/branches');
        }
}
