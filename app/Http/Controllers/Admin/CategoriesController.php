<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Sections;
use Session;

class CategoriesController extends Controller
{
        //Direct to Categories Page
        public function categories(){
            Session::put('page','categories');
            $metaTitle = "Categories | CHIBOY ENTERPRISE";
            $categories = Categories::with(['section_name','parentname'])->orderBy('id','DESC')->get();
             //Get Data In Section
             $getSections = Sections::orderBy('id','DESC')->get();
            // $categories = json_decode(json_encode($categories));
            // echo "<pre>"; print_r($categories); die;
            return view('layouts.admin.categories.categories')->with(compact('categories','getSections','metaTitle'));
        }
    
    
    
    
        //Update Categories Status
        public function updateCategoryStatus(Request $request){
            if($request->ajax()){
                $data = $request->all();
    
                //Set A Value For Status
                if($data['category_status'] == "Active"){
                    $status = 0;
                }else{
                    $status = 1;
                }
    
                //Update Category Status
                Categories::where('id',$data['category_id'])->update(['category_status'=>$status]);
                return response()->json(['category_status'=>$status, 'category_id'=>$data['category_id']]);
            }
        }
    
    
    
    
        //Insert & Edit Categories
        public function addEditCategory(Request $request,$id=null){
    
            if($id == ""){
                //Add Insert Functionality
                $title = "Add Categories";
                $metaTitle = "Add Categories | CHIBOY ENTERPRISE";
                
                $getCategoriesData = array();
                $getCategories = array();
    
                $categories = new Categories;
    
                $message = "Congrats, new category added successfully!";
    
            }else{
                //Update Functionality
                $title = "Update Categories";
                $metaTitle = "Update Categories | CHIBOY ENTERPRISE";
    
                //Get Categories Data
                $getCategoriesData = Categories::where('id',$id)->first();
                //echo "<pre>"; print_r($getCategoriesData); die;
    
                $getCategories = Categories::with('subcategories')->where(['parent_id'=>0, 'section_id'=>$getCategoriesData['section_id']])->get();
                $getCategories = json_decode(json_encode($getCategories),true);
                //echo "<pre>"; print_r($getCategories); die;
    
    
                $categories = Categories::find($id);
    
                $message = "Congrats, category updated successfully!";
    
    
            }
                    
            //Insert Category Functionality
            if($request->isMethod('post')){
                $data = $request->all();
    
                
                // Check If Category already exists
                $checkCategoryNameExists = Categories::where('category_name',$data['categoryName'])->count();
                if($checkCategoryNameExists > 0){
                    return redirect('admin/categories')->with('error_message','Sorry, this category already exists');
                }
    
    
    
                 //Make Rules & Custom Messages For Validation
                $rules = [
                    'categoryName' => 'required',
                    'parent_id' => 'required',
                    'section_id' => 'required'
                ];
                $customMessages = [
                    'categoryName.required' => 'Sorry, category name field is required',
                    'parent_id.required' => 'Sorry, category level field is required',
                    'section_id.required' => 'Sorry, section name field is required'
                ];
                $this->validate($request,$rules,$customMessages);
    
                $categories->parent_id = $data['parent_id'];
                $categories->section_id = $data['section_id'];
                $categories->category_name = $data['categoryName'];
                $categories->category_status = 1;
    
                $categories->save();
    
                session::flash('success_message',$message);
                return redirect('admin/categories');
            }
    
            $getSections = Sections::get();
            return view('layouts.admin.categories.add_edit_category')->with(compact('title','metaTitle','getSections','getCategoriesData','getCategories'));
        }
     
    
    
    
        //Append Categories Level
        public function appendCategoriesLevel(Request $request){
            if($request->ajax()){
                $data = $request->all();
    
                //echo "<pre>"; print_r($data); die;
    
                //Select from Category where parent id is 0, status is 1 and section id
                $getCategories = Categories::with('subcategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0,'category_status'=>1])->get();
                $getCategories = json_decode(json_encode($getCategories),true);
                //echo "<pre>"; print_r($getCategories); die;
                return view('layouts.admin.categories.append_categories_level')->with(compact('getCategories'));
            }
        }
    
    
        
    
        //Delete Category
        public function deleteCategory($id){
            Categories::where('id',$id)->delete();
    
            $message = "Category deleted successfully!";
    
            session::flash('success_message',$message);
            return redirect('admin/categories');
        }
}
