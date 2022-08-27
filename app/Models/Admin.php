<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;


class Admin extends Authenticatable
{
    //Admin Guard
    use Notifiable;

    protected $guard = 'admin';
    protected $fillable = [
        'name', 'username', 'email', 'password', 'phone', 'image', 'type', 'status', 'created_at', 'updated_at',
        
    ];

    protected $hidden = [
        'password','remember_token',
    ]; 


    public function admins(){
        return $this->belongsTo('App\Models\TemporalCredit','id');
    }


    public function  branch(){
        return $this->belongsTo('App\Models\Branches','branchId');
    }


      // Get Admin Details When Logged In
      public static function admindetails(){
        // Get Branch Id
        $admin = Auth::guard('admin')->user();
        $admin = json_decode(json_encode($admin));
        // echo "<pre>"; print_r($user); die;
        $branchid = $admin->branchId;
        // dd($branchid); die;
        
        $admindetails = Admin::select('id','name','branchId')->with('branch')->where('branchId',$branchid)->where('status',1)->first();
        // echo "<pre>"; print_r($admindetails); die;
        

        return $admindetails;
    }

}
