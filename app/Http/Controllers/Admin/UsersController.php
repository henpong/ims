<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Hash;

use App\Models\User;
use App\Models\Admin;
use App\Models\Branches;
use Image;
use BulkSMS\GiantSMS;




class UsersController extends Controller
{
    
    // Redirect to Users Table
    public function users(){
        Session::put('page','users');
        $metaTitle = "Users | CHIBOY ENTERPRISE";
        $users = User::with(['userbranch'=>function($query){
            $query->select('id','branch_name');
        }])->orderBy('id','DESC')->get();

        // dd($users); die;

        
        return view('layouts.admin.users.users')->with(compact('users','metaTitle'));
    }



    // Redirect to Admin Users
    public function admins(){
        Session::put('page','admins');
        $metaTitle = "Admin Users | CHIBOY ENTERPRISE";
       
        $admins = Admin::with(['branch'=>function($query){
            $query->select('id','branch_name');
        }])->orderBy('id','DESC')->get();
        // dd($admins); die;

        return view('layouts.admin.users.admins')->with(compact('admins','metaTitle'));
    }




     //Update Admin Users Status
     public function updateAdminStatus(Request $request){
        if($request->ajax()){

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            //Set a value for status
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }

            //Update Users Status
            Admin::where('id',$data['user_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status]);
        }
    }


     //Update Users Status
     public function updateUserStatus(Request $request){
        if($request->ajax()){

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            //Set a value for status
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }

            //Update Users Status
            User::where('id',$data['user_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status]);
        }
    }




    // Add & Update Users
    public function addEditUsers(Request $request,$id=null){

            if($id == ""){
                //Add Functionality
                $title = "Add Users";
                $metaTitle = "Add Users | CHIBOY ENTERPRISE";
    
                $getUserData = array();
    
                $users = new User;    
                
                $message = "Congrats, new user created successfully!";
    
            }else{

                //Update Functionality
                $title = "Update Users";
                $metaTitle = "Update Users | CHIBOY ENTERPRISE";
    
                $getUserData = User::where('id',$id)->first();
                //$getUserData = json_decode(json_encode($getUserData), true);
                
                //echo "<pre>"; print_r($getUserData); die;
                $users = User::find($id);
    
                $message = "Congrats, User updated successfully!";
    
            }
    
                if($request->isMethod('post')){
                    $data = $request->all();
    
                    // echo "<pre>"; print_r($data); die;
    
    
    
                    //Make Rules & Custom Messages For Validation
                    $rules = [
                        'role' => 'required',
                        'branch_id' => 'required',
                        'fname' => 'required',
                        'username' => 'required',
                        'phone' => 'required',
                        // 'userImage' => 'required'
                    ];
                    $customMessages = [
                        'role.required' => 'Sorry, User role field is required',
                        'branch_id.required' => 'Sorry, Branch name field is required',
                        'fname.required' => 'Sorry, Full name field is required',
                        'username.required' => 'Sorry, Username field is required',
                        'phone.required' => 'Sorry, Phone number field is required',
                        // 'userImage.required' => 'Sorry, User image is required'
                    ];
                    $this->validate($request,$rules,$customMessages); 




                    if(empty($id)){

                        
                        // Check If User already exists
                        $checkUserNameExists = User::where('name',$data['fname'])->where('username',$data['username'])->count();
                        // echo "<pre>"; print_r($checkUserNameExists); die;
                        if($checkUserNameExists > 0){
            
                            return redirect('admin/users')->with('error_message','Sorry, this user already exists');
            
                        }

                        
                        // Generate User Password
                        $pass = \Str::random(10);
                        $hasedPass = Hash::make($pass);

                        $users->password = $hasedPass;

                        $phone = preg_replace("/^0/", "+233", $data['phone']);
                        $name = $data['fname'];
                        $username = $data['username'];


                                   
                        //Send Message To User
                        $sms = new GiantSMS('YIWCiwTe', 'oFrJWwGVNf'); // API username & secret
                        $sms->send("Hello $name your user account with Chiboy Enterprise has been created successfully.  Here is your login details, Username: $username Password: $pass  Please login to change your password.  Thank you.", 
                                    "$phone", 
                                    "Chiboy Ent"
                                ); // message, recipient, sender
            

                    }
                    

                        //Insert User Image
                        if($request->hasFile("userImage")){
                            $image_temp = $request->file("userImage");
                            //Check whether image is valid or not
                            if($image_temp->isValid()){
                                //Get original image name and extension
                                // $imageName = $image_temp->getClientOriginalName();
                                $extension = $image_temp->getClientOriginalExtension();
                                
                                //Generate new image paths
                                $newImageName = rand(1111,9999).".".$extension;
                                //echo $newImageName; die;
                                //Upload large image to its corresponding folder
                                $large_image_path = "backEnd/img/uploadedImages/usersImages/".$newImageName;
    
                                //Save Images
                                Image::make($image_temp)->resize(70,70)->save($large_image_path); 
                                //Save Product main image in products table
                                $users->image = $newImageName;
    
                            }
                        }



                        $phone = preg_replace("/^0/", "+233", $data['phone']);
                        $name = $data['fname'];
                        $username = $data['username'];

        
                        $users->name = $name;
                        $users->username = $username;
                        $users->branchId = $data['branch_id'];
                        $users->phone = $data['phone'];
                        $users->role = $data['role'];
                        $users->status = 1;
                        $users->log_status = 1;
        
                        $users->save();




                    session::flash('success_message',$message);
                    return redirect('admin/users');
                
            }

            
                // Get All Branches
                $branches = Branches::where('branch_status',1)->get();

                // Get All Roles
                $roles = array('User');
    
            return view('layouts.admin.users.add_edit_users')->with(compact('title','metaTitle','getUserData','branches','roles'));
    }






    
    
    
        // Add & Update Admin Users
    public function addEditAdmin(Request $request,$id=null){

        if($id == ""){
            //Add Functionality
            $title = "Add Admin Users";
            $metaTitle = "Add Admin Users | CHIBOY ENTERPRISE";

            $getAdminData = array();

            $admins = new Admin;

            
            $message = "Congrats, new user created successfully!";

        }else{

            //Update Functionality
            $title = "Update Admin Users";
            $metaTitle = "Update Admin Users | CHIBOY ENTERPRISE";

            $getAdminData = Admin::where('id',$id)->first();
            //$getUserData = json_decode(json_encode($getAdminData), true);
            
            //echo "<pre>"; print_r($getAdminData); die;
            $admins = Admin::find($id);

            $message = "Congrats, User updated successfully!";

        }

            if($request->isMethod('post')){
                $data = $request->all();

                // echo "<pre>"; print_r($data); die;

    
                    //Make Rules & Custom Messages For Validation
                    $rules = [
                        'role' => 'required',
                        'branchid' => 'required',
                        'fname' => 'required',
                        'username' => 'required',
                        'phone' => 'required',
                        // 'userImage' => 'required'
                    ];
                    $customMessages = [
                        'role.required' => 'Sorry, User role field is required',
                        'branchid.required' => 'Sorry, Branch name field is required',
                        'fname.required' => 'Sorry, Full name field is required',
                        'username.required' => 'Sorry, Username field is required',
                        'phone.required' => 'Sorry, Phone number field is required',
                        // 'userImage.required' => 'Sorry, User image is required'
                    ];
                    $this->validate($request,$rules,$customMessages); 




                    if(empty($id)){

                        
                        // Check If User already exists
                        $checkUserNameExists = Admin::where('name',$data['fname'])->where('username',$data['username'])->count();
                        // echo "<pre>"; print_r($checkUserNameExists); die;
                        if($checkUserNameExists > 0){
            
                            return redirect('admin/admins')->with('error_message','Sorry, this user already exists');
            
                        }


                        
                        // Generate User Password
                        $pass = \Str::random(10);
                        $hasedPass = Hash::make($pass);

                        $admins->password = $hasedPass;

                        
                        $phone = preg_replace("/^0/", "+233", $data['phone']);
                        $name = $data['fname'];
                        $username = $data['username'];

                     
                        //Send Message To John K
                        $sms = new GiantSMS('YIWCiwTe', 'oFrJWwGVNf'); // API username & secret
                        $sms->send("Hello $name your user account with Chiboy Enterprise has been created successfully.  Here is your login details, Username: $username   Password: $pass  Please login to change your password.  Thank you.", 
                                        "$phone", 
                                        "Chiboy Ent"
                                    ); // message, recipient, sender
                    
        
                    }
                    


                //Insert User Image
                if($request->hasFile("userImage")){
                    $image_temp = $request->file("userImage");
                    //Check whether image is valid or not
                    if($image_temp->isValid()){
                        //Get original image name and extension
                        // $imageName = $image_temp->getClientOriginalName();
                        $extension = $image_temp->getClientOriginalExtension();
                        
                        //Generate new image paths
                        $newImageName = rand(1111,9999).".".$extension;
                        //echo $newImageName; die;
                        //Upload large image to its corresponding folder
                        $large_image_path = "backEnd/img/uploadedImages/adminImages/".$newImageName;

                        //Save Images
                        Image::make($image_temp)->resize(70,70)->save($large_image_path); 
                        //Save Product main image in products table
                        $admins->image = $newImageName;

                    }
                }
                


                $phone = preg_replace("/^0/", "+233", $data['phone']);
                $name = $data['fname'];
                $username = $data['username'];

                

                $admins->name = $name;
                $admins->username = $username;
                $admins->email = $data['email'];
                $admins->branchId = $data['branchid'];
                $admins->phone = $data['phone'];
                $admins->type = $data['role'];
                $admins->status = 1;
                $admins->log_status = 1;

                $admins->save();


                session::flash('success_message',$message);
                return redirect('admin/admins');
            
        }

        
            // Get All Branches
            $branches = Branches::where('branch_status',1)->get();

            // Get All Roles
            $roles = array('Super Administrator','Administrator');

        return view('layouts.admin.users.add_edit_admins')->with(compact('title','metaTitle','getAdminData','admins','branches','roles'));
    }


    
    
    
    
        //Delete User
        public function deleteUser($id){
            User::where('id',$id)->delete();
    
            $message = "Congrats, User deleted successfully!";
            
            session::flash('success_message',$message);
            return redirect('admin/users');
        }



        //Delete Admin User
        public function deleteAdmin($id){
            Admin::where('id',$id)->delete();
    
            $message = "Congrats, User deleted successfully!";
            
            session::flash('success_message',$message);
            return redirect('admin/admins');
        }

}
