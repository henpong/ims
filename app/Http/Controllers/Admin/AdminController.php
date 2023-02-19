<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Hash;
use Session;
use App\Models\Admin;
use App\Models\StockRequest;
use Image;




class AdminController extends Controller
{

   
    //Direct to Login Page
    public function login(Request $request){
        $metaTitle = "Admin Login | CHIBOY ENTERPRISE";
        //echo $pass = Hash::make('password'); die;
        if($request->isMethod('post')){
            $data = $request->all();

            //Check if Username and Password are Correct Then Direct User to The Dashboard
            if(Auth::guard('admin')->attempt(['username'=>$data['username'],'password'=>$data['password']])){
                if(Auth::guard('admin')->user()->log_status == 1){
                    Session::flash('first_log','Successsfuly login');
                    return redirect('admin/dashboard');
                }else{
                    Session::flash('success_message','Successsfuly login');
                    return redirect('admin/dashboard');
                }
            }else{
                Session::flash('error_message','Incorrect username or password entered');
                return redirect()->back();
            }
        }
        return view('layouts.admin.admin_login');
    }


    //Direct to Dashboard
    public function dashboard(){
        Session::put('page','dashboard');
        $metaTitle = "Admin Dashboard | CHIBOY ENTERPRISE";
        return view('layouts.admin.dashboard')->with(compact('metaTitle'));
    }


    //Direct to Settings Page
    public function settings(){
        Session::put('page','settings');
        $metaTitle = "Update Password Settings | CHIBOY ENTERPRISE";
        $adminDetails = Admin::where('username',Auth::guard('admin')->user()->username)->first();
        return view('layouts.admin.settings')->with(compact('adminDetails','metaTitle'));
    }



    //Check Admin Password Is Correct or Not
    public function chkCurrentPass(Request $request){
        $data = $request->all();

        // echo "<pre>"; print_r($data);
        // echo "<pre>"; print_r(Auth::guard('admin')->user()->password); die;

        //Check Whether Current Password Matches With The Password In The Database
        if(Hash::check($data['currentPass'],Auth::guard('admin')->user()->password)){
            echo "true";
        }else{
            echo "false";
        }
    }


    

    //Post Admin First Time Password
    public function updateFirstTimePass(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            //Check if New and Confirm Password Matches
            if($data['newFirstTimePass'] == $data['confirmFirstTimePass']){
                //Update Admin Old Password to New Password
                Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['newFirstTimePass']), 'log_status'=>2]);
                Session::flash('upd_pass','OK Friend, Password Updated Successfully.');
            }else{
                Session::flash('error_message','Sorry, New and Confirm Password mismatch.');
            }
            return redirect()->back();
        }
    }




    //Post Admin Password
    public function updatePass(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            //Check Whether Current Password Is Correct
            if(Hash::check($data['currentPass'],Auth::guard('admin')->user()->password)){
                //Check if New and Confirm Password Matches
                if($data['newPass'] == $data['confirmPass']){
                    //Update Admin Old Password to New Password
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['newPass'])]);
                    Session::flash('upd_pass','OK Friend, Password Updated Successfully.');
                    // return redirect('admin/settings')->with('upd_pass');
                    // return redirect('/admin/logOut');
                }else{
                    Session::flash('error_message','Sorry, New and Confirm Password mismatch.');
                }
            }else{
                Session::flash('error_message','Sorry, Your current password is incorrect.');
            }
            return redirect()->back();
        }
    }



    //Update Admin Details
    public function updateAdminDetails(Request $request){
         Session::put('page','update_admin_details');
         $metaTitle = "Update Profile Details | CHIBOY ENTERPRISE";
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            //Make Rules & Custom Messages For Validation
            $rules = [
                'adminName' => 'required',
                'adminPhone' => 'required|numeric|min:10',
                'adminImage' => 'image|mimes:jpeg,jpg,gif,png,svg|max:2048'
            ];
            $customMessages = [
                'adminName.required' => 'Sorry, This Field is Required',
                'adminName.alpha' => 'Please Enter Valid Characters',
                'adminPhone.required' => 'Sorry, This Field is Required',
                'adminPhone.numeric' => 'Please Enter Valid Characters',
                'adminImage' => 'Please Upload a Valid Image'
            ];
            $this->validate($request,$rules,$customMessages);

            //Upload Image
            if($request->hasFile('adminImage')){
                $image_temp = $request->file('adminImage');
                //Check Whether The Image Is Valid Or Not
                if($image_temp->isValid()){
                    //Get Image Extension
                    $extension = $image_temp->getClientOriginalExtension();
                    //Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'backEnd/img/uploadedImages/adminImages/'.$imageName;
                    //Now We Upload The New Image
                    Image::make($image_temp)->resize(150,150)->save($imagePath);
                }else if(!empty($data['currentAdminImage'])){
                    $imageName = $data['currentAdminImage'];
                }else{
                    $imageName = "";
                }
            }


            //Update Admin Table With The Details
            Admin::where('username',Auth::guard('admin')->user()->username)
            ->update(['name'=>$data['adminName'],'phone'=>$data['adminPhone'],'image'=>$imageName]);
            Session::flash('success_message','Admin Details Updated Successfully.');
            return redirect()->back();
        }
        return view('layouts.admin.update_admin_details')->with(compact('metaTitle'));
    }


    //LogOut
    public function logout(){
        Auth::guard('admin')->logout();
        Session::flash('success_message','You have been logged out successfully.');
        // Session::save();
        return redirect('/admin');
    }


}
