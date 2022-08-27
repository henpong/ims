<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Brand;


class BrandsController extends Controller
{
        //Direct to Brands Page
        public function brands(){
            Session::put('page','brands');
            $brands = Brand::orderBy('id','DESC')->get();
            $metaTitle = "Brands | CHIBOY ENTERPRISE";
    
            return view('layouts.admin.brands.brands')->with(compact('brands','metaTitle'));
        }
    
        //Update Brands Status
        public function updateBrandStatus(Request $request){
            //Get Request From Ajax
            if($request->ajax()){
                $data = $request->all();
    
                //echo "<pre>"; print_r($data); die;
    
                //Set a Value For Status
                if($data['brand_status'] == "Active"){
                    $status = 0;
                }else{
                    $status = 1;
                }
    
                //Update Brand Status
                Brand::where('id',$data['brand_id'])->update(['brand_status'=>$status]);
                return response()->json(['brand_status'=>$status, 'brand_id'=>$data['brand_id']]);
    
            }
        }
    
    
        //Insert & Update Brand
        public function addEditBrands(Request $request,$id=null){
            if($id == ""){
                //Add Functionality
                $title = "Add Brands";
                $metaTitle = "Add Brands | CHIBOY ENTERPRISE";
    
    
                
                $brands = new Brand;
                $message = "Congrats, new brand added successfully!";
                
                $getBrandsData = array();
    
            }else{
                //Update Functionality
                $title = "Update Brands";
                $metaTitle = "Update Brands | CHIBOY ENTERPRISE";
                $getBrandsData = Brand::where('id',$id)->first();
                //$getBrandsData = json_decode(json_encode($getBrandsData),true);
    
                $brands = Brand::find($id);
                $message = "Congrats, brand updated successfully!";
            }
    
            if($request->isMethod('post')){
                $data = $request->all();
    
                // echo "<pre>"; print_r($data); die;
    
                    //Make Rules & Custom Messages For Validation
                    $rules = [
                        'brandName' => 'required'
                    ];
                    $customMessages = [
                        'brandName.required' => 'Sorry, brand name field is required'
                    ];
                    $this->validate($request,$rules,$customMessages); 
    
    
    
    
                
                if($id == ""){
    
                    // Check If Brand already exists
                    $checkBrandNameExists = Brand::where('brand_name',$data['brandName'])->count();
                    // echo "<pre>"; print_r($checkBrandNameExists); die;
    
                    if($checkBrandNameExists > 0){
    
                        return redirect('admin/brands')->with('error_message','Sorry, this brand already exists');
    
                    }else{
    
                        
                        $brands->brand_name = strtoupper($data['brandName']);
                        $brands->description = $data['description'];
                        $brands->brand_status = 1;
    
                        $brands->save();
    
                        $message = "Congrats, new brand added successfully!";
                        session::flash('success_message',$message);
                        return redirect('admin/brands');
                    }
    
                }else{
    
                      
                        $brands->brand_name = strtoupper($data['brandName']);
                        $brands->description = $data['description'];
                        $brands->brand_status = 1;
            
                        $brands->save();
    
                        $message = "Congrats, brand updated successfully!";
                        session::flash('success_message',$message);
                        return redirect('admin/brands');
    
                }
                
            }
    
            return view('layouts.admin.brands.add_edit_brands')->with(compact('title','metaTitle','getBrandsData'));
        }
    
    
        //Delete Brand
        public function deleteBrands($id){
            Brand::where('id',$id)->delete();
    
            $message = "Congrats, brand deleted successfully!";
    
            session::flash('success_message',$message);
            return redirect('admin/brands');
        }
    
    
}
