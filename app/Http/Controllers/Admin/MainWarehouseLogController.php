<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MainWarehouseLog;
use App\Models\StockRequest;
use Session;

class MainWarehouseLogController extends Controller
{
       //View Products Added In Main Warehouse 
       public function viewTransactions($id){
        $metaTitle = "Transactions in Warehouse | CHIBOY ENTERPRISE";
        $transact  = MainWarehouseLog::with(['mainwarehouse'=>function($query){
            $query->select('id','main_product_name','product_code');
        }, 'category'=>function($query){
            $query->select('id','category_name');
        },'supplier'=>function($query){
            $query->select('id','supplier_name');
        },'admins'=>function($query){
            $query->select('id','name');
        },'brandname'=>function($query){
            $query->select('id','brand_name');
        },'unitname'=>function($query){
            $query->select('id','unit_name');
        },'warehousename'=>function($query){
            $query->select('id','name');
        }])->where('main_warehouse_id',$id )
            ->where(function($query){
                $query->where('log','=',1)
                    ->where('delog','=',1);
            })->orderBy('id','DESC')->get();

        // $transact = json_decode(json_encode($transact),true);
        // echo "<pre>"; print_r($transact); die;
 

        //Get Product Data
        $getProductName  = MainWarehouseLog::with(['mainwarehouse'=>function($query){
            $query->select('id','main_product_name','product_code');
        }])->where('main_warehouse_id',$id )
            ->where(function($query){
                $query->where('log','=',1)
                    ->where('delog','=',1);
            })->first();
        

        // $getProductName = json_decode(json_encode($getProductName),true);
        // echo "<pre>"; print_r($getProductName); die;
        return view('layouts.admin.mainwarehouse.view_product_transaction')->with(compact('transact','metaTitle','getProductName'));
    }


  


    //View Products Sold In Main Warehouse 
    public function productsSold($id){
        $metaTitle = "Transactions in Warehouse | CHIBOY ENTERPRISE";
        $transact  = MainWarehouseLog::with(['mainwarehouse'=>function($query){
            $query->select('id','main_product_name','product_code');
        }, 'category'=>function($query){
            $query->select('id','category_name');
        },'supplier'=>function($query){
            $query->select('id','supplier_name');
        },'admins'=>function($query){
            $query->select('id','name');
        },'brandname'=>function($query){
            $query->select('id','brand_name');
        },'unitname'=>function($query){
            $query->select('id','unit_name');
        },'warehousename'=>function($query){
            $query->select('id','name');
        }])->where('main_warehouse_id',$id )
            ->where(function($query){
                $query->where('log','=',3)
                    ->where('delog','=',3);
            })->orderBy('id','DESC')->get();

        // $transact = json_decode(json_encode($transact),true);
        // echo "<pre>"; print_r($transact); die;
 

        //Get Product Data
        $getProductName  = MainWarehouseLog::with(['mainwarehouse'=>function($query){
            $query->select('id','main_product_name','product_code');
        }])->where('main_warehouse_id',$id )
            ->where(function($query){
                $query->where('log','=',3)
                    ->where('delog','=',3);
            })->first();
        

        // $getProductName = json_decode(json_encode($getProductName),true);
        // echo "<pre>"; print_r($getProductName); die;

        return view('layouts.admin.mainwarehouse.view_product_sold_transaction')->with(compact('transact','metaTitle','getProductName'));
    }





    //View Products Taken In Main Warehouse
    public function productsTaken($id){

        $metaTitle = "Transactions in Warehouse | CHIBOY ENTERPRISE";
        $viewProducts  = MainWarehouseLog::with(['mainwarehouse'=>function($query){
            $query->select('id','main_product_name','product_code','warehouse');
        },'users'=>function($query){
            $query->select('id','name');
        },'stockrequest'=>function($query){
            $query->select('id','additional_qty_requested','request_status');
        },'brandname'=>function($query){
            $query->select('id','brand_name');
        },'unitname'=>function($query){
            $query->select('id','unit_name');
        },'warehousename'=>function($query){
            $query->select('id','name');
        }])->where('main_warehouse_id',$id )
            ->where(function($query){
                $query->where('log','=',2)
                      ->where('delog','=',2); //For Only Approved Goods
            })->orderBy('id','DESC')->get();

        $viewProducts = json_decode(json_encode($viewProducts),true);
        // echo "<pre>"; print_r($viewProducts); die;


        //Get Product Data
        $getProductTakenName  = MainWarehouseLog::with(['mainwarehouse'=>function($query){
            $query->select('id','main_product_name','product_code','warehouse');
        }])->where('main_warehouse_id',$id )
            ->where(function($query){
                $query->where('log','=',2)
                      ->where('delog','=',2);
            })->first();
        

        // $getProductTakenName = json_decode(json_encode($getProductTakenName),true);
        // echo "<pre>"; print_r($getProductTakenName); die;
        return view('layouts.admin.mainwarehouse.view_product_taken_transaction')->with(compact('metaTitle','viewProducts','getProductTakenName'));
    }





    //Delete Transaction Logs
    public function deleteLog($id){
        MainWarehouseLog::where('id',$id)->delete();

        $message = "Congrats, transaction log in Main Warehouse deleted successfully!";
        session::flash('success_message',$message);
        return redirect()->back();
    }
}
