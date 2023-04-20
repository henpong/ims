<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\GasPds;
use App\Models\Gas_Pds_Log;
use Illuminate\Support\Facades\DB;


class GasPdsLogController extends Controller
{
    // View Gas Opened In All Branches
    public function gasOpened($id){
        // echo "<pre>"; print_r($id); die;
        $metaTitle = "Gas Opened Transaction | JOHN K. SERVICES";

        $viewTransaction = DB::table('gas__pds__logs')
                    ->join('gas_pds', 'gas__pds__logs.new_product_id', '=', 'gas_pds.new_product_id')
                    ->join('branches', 'gas__pds__logs.branch_id', '=', 'branches.id')
                    ->join('users', 'gas__pds__logs.user_id', '=', 'users.id')
                    ->where('gas__pds__logs.new_product_id', $id)
                    ->select('gas__pds__logs.id','branches.branch_name','users.name','gas__pds__logs.qty_open','gas__pds__logs.weight_pds','gas__pds__logs.date_open')
                    ->orderBy('gas__pds__logs.id','DESC')
                    ->get();

        $viewTransaction = json_decode(json_encode($viewTransaction),true);
        // echo "<pre>"; print_r($viewTransaction); die;


        //Get Product Name And Code 
        $getGasPdsOpenedName = DB::table('gas__pds__logs')
                    ->join('gas_pds', 'gas__pds__logs.new_product_id', '=', 'gas_pds.new_product_id')
                    ->where('gas__pds__logs.new_product_id', $id)
                    ->select('gas__pds__logs.id','gas_pds.product_code','gas_pds.gas_pds_name','gas__pds__logs.new_product_id')
                    ->first();

        $getGasPdsOpenedName = json_decode(json_encode($getGasPdsOpenedName),true);
        // echo "<pre>"; print_r($getGasPdsOpenedName); die;

        return view('layouts.admin.stocks.view_gas_sold_transaction')->with(compact('metaTitle','getGasPdsOpenedName','viewTransaction'));
    }

}
