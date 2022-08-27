<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbooks extends Model
{
    // use HasFactory;
    public function branch(){
        return $this->belongsTo("App\Models\Branches","branch_id");
    }


    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
