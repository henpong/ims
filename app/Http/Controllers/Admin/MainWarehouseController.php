<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MainWarehouse;
use App\Models\MainWarehouseLog;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Suppliers;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Warehouse;
use App\Models\Admin;
use Session;



class MainWarehouseController extends Controller
{
       //View Data In Main Warehouse
       public function mainwarehouse(){
        Session::put('page','mainwarehouse');
        $metaTitle = "Warehouse | CHIBOY ENTERPRISE";
        $mainwarehouses = MainWarehouse::with(['categoryname','suppliername','brandname','unitname','warehousename'])->where('status',1)->orderBy('id','DESC')->get();

        // $mainwarehouses = json_decode(json_encode($mainwarehouses));
        // echo "<pre>"; print_r($mainwarehouses); die;

        return view('layouts.admin.mainwarehouse.mainwarehouse')->with(compact('mainwarehouses','metaTitle'));
    }


    //View Data In New/House Warehouse
    public function newwarehouse(){
        Session::put('page','newwarehouse');
        $metaTitle = "New Warehouse | CHIBOY ENTERPRISE";
        $newwarehouses = MainWarehouse::with(['categoryname','suppliername'])->where('warehouse','New Warehouse')->orderBy('id','DESC')->get();

        // $newwarehouses = json_decode(json_encode($newwarehouses));
        // echo "<pre>"; print_r($newwarehouses); die;

        return view('layouts.admin.mainwarehouse.newwarehouse')->with(compact('newwarehouses','metaTitle'));
    }


    
    //Update Main Warehouse Status
    public function updateMainWarehouseStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            //echo "<pre>"; print_r($data); die;
            
            //Set Value For Status
            if($data['mainwarehouse_status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }

            //Update Main Warehouse Status
            MainWarehouse::where('id',$data['mainwarehouse_id'])->update(['status'=>$status]);
            return response()->json(['mainwarehouse_status'=>$status,'mainwarehouse_id'=>$data['mainwarehouse_id']]);
        }
    }
    
    

    //Insert & Update Main Warehouse
    public function addEditMainWarehouse(Request $request,$id=null){
        if($id == ""){
            //Add Functionality
            $title = " Add Products In Warehouse";
            $metaTitle = "Add Warehouse Product | CHIBOY ENTERPRISE";
            

            $getMainWarehouseData = array();
            $mainwarehouses = new MainWarehouse;
            $message = "Congrats, new product added in Warehouse successfully!";


            $prodCode = "100001";
            $wareData = MainWarehouse::get();
            // $wareData = json_decode(json_encode($wareData));
            // echo "<pre>"; print_r($wareData); die;
            if($wareData->isEmpty()){

                $code = "CHBIMS-".$prodCode;
               
            }else{

                $newprodCode = MainWarehouse::latest()->value('product_code');
                $prodCode = explode('-',$newprodCode,2);
                // echo "<pre>"; print_r($prodCode); die;
    
                $code = $prodCode[0]."-". ($prodCode[1] + 1);
                // echo "<pre>"; print_r($code); die;

            }
           

        }else{

            //Update Functionality
            $title = "Update Products In Warehouse";
            $metaTitle = "Update Warehouse Product | CHIBOY ENTERPRISE";

            $getMainWarehouseData = MainWarehouse::where('id',$id)->first();
            $getMainWarehouseData = json_decode(json_encode($getMainWarehouseData),true);
            // echo "<pre>"; print_r($getMainWarehouseData); die;

            $mainwarehouses = MainWarehouse::find($id);
            // echo "<pre>"; print_r($mainwarehouses); die;
            $message = "Congrats, product in Warehouse updated successfully!";

            $code = $getMainWarehouseData['product_code'];
            //echo "<pre>"; print_r($code); die;
        }

        if($request->isMethod('post')){
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;
            

            if($id == ""){
                // Check If User already exists
                $checkUserNameExists = MainWarehouse::where('main_product_name',$data['mainwarehouseProductName'])->count();
                //echo "<pre>"; print_r($checkUserNameExists); die;

                if($checkUserNameExists > 0){

                    return redirect('admin/mainwarehouse')->with('error_message','Sorry, this product already exists');

                }else{



                     //Make Rules & Custom Messages For Validation
                    $rules = [
                        'mainwarehouseProductName' => 'required',
                        'category_id' => 'required',
                        'supplier_id' => 'required',
                        'lowstockPoint' => 'required',
                        'qtyctns' => 'required',
                        'dateAdded' => 'required',
                        'warehouse' => 'required',
                        'brand_id' => 'required',
                        'unit_id' => 'required',
                        'prodcost' => 'required'
                    ];
                    $customMessages = [
                        'mainwarehouseProductName.required' => 'Sorry,  Product name field is required',
                        'category_id.required' => 'Sorry,  category field is required',
                        'supplier_id.required' => 'Sorry,  supplier field is required',
                        'lowstockPoint.required' => 'Sorry, low stock point field is required',
                        'qtyctns.required' => 'Sorry, Qty in carton field is required',
                        'dateAdded.required' => 'Sorry, Date added field is required',
                        'warehouse.required' => 'Sorry, warehouse field is required',
                        'brand_id.required' => 'Sorry, brand name field is required',
                        'unit_id.required' => 'Sorry, unit_id field is required',
                        'prodcost.required' => 'Sorry, product cost field is required'

                    ];
                    $this->validate($request,$rules,$customMessages);


                    
                    $mainwarehouses->category_id = $data['category_id'];
                    $mainwarehouses->supplier_id = $data['supplier_id'];
                    $mainwarehouses->main_product_name = $data['mainwarehouseProductName'];
                    $mainwarehouses->product_code = $code;
                    $mainwarehouses->newprod_qtyctn = 0;
                    $mainwarehouses->addprod_qtypcs = 0;
                    $mainwarehouses->total_prodqtypcs = 0;
                    $mainwarehouses->lowstock_point = $data['lowstockPoint'];
                    $mainwarehouses->qtybox = $data['qtyctns'];
                    $mainwarehouses->warehouse = $data['warehouse'];
                    $mainwarehouses->brand_id = $data['brand_id'];
                    $mainwarehouses->unit_id = $data['unit_id'];
                    $mainwarehouses->prodcost = $data['prodcost'];
                    $mainwarehouses->total_prodcost = 0;
                    $mainwarehouses->newprod_date = date("Y-m-d H:i:s",strtotime($data['dateAdded']));
                    $mainwarehouses->admins_id = Auth::guard('admin')->user()->id;
                    $mainwarehouses->status = 1;

                    $mainwarehouses->save();

                    Session::flash('success_message',$message);
                    return redirect('admin/mainwarehouse');
                }
            }else{



                //Update Mainwarehouse
                MainWarehouse::where('id',$id)->update(['category_id'=>$data['category_id'], 'supplier_id' => $data['supplier_id'], 'brand_id' => $data['brand_id'],
                'main_product_name' => $data['mainwarehouseProductName'], 'lowstock_point' => $data['lowstockPoint'], 'qtybox' => $data['qtyctns'], 
                'warehouse' => $data['warehouse'], 'admins_id' => $data['adminId'], 'prodcost' => $data['prodcost'] ]);

                // $mainwarehouses->category_id = $data['category_id'];
                // $mainwarehouses->supplier_id = $data['supplier_id'];
                // $mainwarehouses->main_product_name = $data['mainwarehouseProductName'];
                // $mainwarehouses->lowstock_point = $data['lowstockPoint'];
                // $mainwarehouses->qtybox = $data['qtyctns'];
                // $mainwarehouses->warehouse = $data['warehouse'];
                // $mainwarehouses->admins_id = $data['adminId'];
                // $mainwarehouses->brand_id = $data['brand_id'];
                // $mainwarehouses->unit_id = $data['unit_id'];
                

                // $mainwarehouses->save();

                Session::flash('success_message',$message);
                return redirect('admin/mainwarehouse');
            }

            

        
        }

        //Get Categories and Suppliers Data
        $getCategories = Categories::get();
        $getSupplier = Suppliers::get();
        $getBrands = Brand::get();
        $getUnit = Unit::get();
        $getWarehouse = Warehouse::get();

        return view('layouts.admin.mainwarehouse.add_edit_mainwarehouse')->with(compact('title','metaTitle','getCategories', 'getBrands', 'getUnit', 'getSupplier', 'getWarehouse','getMainWarehouseData'));
    }


    

    //Add New Order In Main Warehouse
    public function addNewOrder(Request $request, $id=null){
        if($id == ""){

            $title = "Add New Order";
            $metaTitle = "Add New Order | CHIBOY ENTERPRISE";

            $getProductData = array();
            // $neworder = new MainWarehouse;

        }else{
            $title = "Update Order";
            $metaTitle = "Update Order | CHIBOY ENTERPRISE";

            $getProductData = MainWarehouse::where('id',$id)->first();
             //echo "<pre>"; print_r($getProductData); die;
        }

        if($request->isMethod('post')){
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            //Get New Entries From User
            $newQtyCtns = $data['numberQtyCtns'];
            if($newQtyCtns == ""){
                $newQtyCtns = 0;
            }else{
                $newQtyCtns = $data['numberQtyCtns'];
            }
            $newQtyOrdered = $data['qtyOrdered'];
            if($newQtyOrdered == ""){
                $newQtyOrdered = 0;
            }else{
                $newQtyOrdered = $data['qtyOrdered'];
            }
            $additionalQty = $data['additionalQty'];
            if($additionalQty == ""){
                $additionalQty = 0;
            }else{
                $additionalQty = $data['additionalQty'];
            }

            // echo "<pre>"; print_r($additionalQty); die;

            $date = date("Y-m-d H:i:s");
            //End of Entries From User

            //Get Data From Main Warehouse Table
            $getOldData = MainWarehouse::where('id',$id)->first();
            $getOldData = json_decode(json_encode($getOldData),true);
            // echo "<pre>"; print_r($getOldData); die;

            $oldQtyCtns = $getOldData['newprod_qtyctn'];
            $oldAdditionalQty = $getOldData['addprod_qtypcs'];
            $oldTotalQty = $getOldData['total_prodqtypcs'];
            $qtyBox = $getOldData['qtybox'];
            $prodcost = $getOldData['prodcost'];
            $action = "has added";
            //End of Data From Main Warehouse

            
            // $userId = MainWarehouse::with('user')->where('id',$id)->first();
            // $userId = json_decode(json_encode($userId));
            // echo "<pre>"; print_r($userId); die;


            //Set Condition
            if($newQtyCtns == ""){

                $message = "Congrats, new order has been entered successfully!";


                //Update Main Warehouse Table
                MainWarehouse::where('id',$getOldData['id'])->update(['newprod_qtyctn'=>($newQtyOrdered + $oldQtyCtns),'addprod_qtypcs'=>($oldAdditionalQty + $additionalQty),
                'total_prodqtypcs'=>(($newQtyOrdered * $qtyBox) + ($oldTotalQty + $additionalQty)),'newprod_date'=>$date]);

                
                //Insert record Into Main WarehouseLog Table
                $mainWarehouseLog = new MainWarehouseLog;

                $mainWarehouseLog->main_warehouse_id = $getOldData['id'];
                $mainWarehouseLog->admins_id = Auth::guard('admin')->user()->id;
                $mainWarehouseLog->action = $action;
                $mainWarehouseLog->qty_addctn = $newQtyOrdered;
                $mainWarehouseLog->additional_qty = $additionalQty;
                $mainWarehouseLog->total_qtypcs = (($newQtyOrdered * $qtyBox) + ($oldTotalQty + $additionalQty));
                $mainWarehouseLog->prodcost = $prodcost;
                $mainWarehouseLog->total_prodcost = 0;
                $mainWarehouseLog->date_added = $date;
                $mainWarehouseLog->qty_takenctn = 0;
                $mainWarehouseLog->qty_takenpcs = 0;
                $mainWarehouseLog->date_taken = $date;
                $mainWarehouseLog->log = 1;
                $mainWarehouseLog->delog = 1;
                $mainWarehouseLog->category_id = $getOldData['category_id'];
                $mainWarehouseLog->supplier_id = $getOldData['supplier_id'];
                $mainWarehouseLog->unit_id = $getOldData['unit_id'];
                $mainWarehouseLog->brand_id = $getOldData['brand_id'];
                $mainWarehouseLog->warehouse = $getOldData['warehouse'];
                $mainWarehouseLog->stockrequestid = 0;

                $mainWarehouseLog->save();


                Session::flash('success_message',$message);
                return redirect('admin/mainwarehouse');
            }else{

                $message = "Congrats, new order has been entered successfully!";


                //Update Main Warehouse Table
                MainWarehouse::where('id',$id)->update(['newprod_qtyctn'=>($newQtyOrdered + $oldQtyCtns), 'addprod_qtypcs'=>($oldAdditionalQty + $additionalQty),'total_prodqtypcs'=>(($newQtyOrdered * $newQtyCtns) + ($oldTotalQty + $additionalQty)), 'qtybox'=>$newQtyCtns, 'newprod_date'=>$date]);


                 //Insert record Into Main WarehouseLog Table
                 $mainWarehouseLog = new MainWarehouseLog;

                 $mainWarehouseLog->main_warehouse_id = $getOldData['id'];
                 $mainWarehouseLog->admins_id = Auth::guard('admin')->user()->id;
                 $mainWarehouseLog->action = $action;
                 $mainWarehouseLog->qty_addctn = $newQtyOrdered;
                 $mainWarehouseLog->additional_qty = $additionalQty;
                 $mainWarehouseLog->total_qtypcs = (($newQtyOrdered * $newQtyCtns) + ($oldTotalQty + $additionalQty));
                 $mainWarehouseLog->prodcost = $prodcost;
                 $mainWarehouseLog->total_prodcost = 0;
                 $mainWarehouseLog->date_added = $date;
                 $mainWarehouseLog->qty_takenctn = 0;
                 $mainWarehouseLog->qty_takenpcs = 0;
                 $mainWarehouseLog->date_taken = $date;
                 $mainWarehouseLog->log = 1;
                 $mainWarehouseLog->delog = 1;
                 $mainWarehouseLog->category_id = $getOldData['category_id'];
                 $mainWarehouseLog->supplier_id = $getOldData['supplier_id'];
                 $mainWarehouseLog->unit_id = $getOldData['unit_id'];
                 $mainWarehouseLog->brand_id = $getOldData['brand_id'];
                 $mainWarehouseLog->warehouse = $getOldData['warehouse'];
                 $mainWarehouseLog->stockrequestid = 1;
 
                 $mainWarehouseLog->save();


                Session::flash('success_message',$message);
                return redirect('admin/mainwarehouse');
            }
            
        }
        

        return view('layouts.admin.mainwarehouse.new_order')->with(compact('title','metaTitle','getProductData'));
    }




    //Delete Product In Main Warehouse
    public function deleteMainWareProduct($id){
        $product = Products::with('warehouse')->where('main_warehouse_id',$id)->first();
        $product = json_decode(json_encode($product));

        $prodQty = $product->product_qty;

        // echo "<pre>"; print_r($prodQty); die;

        if($prodQty > 0){

            Session::flash("error_message","Sorry, this product cannot be deleted because there is some quantity left in the shop. Product can be deleted after those quantities are sold out.");
            return redirect()->back();

        }else{

            Products::where('main_warehouse_id',$id)->delete();
            MainWarehouse::where('id',$id)->delete();

            
            Session::flash('success_message','Congrats, product deleted successfully!');
            return redirect('admin/mainwarehouse');

        }

    }



    // Low Stock Products In Warehouse
    public function lowstockProducts(){
        
        $metaTitle = "Low Stocks In Warehouse | CHIBOY ENTERPRISE";

        $lowproducts = MainWarehouse::whereColumn('total_prodqtypcs','<=','lowstock_point')->where('status',1)->get();
        $lowproducts = json_decode(json_encode($lowproducts));
        // echo "<pre>"; print_r($lowproducts); die;

        return view('layouts.admin.mainwarehouse.lowstocks')->with(compact('metaTitle','lowproducts'));
    }

}
