<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Sections;

class SectionsController extends Controller
{
       //Direct to Sections Page
       public function sections(){
        Session::put('page','sections');
        $sections = Sections::orderBy('id','DESC')->get();
        $metaTitle = "Sections | CHIBOY ENTERPRISE";

        return view('layouts.admin.section.sections')->with(compact('sections','metaTitle'));
    }

    //Update Sections Status
    public function updateSectionStatus(Request $request){
        //Get Request From Ajax
        if($request->ajax()){
            $data = $request->all();

            //echo "<pre>"; print_r($data); die;

            //Set a Value For Status
            if($data['section_status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }

            //Update Section Status
            Sections::where('id',$data['section_id'])->update(['section_status'=>$status]);
            return response()->json(['section_status'=>$status, 'section_id'=>$data['section_id']]);

        }
    }


    //Insert & Update Sections
    public function addEditSections(Request $request,$id=null){
        if($id == ""){
            //Add Functionality
            $title = "Add Sections";
            $metaTitle = "Add Sections | CHIBOY ENTERPRISE";


            
            $sections = new Sections;
            $message = "Congrats, new section added successfully!";
            
            $getSectionsData = array();

        }else{
            //Update Functionality
            $title = "Update Sections";
            $metaTitle = "Update Sections | CHIBOY ENTERPRISE";
            $getSectionsData = Sections::where('id',$id)->first();
            //$getSectionsData = json_decode(json_encode($getSectionsData),true);

            $sections = Sections::find($id);
            $message = "Congrats, section updated successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();



                //Make Rules & Custom Messages For Validation
                $rules = [
                    'sectionsName' => 'required'
                ];
                $customMessages = [
                    'sectionsName.required' => 'Sorry, section name field is required'
                ];
                $this->validate($request,$rules,$customMessages); 




            
            if($id == ""){

                // Check If Section already exists
                $checkSectionNameExists = Sections::where('name',$data['sectionsName'])->count();
                // echo "<pre>"; print_r($checkSectionNameExists); die;

                if($checkSectionNameExists > 0){

                    return redirect('admin/sections')->with('error_message','Sorry, this section already exists');

                }else{

                    
                    $sections->name = strtoupper($data['sectionsName']);
                    $sections->section_status = 1;

                    $sections->save();

                    $message = "Congrats, new section added successfully!";
                    session::flash('success_message',$message);
                    return redirect('admin/sections');
                }

            }else{

                  
                    $sections->name = strtoupper($data['sectionsName']);
                    $sections->section_status = 1;
        
                    $sections->save();

                    $message = "Congrats, section updated successfully!";
                    session::flash('success_message',$message);
                    return redirect('admin/sections');

            }
            
        }

        return view('layouts.admin.section.add_edit_sections')->with(compact('title','metaTitle','getSectionsData'));
    }


    //Delete Sections
    public function deleteSections($id){
        Sections::where('id',$id)->delete();

        $message = "Congrats, section deleted successfully!";

        session::flash('success_message',$message);
        return redirect('admin/sections');
    }
    
}
