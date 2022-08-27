<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use Image;
use App\Models\User;
use App\Models\History;



class UsersController extends Controller
{
          // Redirect to Login Page
          public function saleslogin(Request $request,$id=null){
            $metaTitle = "Login | CHIBOY ENTERPRISE";
            if($request->isMethod('post')){
                $data = $request->all();
    
                // return $request->input();
             
    
                //Check if Email and Password are Correct Then Direct User to The Dashboard
                if(Auth::guard('user')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>1])){
                    
                    $pass = Auth::guard('user')->user()->first()->password;
                    $pass = json_decode(json_encode($pass));
    
                    // echo "<pre>"; print_r($pass); die;
    
                    // Force User to Change Password After First Login
                    if($pass == (Hash::make('password'))){
                        return redirect('sales/firstlogin');
                    }else{
    
                        $statement = "has logged into the system at ";
    
                        // Insert Activity Into History Table
                        $history = new History;
                        $history->user_id = Auth::guard('user')->user()->id;
                        $history->activity = $statement;
                        $history->status = 1;
                        $history->save();
    
    
                        // Get Users Details In A Session
                        $newuser = User::with('userbranch')->where('email',$request->input(['email']))->first();
                        session::put('user', ['email' => $request->input('email'), 'userid' => $newuser->id,
                        'password' => $request->input('password'),'branchid'=> $newuser->branchId]);
                        $request->session()->push('user',$newuser);
                        // $user = session::get('user');
                        // echo "<pre>"; print_r($user); die;
            
                        
                        Session::flash('success_message','Successsfuly login');
                        
                        return redirect('sales/dashboard');
                    }
    
                }elseif(Auth::guard('user')->attempt(['email'=>$data['email'],'password'=>$data['password'],'status'=>2])){
                    Session::flash('error_message','Sorry, this user is inactive.');
                    return redirect()->back();
                }else{
                    Session::flash('error_message','Incorrect email address or password entered.');
                    return redirect()->back();
                }
    
            }
            return view('layouts.sales.index')->with(compact('metaTitle'));
        }
    
    
        // Force Users to Change Password After First Login
        public function firstlogin(){
            return view('layouts.sales.login.checkpassword');
        }
    
    
    
        // Redirect to Dashboard
        public function dashboard(){
            Session::put('page','Users Dashboard');
            $metaTitle = "Dashboard | CHIBOY ENTERPRISE";
    
            return view('layouts.sales.dashboard')->with(compact('metaTitle'));
        }
    
    
    
    
        // Account Settings
        public function changepassword(){
            
            $metaTitle = "Update Password Settings | CHIBOY ENTERPRISE";
            $userdetails = User::where('email',Auth::guard('user')->user()->email)->first();
    
            return view('layouts.sales.login.settings')->with(compact('metaTitle','userdetails'));
        }
    
    
        //Check User Password Is Correct or Not
        public function chkCurrentPass(Request $request){
            if($request->isMethod('post')){
                $data = $request->all();
    
                // echo "<pre>"; print_r($data);
                // echo "<pre>"; print_r(Auth::guard('user')->user()->password); die;
    
                //Check Whether Current Password Matches With The Password In The Database
                if(Hash::check($data['currentPass'],Auth::guard('user')->user()->password)){
                    echo "true";
                }else{
                    echo "false";
                }
            }
        }
    
    
        //Post Admin Password
        public function updatePass(Request $request){
            if($request->isMethod('post')){
                $data = $request->all();
                // echo "<pre>"; print_r($data); die;
    
                //Check Whether Current Password Is Correct
                if(Hash::check($data['currentPass'],Auth::guard('user')->user()->password)){
                    //Check if New and Confirm Password Matches
                    if($data['newPass'] == $data['confirmPass']){
                        //Update User Old Password to New Password
                        User::where('id',Auth::guard('user')->user()->id)->update(['password'=>bcrypt($data['newPass'])]);
                        Session::flash('success_message','OK Friend, Password Updated Successfully.');
                    }else{
                        Session::flash('error_message','Sorry, New and Confirm Password mismatch.');
                    }
                }else{
                    Session::flash('error_message','Sorry, Your current password is incorrect.');
                }
                return redirect()->back();
            }
        }
    
    
    
         //LogOut
         public function logout(){
    
            $statement = "has logged out of the system at";
    
            // Insert Activity Into History Table
            $history = new History;
            $history->user_id = Auth::guard('user')->user()->id;
            $history->activity = $statement;
            $history->status = 1;
            $history->save();
    
    
            session()->forget('userdetails');
    
            Auth::guard('user')->logout();
            Session::flash('success_message','You have been logged out successfully.');
            return redirect('sales/login');
        }


}
