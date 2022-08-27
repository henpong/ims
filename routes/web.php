<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\BigCustomersController;
use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CreditorsController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\MainWarehouseController;
use App\Http\Controllers\Admin\MainWarehouseLogController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\SectionsController;
use App\Http\Controllers\Admin\StockRequestController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\TemporalCreditController;
use App\Http\Controllers\Admin\UnitsController;
// use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Sales\IndexController;
use App\Http\Controllers\Sales\UsersController;
use App\Http\Controllers\Sales\CreditController;
// use App\Http\Controllers\Sales\CustomersController;
// use App\Http\Controllers\Sales\PaymentsController;
// use App\Http\Controllers\Sales\ReceiptController;
// use App\Http\Controllers\Sales\ReportsController;
use App\Http\Controllers\Sales\SalesController;
use App\Http\Controllers\Sales\StocksController;
// use App\Http\Controllers\Sales\TemporalCreditController;





//Routes For Admin
Route::prefix('/admin')->namespace('Admin')->group(function(){
    
    //Direct to Login Page
    Route::match(['get','post'],'/',[AdminController::class,'login']);

    //Set Middleware to prevent unauthorized login
    Route::group(['middleware'=>['admin']], function(){
        //Route For Dashboard
        Route::get('dashboard',[AdminController::class,'dashboard']);
        Route::get('settings',[AdminController::class,'settings']);

        //Check & Post Admin Current Password
        Route::post('check_current_pswd',[AdminController::class,'chkCurrentPass']);
        Route::post('update_password',[AdminController::class,'updatePass']);


        //Update Admin Details
        Route::match(['get','post'],'update_admin_details',[AdminController::class,'updateAdminDetails']);


        //Fetch Data From Branch Table
        Route::get('branches',[BranchesController::class,'branches']);
        //Update Branch Status
        Route::post('update_branch_status',[BranchesController::class,'updateBranchStatus']);
        //Insert & update Branch
        Route::match(['get','post'],'add_edit_branches/{id?}',[BranchesController::class,'addEditBranches']);
        //Delete Branch
        Route::get('delete_branch/{id}',[BranchesController::class,'deleteBranch']);



        //Fetch Data From Users Table
        Route::get('users',[App\Http\Controllers\Admin\UsersController::class,'users']);
        //Update Users Status
        Route::post('update_users_status',[App\Http\Controllers\Admin\UsersController::class,'updateUserStatus']);
        //Insert & Update Users
        Route::match(['get','post'],'add_edit_users/{id?}',[App\Http\Controllers\Admin\UsersController::class,'addEditUsers']);
        //Insert Users
        Route::match(['get','post'],'add_users',[App\Http\Controllers\Admin\UsersController::class,'addUsers']);
        //Update Users
        Route::match(['get','post'],'update_users/{id}',[App\Http\Controllers\Admin\UsersController::class,'updateUsers']);
        //Delete User
        Route::get('delete_user/{id}',[App\Http\Controllers\Admin\UsersController::class,'deleteUser']);
        // Delete Admin
        Route::get('delete_admin/{id}',[App\Http\Controllers\Admin\UsersController::class,'deleteAdmin']);



        //Fetch Data From Admin Users Table
        Route::get('admins',[App\Http\Controllers\Admin\UsersController::class,'admins']);
        //Update Admin Users Status
        Route::post('update_admin_status',[App\Http\Controllers\Admin\UsersController::class,'updateAdminStatus']);
        //Insert & Update Admin Users
        Route::match(['get','post'],'add_edit_admin/{id?}',[App\Http\Controllers\Admin\UsersController::class,'addEditAdmin']);
        // Delete Admin User
        Route::get('delete_admin/{id}',[App\Http\Controllers\Admin\UsersController::class,'deleteAdmin']);



        //Fetch Data From Section Table
        Route::get('sections',[SectionsController::class,'sections']);
        //Update Section Status
        Route::post('update_section_status',[SectionsController::class,'updateSectionStatus']);
        //Insert & Update Sections
        Route::match(['get','post'],'add_edit_sections/{id?}',[SectionsController::class,'addEditSections']);
        //Delete Sections
        Route::get('delete_section/{id}',[SectionsController::class,'deleteSections']);

         
        //Fetch Data From Categories Table
        Route::get('categories',[CategoriesController::class,'categories']);
        //Update Category Status
        Route::post('update_category_status',[CategoriesController::class,'updateCategoryStatus']);
        //Insert & Edit Categories
        Route::match(['get','post'],'add_edit_category/{id?}',[CategoriesController::class,'addEditCategory']);
        //Append Categories Level
        Route::post('append_categories_level',[CategoriesController::class,'appendCategoriesLevel']);
        Route::get('delete_category/{id}',[CategoriesController::class,'deleteCategory']);


        
        //Fetch Data From Brands Table
        Route::get('brands',[BrandsController::class,'brands']);
        //Update Brand Status
        Route::post('update_brand_status',[BrandsController::class,'updateBrandStatus']);
        //Insert & Update Brand
        Route::match(['get','post'],'add_edit_brands/{id?}',[BrandsController::class,'addEditBrands']);
        //Delete Brand
        Route::get('delete_brand/{id}',[BrandsController::class,'deleteBrands']);



        //Fetch Data From Units Table
        Route::get('units',[UnitsController::class,'units']);
        //Update Unit Status
        Route::post('update_unit_status',[UnitsController::class,'updateUnitStatus']);
        //Insert & Update Unit
        Route::match(['get','post'],'add_edit_units/{id?}',[UnitsController::class,'addEditUnits']);
        //Delete Unit
        Route::get('delete_unit/{id}',[UnitsController::class,'deleteUnits']);



        //Fetch Data From Suppliers Table
        Route::get('suppliers',[SuppliersController::class,'suppliers']);
        //Insert & Edit Suppliers
        Route::match(['get','post'],'add_edit_supplier/{id?}',[SuppliersController::class,'addEditSuppliers']);
        //Update Supplier Status
        Route::post('update_supplier_status',[SuppliersController::class,'updateSupplierStatus']);
        //Delete Supplier
        Route::get('delete_supplier/{id}',[SuppliersController::class,'deleteSupplier']);



         //Fetch Data From Warehouse Table
         Route::get('warehouses',[WarehouseController::class,'warehouses']);
         //Update Warehouse Status
         Route::post('update_warehouse_status',[WarehouseController::class,'updateWarehouseStatus']);
         //Insert & Update Warehouse
         Route::match(['get','post'],'add_edit_warehouse/{id?}',[WarehouseController::class,'addEditWarehouses']);
         //Delete Warehouse
         Route::get('delete_warehouse/{id}',[WarehouseController::class,'deleteWarehouses']);


        //Fetch Data From Bank Table
        Route::get('bankers',[BankController::class,'banks']);
        //Update Bank Status
        Route::post('update_bank_status',[BankController::class,'updateBankStatus']);
        //Insert & Update Bank Table
        Route::match(['get','post'],'add_edit_bank/{id?}',[BankController::class,'addEditBank']);
        //Delete Data From Bank
        Route::get('delete_bank/{id}',[BankController::class,'deleteBank']);


        //Products Table
        Route::get('products',[ProductsController::class,'products']);
         //Add Products In Various Branches
         Route::match(['get','post'],'add_edit_products_in_branches/{id?}',[ProductsController::class,'addEditProductsInBranches']);
        //Add Products In Various Branches
        Route::match(['get','post'],'add_products_in_branches',[ProductsController::class,'addProductsInBranches']);
        // Update Products In Various Branches
        Route::match(['get','post'],'update_products_in_branches/{id}',[ProductsController::class,'UpdateProductsInBranches']);
        //Update Product Status
        Route::post('update_products_in_branches_status',[ProductsController::class,'updateProductStatus']);
        //Delete Product
        Route::get('delete_product/{id}',[ProductsController::class,'deleteProduct']);


        //Main Warehouse
        Route::get('mainwarehouse',[MainWarehouseController::class,'mainwarehouse']);
        //Update Main Warehouse Status
        Route::post('update_mainwarehouse_status',[MainWarehouseController::class,'updateMainWarehouseStatus']);
        //Insert & Update Main Warehouse
        Route::match(['get','post'],'add_edit_mainwarehouse/{id?}',[MainWarehouseController::class,'addEditMainWarehouse']);
        //Add New Order
        Route::match(['get','post'],'add_new_order/{id?}',[MainWarehouseController::class,'addNewOrder']);
        //View Products Added Transactions In Main Warehouse
        Route::get('view_product_transaction_mainwarehouse/{id}',[MainWarehouseLogController::class,'viewTransactions']);
        //View Products Taken In Main Warehouse
        Route::get('view_product_taken_transaction/{id}',[MainWarehouseLogController::class,'productsTaken']);
        //View Products Sold In Main Warehouse
        Route::get('view_product_sold_transaction/{id}',[MainWarehouseLogController::class,'productsSold']);
        //Delete Product In Main Warehouse
        Route::get('delete_mainwarehouse/{id}',[MainWarehouseController::class,'deleteMainWareProduct']);
        //Delete Record In Main WarehouseLog
        Route::get('delete_mainwarehouseLog/{id}',[MainWarehouseLogController::class,'deleteLog']);


        // New/House Warehouse
        Route::get('newwarehouse',[MainWarehouseController::class,'newwarehouse']);


        // Low Stock At Warehouse
        Route::get('lowstock_products',[MainWarehouseController::class,'lowstockProducts']);


        //Stock Requests
        Route::get('stock_request',[StockRequestController::class,'stocks']);
        //Low Stock Request Decision
        Route::post('lowstock_request_decision/{id}',[StockRequestController::class,'stockrequest']);


        //Temporal Credit Given Out
        Route::get('temporal_credit',[TemporalCreditController::class,'credit']);
        // View Temporal Transaction Details
        Route::get('temporal_transaction_details/{id}',[TemporalCreditController::class,'temporalcreditdetails']);
        //Make Payment For Temporal Credit Owned
        Route::post('pay_temporal_credit/{id}',[TemporalCreditController::class,'payment']);

        

        //Customers & Creditors

        //Get All Customers
        Route::get('customers',[CustomersController::class,'customers']);
        //Get All Credit Requests
        Route::get('credit_requests',[CreditorsController::class,'creditrequest']);
        // Update Credit Requests
        Route::match(['get','post'],'credit_request_decision/{id}',[CreditorsController::class,'updatecreditrequest']);
        // Get All Creditors
        Route::get('creditors',[CreditorsController::class,'creditors']);
        // Get All Creditor's Account Book
        Route::match(['get','post'],'credit_account_summary/{id}',[CreditorsController::class,'creditorsbook']);
        // Get All Credits Paid
        Route::match(['get','post'],'credit_paid_details',[PaymentsController::class,'creditPaidDetails']);




        // Get All Big Customer
        Route::get('big_customers',[BigCustomersController::class,'bigcustomers']);
        // Add New Big Customer
        Route::match(['get','post'],'addbigcustomer',[BigCustomersController::class,'addbigcustomer']);
        // Creditor's Account Book
        Route::match(['get','post'],'credit_account_summary/{id}',[BigCustomersController::class,'creditorsbook']);
        // Add Credit Sales Transaction
        Route::match(['get','post'],'credit_transaction/{id}',[BigCustomersController::class,'addCreditTrans']);
        // Update Temporal Discount on Transaction
        Route::match(['get','post'],'update_credit_discount_transaction/{id}',[BigCustomersController::class,'updateCreditDiscount']);
        // Update Temporal Qty on Transaction
        Route::match(['get','post'],'update_credit_qty_transaction/{id}',[BigCustomersController::class,'updateCreditQty']);
        // Complete Sales Transaction
        Route::match(['get','post'],'complete_credit_transaction/{id}',[BigCustomersController::class,'completeCreditTrans']);
        // Delete Credit Transaction
        Route::match(['get','post'], 'delete_credit_transaction/{id}', [BigCustomersController::class,'deleteCreditTrans']);
        // Cancel Transaction
        Route::match(['get','post'],'cancel_credit_transaction/{id}',[BigCustomersController::class,'cancelCreditTrans']);
        // Transaction Receipt
        Route::match(['get','post'],'credit_transreceipt/{id}',[ReceiptController::class,'transCreditReceipt']);
        // Credit Paid
        Route::match(['get','post'],'credit_paid/{id}',[PaymentsController::class,'creditPaid']);
        // Credit Paid Details
        Route::match(['get','post'],'credit_paid_details',[PaymentsController::class,'creditPaidDetails']);

        



        // Get Detailed Of Expenses
        Route::get('daily_expenses',[CustomersController::class,'expenses']);


        // Cash Book
        Route::get('cashbook',[PaymentsController::class,'cashbook']);



        
        // Reports
        // Sales
        Route::get('daily_sales',[ReportsController::class,'dailysales']);
        Route::match(['get','post'],'previous_transaction',[ReportsController::class,'previoussalestransaction']);
        Route::get('monthly_sales',[ReportsController::class,'monthlysales']);
        Route::match(['get','post'],'monthly_transaction',[ReportsController::class,'monthlysalestransaction']);
        // Expenses
        Route::get('shops_daily_expenses',[ReportsController::class,'shopdailyexpenses']);
        Route::match(['get','post'],'previous_expenses',[ReportsController::class,'previousshopexpenses']);
        Route::get('shops_monthly_expenses',[ReportsController::class,'shopmonthexpenses']);
        Route::match(['get','post'],'monthly_expenses',[ReportsController::class,'monthlyexpenses']);





        //Admin LogOut
        Route::get('logOut',[AdminController::class,'logout']);

    });

   
    
});










//Routes For Users
Route::namespace('Sales')->group(function(){
    // Front Page
    Route::get('/',[IndexController::class,'index']);
    // Route::get('/','IndexController@start');
    Route::prefix('/sales')->group(function(){
        Route::match(['get','post'],'/login/{id?}',[UsersController::class,'saleslogin']);

        //Set Middleware to prevent unauthorized login
        Route::group(['middleware'=>['user']], function(){

            
            // Dashboard
            Route::get('dashboard',[UsersController::class,'dashboard']);


            // Account Settings
            Route::match(['get','post'],'account_settings',[UsersController::class,'changepassword']);
            //Check & Post User Current Password
            Route::match(['get','post'],'check_current_pswd',[UsersController::class,'chkCurrentPass']);
            Route::post('update_password',[UsersController::class,'updatePass']);
            // View Profile
            Route::match(['get','post'],'profile',[UsersController::class,'profile']);

            

            // Customers
            Route::get('customers',[App\Http\Controllers\Sales\CustomersController::class,'customer']);

            // Customer Sales Transaction
            Route::match(['get','post'],'transaction',[App\Http\Controllers\Sales\CustomersController::class,'transaction']);
            // Add Transaction
            Route::match(['get','post'],'add_transaction/{id}',[SalesController::class,'addTrans']);
            // Update Discount on Transaction
            Route::match(['get','post'],'update_discount_transaction/{id}',[SalesController::class,'updateDiscount']);
            // Update Qty on Transaction
            Route::match(['get','post'],'update_qty_transaction/{id}',[SalesController::class,'updateQty']);
            // Delete Temp Transaction
            Route::match(['get','post'],'delete_transaction/{id}',[SalesController::class,'deleteTrans']);
            // Complete Sales Transaction
            Route::match(['get','post'],'complete_transaction/{id}',[SalesController::class,'completeTrans']);
            // Get Daily Sales Details
            Route::match(['get','post'],'sales_details',[SalesController::class,'salesDetails']);
            // Cancel Transaction
            Route::match(['get','post'],'cancel_transaction/{id}',[SalesController::class,'cancelTrans']);
            // Transaction Receipt
            Route::match(['get','post'],'transreceipt/{id}',[App\Http\Controllers\Sales\ReceiptController::class,'transReceipt']);



            // Temporal Credit Customers
            Route::match(['get','post'],'temp_creditors',[App\Http\Controllers\Sales\CustomersController::class,'temp_creditors']);
            // Begin Transaction
            Route::match(['get','post'],'temp_transaction',[App\Http\Controllers\Sales\CustomersController::class,'temp_transaction']);
            // Add Temporal Credit Transaction
            Route::match(['get','post'],'add_temp_transaction/{id}',[App\Http\Controllers\Sales\TemporalCreditController::class,'addTempTrans']);
            // Update Temporal Discount on Transaction
            Route::match(['get','post'],'update_temp_discount_transaction/{id}',[App\Http\Controllers\Sales\TemporalCreditController::class,'updateTempDiscount']);
            // Update Temporal Qty on Transaction
            Route::match(['get','post'],'update_temp_qty_transaction/{id}',[App\Http\Controllers\Sales\TemporalCreditController::class,'updateTempQty']);
            // Delete Temporal Credit Temp Transaction
            Route::match(['get','post'],'delete_temp_transaction/{id}',[App\Http\Controllers\Sales\TemporalCreditController::class,'deleteTempTrans']);
            // Complete Sales Transaction
            Route::match(['get','post'],'complete_temp_transaction/{id}',[App\Http\Controllers\Sales\TemporalCreditController::class,'completeTempTrans']);
             // Cancel Temp Transaction
             Route::match(['get','post'],'cancel_temp_transaction/{id}',[App\Http\Controllers\Sales\TemporalCreditController::class,'cancelTempTrans']);
            // Success Message
            Route::match(['get','post'],'temp_credit_success/{id}',[App\Http\Controllers\Sales\ReceiptController::class,'successmsgTempTrans']);
            // View Temporal Transaction Details
            Route::get('temporal_transaction_details/{id}',[App\Http\Controllers\Sales\TemporalCreditController::class,'tempTransDetails']);





            // Creditors
            Route::get('creditors',[App\Http\Controllers\Sales\CustomersController::class,'creditors']);
            // Add New Creditor
            Route::match(['get','post'],'addcreditor',[App\Http\Controllers\Sales\CustomersController::class,'addcreditor']);
            // Creditor's Account Book
            Route::match(['get','post'],'credit_account_summary/{id}',[App\Http\Controllers\Sales\CustomersController::class,'creditorsbook']);
            // Add Credit Sales Transaction
            Route::match(['get','post'],'credit_transaction/{id}',[App\Http\Controllers\Sales\CustomersController::class,'addCreditTrans']);
            // Update Temporal Discount on Transaction
            Route::match(['get','post'],'update_credit_discount_transaction/{id}',[App\Http\Controllers\Sales\CustomersController::class,'updateCreditDiscount']);
            // Update Temporal Qty on Transaction
            Route::match(['get','post'],'update_credit_qty_transaction/{id}',[App\Http\Controllers\Sales\CustomersController::class,'updateCreditQty']);
            // Complete Sales Transaction
            Route::match(['get','post'],'complete_credit_transaction/{id}',[App\Http\Controllers\Sales\CustomersController::class,'completeCreditTrans']);
            // Delete Credit Transaction
            Route::match(['get','post'], 'delete_credit_transaction/{id}', [App\Http\Controllers\Sales\CustomersController::class,'deleteCreditTrans']);
            // Cancel Transaction
            Route::match(['get','post'],'cancel_credit_transaction/{id}',[App\Http\Controllers\Sales\CustomersController::class,'cancelCreditTrans']);
            // Transaction Receipt
            Route::match(['get','post'],'credit_transreceipt/{id}',[App\Http\Controllers\Sales\ReceiptController::class,'transCreditReceipt']);
            // Credit Paid
            Route::match(['get','post'],'credit_paid/{id}',[App\Http\Controllers\Sales\PaymentsController::class,'creditPaid']);
            // Credit Paid Details
            Route::match(['get','post'],'credit_paid_details',[App\Http\Controllers\Sales\PaymentsController::class,'creditPaidDetail']);



            
            // Low Stock
            Route::get('lowstock',[StocksController::class,'lowstocks']);
            // View Low Stock Request
            Route::match(['get','post'],'lowstockrequest',[StocksController::class,'lowstockrequest']);
            // Send Lowstock Request
            Route::match(['get','post'],'sendrequest/{id}',[StocksController::class,'stockrequest']);
            // Cancel Lowstock Request
            Route::match(['get','post'],'cancelrequest/{id}',[StocksController::class,'cancelrequest']);



            // Product Stocking
            Route::get('stocks',[StocksController::class,'stocks']);
            // Add Stocks
            Route::match(['get','post'],'addstock',[StocksController::class,'addstock']);
            // Returned Goods
            Route::match(['get','post'],'returned_goods',[StocksController::class,'returnedgoods']);
            // Add Returnd Goods to Shop
            Route::match(['get','post'],'addreturned',[StocksController::class,'addreturned']);
            // Get Customer Name From Receipt To Add To Stock Using Ajax
            Route::get('getcustomername',[StocksController::class,'getcustomername']);
            // Spoilt Goods
            Route::match(['get','post'],'spoilt_goods',[StocksController::class,'spoiltgoods']);
            // Remove Spoilt Goods
            Route::match(['get','post'],'addspoilt',[StocksController::class,'addspoilt']);



            // Daily Expenses
            Route::get('daily_expenses',[App\Http\Controllers\Sales\PaymentsController::class,'expenses']);
            // Add Expenses
            Route::match(['get','post'],'addexpense',[App\Http\Controllers\Sales\PaymentsController::class,'addexpense']);
            // Get Detailed Of Expenses
            Route::get('expenses_details',[App\Http\Controllers\Sales\PaymentsController::class,'expensesdetails']);



            // Cash Book
            Route::get('cashbook',[App\Http\Controllers\Sales\PaymentsController::class,'cashbook']);
            // Add Cash
            Route::match(['get','post'],'addcash',[App\Http\Controllers\Sales\PaymentsController::class,'addcash']);


            // Goods Sold To Other Shops
            Route::get('goods_shop',[StocksController::class,'goodshop']);
            // Add Goods Sold To Other Shops
            Route::match(['get','post'],'addgoods',[StocksController::class,'addgoods']);
            // Gas Pounds
            Route::get('gas_pds',[StocksController::class,'gaspds']);
            // Open New Gas
            Route::match(['get','post'],'open_gas',[StocksController::class,'opengas']);


            // View Product Price List
            Route::get('view_price_list',[StocksController::class,'viewprice']);



            // Reports
            // Previous Sales
            Route::get('sales_trans',[App\Http\Controllers\Sales\ReportsController::class,'salestrans']);
            Route::match(['get','post'],'previous_transaction',[App\Http\Controllers\Sales\ReportsController::class,'previoussalestransaction']);
            Route::get('monthly_trans',[App\Http\Controllers\Sales\ReportsController::class,'monthlysales']);
            Route::match(['get','post'],'monthly_transaction',[App\Http\Controllers\Sales\ReportsController::class,'monthlysalestransaction']);
            // Previous Expenses
            Route::get('expenses_made',[App\Http\Controllers\Sales\ReportsController::class,'expensesmade']);
            Route::match(['get','post'],'previous_expenses',[App\Http\Controllers\Sales\ReportsController::class,'prev_expenses']);


            // Re-Print Customer's Receipt
            Route::match(['get','post'],'re_print',[App\Http\Controllers\Sales\ReportsController::class,'reprint']);

            
            // Users Logout
            Route::get('logout',[UsersController::class, 'logout']);
        });
        
    });
    
});




