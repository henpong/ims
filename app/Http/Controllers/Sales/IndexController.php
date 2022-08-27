<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //Redirect to Index Page
    public function index(){

        $metaTitle = "IMS | CHIBOY ENTERPRISE";
        return view('layouts.sales.index')->with(compact('metaTitle'));
    }
}
