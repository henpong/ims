<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Use Guards
    protected $guard = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'username','email', 'password', 'branchId', 'role', 'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    //Get Branch Detials From Branch Table Using Eloquent Relationship
    public function userbranch(){
        return $this->belongsTo("App\Models\Branches","branchId")->select('id','branch_name');
    }


    
    // Get User Details When Logged In
    public static function details(){
        // Get Branch Id
        $userId = session('user')['userid'];
        $branchid = session('user')['branchid'];
        
        
        $details = User::select('id','name','image','branchId')->with('userbranch')->where('id',$userId)->where('branchId',$branchid)->where('status',1)->first();
        

        return $details;
    }



  
}
