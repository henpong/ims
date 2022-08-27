<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Categories extends Model
{
    // use HasFactory;

    //Get Sub Categories using Relations
    public function subcategories(){
        return $this->hasMany('App\Models\Categories','section_id')->select('id','category_name');
    }


    //Get Section Name Using Relations
    public function section_name(){
        return $this->belongsTo('App\Models\Sections','section_id')->select('id','name');
    }


    //Get Parent Name Using Relations
    public function parentname(){
        return $this->belongsTo('App\Models\Categories', 'parent_id')->where('category_status',1);
    }


    public function products(){
        return $this->hasMany("App\Models\Products","category_id"); 
    }


   

    //Get Categories with Sub Categories Using Eloquent Relation
    public function mainproducts(){
        return $this->hasMany('App\Models\Products','category_id')->with('getgas');
    }



    public static function getcategories(){
        //Get Categories Data
        $getCategories = Categories::get();
        return $getCategories;
    }

}
