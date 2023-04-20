<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Products;
use App\Models\MainWarehouse;
use App\Models\Branches;
use App\Models\Stocks;
use App\Models\StockRequest;



class ProductsController extends Controller
{
       //View Data In Products Table
       public function products(){

        Session::put('page','products');
         $metaTitle = "Products | CHIBOY ENTERPRISE";

        $products = Products::with(['category'=>function($query){
            $query->select('id','category_name');
        },'branch'=>function($query){
            $query->select('id','branch_name');
        },'warehousename'=>function($query){
            $query->select('id','name');
        }])->orderBy('id','DESC')->get();

        // $products = json_decode(json_encode($products));
        // echo "<pre>"; print_r($products); die;
        
        return view('layouts.admin.products.products')->with(compact('metaTitle','products'));
    }



    //Update Product Status
    public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();

            //Set value for status
            if($data['product_status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }

            //Update Product Table
            Products::where('id',$data['product_id'])->update(['status'=>$status]);
            return response()->json(['product_status'=>$status,'product_id'=>$data['product_id']]);
        }
    }




    //Add Products In Various Barnches
    public function addProductsInBranches(Request $request){
        
        if($request->isMethod('post')){

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;


             //Add Functionality
             $title = "Add Products In Various Branches";
 
            
             //Make Rules & Custom Messages For Validation
             $rules = [
                'product_id' => 'required',
                'wholeQTY' => 'required',
                'branch_id' => 'required',
                'wholePrice' => 'required',
                'unitPrice' => 'required',
                'lowStock' => 'required'
            ];
            $customMessages = [
                'product_id.required' => 'Sorry,  product name field is required',
                'wholeQTY.required' => 'Sorry,  wholesale qty field is required',
                'branch_id.required' => 'Sorry, branch name field is required',
                'wholePrice.required' => 'Sorry, wholesale price field is required',
                'unitPrice.required' => 'Sorry, unit price field is required',
                'lowStock.required' => 'Sorry, lowstock point field is required'

            ];
            $this->validate($request,$rules,$customMessages);



            $productId = $data['product_id'];
            $branchId = $data['branch_id'];
            // echo "<pre>"; print_r($branchId); die;
            $wholesaleQTY = $data['wholeQTY'];
            $wholesalePx = $data['wholePrice'];
            $unitPx = $data['unitPrice'];
            $lowStockPoint = $data['lowStock'];


                // Check If Product already exists
                $checkProductNameExists = Products::where('main_warehouse_id',$productId)->where('branch_id',$branchId)->count();
                // echo "<pre>"; print_r($checkProductNameExists); die;

                if($checkProductNameExists > 0){

                    return redirect('admin/products')->with('error_message','Sorry, this product already exists in the selected branch.');

                }else{

                     //Insert Details Into Products Table
                    $productsTable = new Products;
 
                    //Get Product Details From Main Warehouse
                    $productDetails = MainWarehouse::where('id',$productId)->first();
                    // $productDetails = json_decode(json_encode($productDetails));
                    // echo "<pre>"; print_r($productDetails); die;


                    
                
                    $productsTable->main_warehouse_id = $productId;
                    $productsTable->category_id = $productDetails['category_id'];
                    $productsTable->branch_id = $branchId;
                    $productsTable->product_name = $productDetails['main_product_name'];
                    $productsTable->product_code = $productDetails['product_code'];
                    $productsTable->wholesale_qty = $wholesaleQTY;
                    $productsTable->product_wholesale_price = $wholesalePx;
                    $productsTable->product_price = $unitPx;
                    $productsTable->product_qty = 0;
                    $productsTable->lowstock_point = $lowStockPoint;
                    $productsTable->status = 1;

                    $productsTable->save();

                    $message = "Congrats, product added to branch successfully!";
                    session::flash('success_message',$message);
                    return redirect('admin/products');
                }


          

        }

    }



    // Update Products In Various  Branches
    public function UpdateProductsInBranches (Request $request, $id){
       

        if($request->isMethod('post')){
            
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;


             //Update Functionality
             $title = "Update Products In Various Branches";


             //Make Rules & Custom Messages For Validation
             $rules = [
                'product_id' => 'required',
                'wholeQTY' => 'required',
                'branch_id' => 'required',
                'wholePrice' => 'required',
                'unitPrice' => 'required',
                'lowStock' => 'required'
            ];
            $customMessages = [
                'product_id.required' => 'Sorry,  product name field is required',
                'wholeQTY.required' => 'Sorry,  wholesale qty field is required',
                'branch_id.required' => 'Sorry, branch name field is required',
                'wholePrice.required' => 'Sorry, wholesale price field is required',
                'unitPrice.required' => 'Sorry, unit price field is required',
                'lowStock.required' => 'Sorry, lowstock point field is required'

            ];
            $this->validate($request,$rules,$customMessages);



           

            //Get Products Data From Table
            $getProductsData = Products::with(['category'=>function($query){
                $query->select('id','category_name');
            },'branch'=>function($query){
                $query->select('id','branch_name');
            },'warehousename'=>function($query){
                $query->select('id','name');
            }])->where('id',$id)->first();
            // $getProductsData = json_decode(json_encode($getProductsData));
            // echo "<pre>"; print_r($getProductsData); die;


            //Update Details In Products Table
            $productsTable = Products::find($id);
            

            $productId = $data['product_id'];
            $branchId = $data['branch_id'];
            // echo "<pre>"; print_r($branchId); die;
            $wholesaleQTY = $data['wholeQTY'];
            $wholesalePx = $data['wholePrice'];
            $unitPx = $data['unitPrice'];
            $lowStockPoint = $data['lowStock'];


            $productsTable = new Products;


            //Get Product Details From Main Warehouse
            $productDetails = MainWarehouse::where('id',$productId)->first();
            //$productDetails = json_decode(json_encode($productDetails));
            //echo "<pre>"; print_r($productDetails); die;


            
            $productsTable->main_warehouse_id = $productId;
            $productsTable->category_id = $productDetails['category_id'];
            $productsTable->branch_id = $branchId;
            $productsTable->product_name = $productDetails['main_product_name'];
            $productsTable->product_code = $productDetails['product_code'];
            $productsTable->wholesale_qty = $wholesaleQTY;
            $productsTable->product_wholesale_price = $wholesalePx;
            $productsTable->product_price = $unitPx;
            $productsTable->lowstock_point = $lowStockPoint;

            $productsTable->save();

            $message = "Congrats, product updated at branch successfully!";
            session::flash('success_message',$message);
            return redirect('admin/products');

            

          

        }


        $mainwarehouseProduct = MainWarehouse::get();
        $branches = Branches::where('branch_name','!=','HEAD OFFICE')->get();
        return view('layouts.admin.products.products')->with(compact('mainwarehouseProduct','branches','title','metaTitle','getProductsData'));
    }








      //Add Products In Various Barnches
      public function addEditProductsInBranches(Request $request,$id=null){
        if($id == ""){
            //Add Functionality
            $title = "Add Products In Various Branches";
            $metaTitle = "Add Products | CHIBOY ENTERPRISE";

            //Insert Details Into Products Table
            $productsTable = new Products;

            $getProductsData = array();


        }else{

            //Update Functionality
            $title = "Update Products In Various Branches";
            $metaTitle = "Update Products | CHIBOY ENTERPRISE";

            //Get Products Data From Table
            $getProductsData = Products::with(['category'=>function($query){
                $query->select('id','category_name');
            },'branch'=>function($query){
                $query->select('id','branch_name');
            },'warehouse'=>function($query){
                $query->select('id','warehouse');
            }])->where('id',$id)->first();
            // $getProductsData = json_decode(json_encode($getProductsData));
            // echo "<pre>"; print_r($getProductsData); die;


            //Update Details In Products Table
            $productsTable = Products::find($id);

        }


        if($request->isMethod('post')){
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;


             //Make Rules & Custom Messages For Validation
             $rules = [
                'product_id' => 'required',
                'wholeQTY' => 'required',
                'branch_id' => 'required',
                'wholePrice' => 'required',
                'unitPrice' => 'required',
                'lowStock' => 'required'
            ];
            $customMessages = [
                'product_id.required' => 'Sorry,  product name field is required',
                'wholeQTY.required' => 'Sorry,  wholesale qty field is required',
                'branch_id.required' => 'Sorry, branch name field is required',
                'wholePrice.required' => 'Sorry, wholesale price field is required',
                'unitPrice.required' => 'Sorry, unit price field is required',
                'lowStock.required' => 'Sorry, lowstock point field is required'

            ];
            $this->validate($request,$rules,$customMessages);



            $productId = $data['product_id'];
            $branchId = $data['branch_id'];
            // echo "<pre>"; print_r($branchId); die;
            $wholesaleQTY = $data['wholeQTY'];
            $wholesalePx = $data['wholePrice'];
            $unitPx = $data['unitPrice'];
            $lowStockPoint = $data['lowStock'];


            if($id == ""){

                // Check If Product already exists
                $checkProductNameExists = Products::where('main_warehouse_id',$productId)->where('branch_id',$branchId)->count();
                // echo "<pre>"; print_r($checkProductNameExists); die;

                if($checkProductNameExists > 0){

                    return redirect('admin/products')->with('error_message','Sorry, this product already exists in the selected branch.');

                }else{

                    
                    //Get Product Details From Main Warehouse
                    $productDetails = MainWarehouse::where('id',$productId)->first();
                    // $productDetails = json_decode(json_encode($productDetails));
                    // echo "<pre>"; print_r($productDetails); die;


                    
                
                    $productsTable->main_warehouse_id = $productId;
                    $productsTable->category_id = $productDetails['category_id'];
                    $productsTable->branch_id = $branchId;
                    $productsTable->product_name = $productDetails['main_product_name'];
                    $productsTable->product_code = $productDetails['product_code'];
                    $productsTable->wholesale_qty = $wholesaleQTY;
                    $productsTable->product_wholesale_price = $wholesalePx;
                    $productsTable->product_price = $unitPx;
                    $productsTable->product_qty = 0;
                    $productsTable->lowstock_point = $lowStockPoint;
                    $productsTable->ware_id = $productDetails['warehouse'];
                    $productsTable->status = 1;

                    $productsTable->save();

                    $message = "Congrats, product added to branch successfully!";
                    session::flash('success_message',$message);
                    return redirect('admin/products');
                }

            }else{

                  
                    //Get Product Details From Main Warehouse
                    $productDetails = MainWarehouse::where('id',$productId)->first();
                    //$productDetails = json_decode(json_encode($productDetails));
                    //echo "<pre>"; print_r($productDetails); die;


                    
                    $productsTable->main_warehouse_id = $productId;
                    $productsTable->category_id = $productDetails['category_id'];
                    $productsTable->branch_id = $branchId;
                    $productsTable->product_name = $productDetails['main_product_name'];
                    $productsTable->product_code = $productDetails['product_code'];
                    $productsTable->wholesale_qty = $wholesaleQTY;
                    $productsTable->product_wholesale_price = $wholesalePx;
                    $productsTable->product_price = $unitPx;
                    $productsTable->lowstock_point = $lowStockPoint;
                    $productsTable->ware_id = $productDetails['warehouse'];

                    $productsTable->save();

                    $message = "Congrats, product updated at branch successfully!";
                    session::flash('success_message',$message);
                    return redirect('admin/products');

            }

          

        }


        $mainwarehouseProduct = MainWarehouse::get();
        $branches = Branches::where('branch_name','!=','HEAD OFFICE')->get();
        return view('layouts.admin.products.add_edit_products_in_branches')->with(compact('mainwarehouseProduct','branches','title','metaTitle','getProductsData'));
    }


    

    //Delete Products Given to Various Branches
    public function deleteProduct(Request $request,$id){

        $branchid = Products::where('id',$id)->first()->branch_id;
        $branchid = json_decode(json_encode($branchid));
        // echo "<pre>"; print_r($branchid); die;

       

        Products::where('id',$id)->delete();

        Stocks::where('product_id',$id)->where('branch_id',$branchid)->delete();
        StockRequest::where('product_id',$id)->where('branch_id',$branchid)->delete();

        // Products::with('warehouse')->where('id',$id)->get();
        // Products::with('warehouse')->where('id',$id)->delete();

        // echo "<pre>"; print_r($products); die;

        $message = "Congrats, product has been deleted successfully!";
        session::flash('success_message',$message);
        return redirect('admin/products');
    }



    
    // Gas Pounds
    public function gaspds(Request $request,$id = null){
        $metaTitle = "Gas Pounds | CHIBOY ENTERPRISE";

        if($request->isMethod("post")){

            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            //Update Product Table
            Products::where('id',$data['pdsid'])->update(['product_wholesale_price'=>$data['wprice'],'product_price'=>$data['uprice'],'status'=>1]);
            // Update Gas Status
            GasPds::where('new_product_id',$data['pdsid'])->update(['status'=>1]);
            
            Session::flash("success_message","Congrats, price set to gas pounds at branch successfully!");

            return redirect('admin/gas_pds_shops');
        }
 

        // Get All Gas Pounds From The Products Table
        $getgaspds = Products::with('branch')->where('main_warehouse_id',0)->get();
        $gaspds = json_decode(json_encode($getgaspds),true);

        // echo "<pre>"; print_r($gaspds); die;
       
        return view('layouts.admin.stocks.gaspds')->with(compact('metaTitle','getgaspds'));
    }




}
