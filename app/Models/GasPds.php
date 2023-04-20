<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasPds extends Model
{
    // use HasFactory;

    //Get Category Name Using Eloquent Relation
    public function category(){
        return $this->belongsTo('App\Models\Categories','category_id');
    }


    public function branch(){
        return $this->belongsTo("App\Models\Branches","branch_id");
    }


    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    // Get Products Details
    public function products(){
        return $this->belongsTo("App\Models\Products","product_id");
    }



    public static function getgaspds(){

        // Get Sections with Categories and Sub-Categories
        $getgaspds = Categories::with('mainproducts')->get();
        $getgaspds = json_decode(json_encode($getgaspds),true);

        // echo "<pre>"; print_r($getgaspds); die;

        return $getgaspds;
    }


}
