
@extends('layouts.adminLayout.admin_design')
@section('content')


<?php

  use App\Models\MainWarehouse;
  use App\Models\Products;
  use App\Models\Expenses;
  use App\Models\Admin;
  use App\Models\Receipt;
  use App\Models\Branches;
  use App\Models\Payments;



  	// Get User Details
    $admindetails = Admin::admindetails();
    $admindetails = json_decode(json_encode($admindetails));

    // echo "<pre>"; print_r($details); die;



  $countmainwareproduct = MainWarehouse::countmainwareproduct();
  $countlowproducts = MainWarehouse::countlowproducts();
  // echo "<pre>"; print_r($countlowproducts); die;

  
  $countallproduct = Products::countallproduct();
  // echo "<pre>"; print_r($countallproduct); die;


  $totalexpensesallshop = Expenses::totalexpensesallshop();
  // echo "<pre>"; print_r($totalexpensesallshop); die;





  // ********************************************* //
  //  Calculate Daily Sales For Various Branches //
  // ********************************************* //

  // ** Calculate Total Daily Sales For Branch One **//
	$branonetotalsales = Receipt::branonetotalsales();
  // echo "<pre>"; print_r($branonetotalsales); die;

	  // $branonetotalSale = 0;
    // foreach ($branonetotalsales as $branonesubTotal) {
    //   $sales = (($branonesubTotal->qty_bought) * ($branonesubTotal->newprice));

    //   $total = ($branonesubTotal->qty * $sales);
    //   $branonetotalSale +=  $sales;
      
        
    // }
    // echo "<pre>"; print_r($branonetotalSale); die;



  $branonetotalexpenses = Expenses::branonetotalexpenses();
  // echo "<pre>"; print_r($branonetotalexpenses); die;

	$branonedailysales = $branonetotalsales - $branonetotalexpenses;
  // echo "<pre>"; print_r($branonedailysales); die;
  

  // Get Branch Name
  $branchdetails = Branches::where('status',2)->first();
  $branchdetails = json_decode(json_encode($branchdetails));

  if(!empty($branchdetails)){

    $branchonename = $branchdetails->branch_name;
    // ** Calculate Total Daily Sales For Branch One **//
  }






  // ** Calculate Total Daily Sales For Branch Two **//
	$brantwototalsales = Receipt::brantwototalsales();
  // echo "<pre>"; print_r($brantwototalsales); die;


  $brantwototalexpenses = Expenses::brantwototalexpenses();
  // echo "<pre>"; print_r($branonetotalexpenses); die;

	$brantwodailysales = $brantwototalsales - $brantwototalexpenses;
  // echo "<pre>"; print_r($brantwodailysales); die;
  

  // Get Branch Name
  $branchdetails = Branches::where('status',3)->first();
  $branchdetails = json_decode(json_encode($branchdetails));
  
  if(!empty($branchdetails)){
      

      $branchtwoname = $branchdetails->branch_name;
      // ** Calculate Total Daily Sales For Branch Two **//
  }






   // ** Calculate Total Daily Sales For Branch Three **//
	$branthreetotalsales = Receipt::branthreetotalsales();
  // echo "<pre>"; print_r($branthreetotalsales); die;


  $branthreetotalexpenses = Expenses::branthreetotalexpenses();
  // echo "<pre>"; print_r($branonetotalexpenses); die;

	$branthreedailysales = $branthreetotalsales - $branthreetotalexpenses;
  // echo "<pre>"; print_r($branthreedailysales); die;
  

  // Get Branch Name
  $branchdetails = Branches::where('status',4)->first();
  $branchdetails = json_decode(json_encode($branchdetails));
  
  if(!empty($branchdetails)){
      
      
      $branchthreename = $branchdetails->branch_name;
      // ** Calculate Total Daily Sales For Branch Three **//
  }







    // ** Calculate Total Daily Sales For Branch Four **//
	$branfourtotalsales = Receipt::branfourtotalsales();
  // // echo "<pre>"; print_r($branfourtotalsales); die;


  $branfourtotalexpenses = Expenses::branfourtotalexpenses();
  // // echo "<pre>"; print_r($branfourtotalexpenses); die;

	$branfourdailysales = $branfourtotalsales - $branfourtotalexpenses;
  // // echo "<pre>"; print_r($branfourdailysales); die;
  

  // // Get Branch Name
  $branchdetails = Branches::where('status',5)->first();
  $branchdetails = json_decode(json_encode($branchdetails));
  
  if(!empty($branchdetails)){
      
       $branchfourname = $branchdetails->branch_name;
        // ** Calculate Total Daily Sales For Branch Four **//
  }

 





    // ** Calculate Total Daily Sales For Branch Five **//
	$branfivetotalsales = Receipt::branfivetotalsales();
  // // echo "<pre>"; print_r($branfivetotalsales); die;


  $branfivetotalexpenses = Expenses::branfivetotalexpenses();
  // // echo "<pre>"; print_r($branfivetotalexpenses); die;

	$branfivedailysales = $branfivetotalsales - $branfivetotalexpenses;
  // // echo "<pre>"; print_r($branfivedailysales); die;
  

  // // Get Branch Name
  $branchdetails = Branches::where('status',6)->first();
  $branchdetails = json_decode(json_encode($branchdetails));
  
if(!empty($branchdetails)){
    
    $branchfivename = $branchdetails->branch_name;
  // ** Calculate Total Daily Sales For Branch Five **//
}

  






  // ** Calculate Total Daily Sales For Branch Six **//
	$bransixtotalsales = Receipt::bransixtotalsales();
  // // echo "<pre>"; print_r($bransixtotalsales); die;


  $bransixtotalexpenses = Expenses::bransixtotalexpenses();
  // // echo "<pre>"; print_r($bransixtotalexpenses); die;

	$bransixdailysales = $bransixtotalsales - $bransixtotalexpenses;
  // // echo "<pre>"; print_r($bransixdailysales); die;
  

  // // Get Branch Name
  $branchdetails = Branches::where('status',7)->first();
  $branchdetails = json_decode(json_encode($branchdetails));
  
  if(!empty($branchdetails)){
      
      
      $branchsixname = $branchdetails->branch_name;
      // ** Calculate Total Daily Sales For Branch Six **//
  }



    // Calculate Total Credit Paid For Today
	$totalCreditPaidAllBranches = Payments::totalCreditPaidAllBranches();



?>

<!-- {{ Auth::guard('admin')->user()->name }} -->
<br><br><br>

<!-- Content / Dashboard -->
<div class="col-lg-4">
      <div class="card card-transparent card-block card-stretch card-height border-none" >
          <div class="card-body p-0 mt-lg-2 mt-0">
            <h3 class="mb-3">
              Hello
                <?php 

                    $string =  Auth::guard('admin')->user()->name ; 
                    $name = explode(" ", $string);
                    echo $name[0];

                ?>, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @include('layouts.adminLayout.greet')
            </h3>
              <p class="mb-0 mr-4">Your dashboard gives you everything you need for your sales transaction. Enjoy.</p>
          </div>
      </div>
  </div>




  <div class="col-lg-8">
      <div class="row">
          <div class="col-lg-4 col-md-6">
              <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                      <div class="d-flex align-items-center mb-4 card-total-sale">
                          <div class="icon iq-icon-box-2 bg-info-light">
                              <img src="{{url('backend/img/product/1.png')}}" class="img-fluid" alt="image">
                          </div>
                          <div>
                              <h6 class="card-title">KANESHIE BRANCH</h6>
                              <h6 class="mb-2" style="font-size:13px"> @if(!empty($branchdetails)) {{ strtoupper($branchonename)}} @endif </h6>
                              <h4>
                                @if($branonedailysales)
                                    {{ "GHC ".number_format($branonedailysales,2) }}
                                @else 
                                    {{ "GHC 0.00" }}
                                @endif
                              </h4>
                          </div>
                      </div>                                
                      <div class="iq-progress-bar mt-2">
                          <span class="bg-info iq-progress progress-1" data-percent="85">
                          </span>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-4 col-md-6">
              <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                      <div class="d-flex align-items-center mb-4 card-total-sale">
                          <div class="icon iq-icon-box-2 bg-danger-light">
                              <img src="{{url('backend/img/product/2.png')}}" class="img-fluid" alt="image">
                          </div>
                          <div>

                                <h6 class="card-title">ANGLICAN CHURCH</h6>
                                <h6 class="mb-2" style="font-size:13px">@if(!empty($branchdetails)){{ strtoupper($branchtwoname) }} @endif</h6>
                                <h4>
                                    @if($brantwodailysales)
                                        {{ "GHC ".number_format($brantwodailysales,2) }}
                                    @else 
                                        {{ "GHC 0.00" }}
                                    @endif
                                </h4>
                          </div>
                      </div>
                      <div class="iq-progress-bar mt-2">
                          <span class="bg-danger iq-progress progress-1" data-percent="70">
                          </span>
                      </div>
                  </div>
              </div>
          </div>
            <div class="col-lg-4 col-md-6">
              <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                      <div class="d-flex align-items-center mb-4 card-total-sale">
                          <div class="icon iq-icon-box-2 bg-success-light">
                              <img src="{{url('backend/img/product/3.png')}}" class="img-fluid" alt="image">
                          </div>
                          <div>

                                <h6 class="card-title">KANESHIE BRANCH</h6>
                                <h6 class="mb-2" style="font-size:13px">@if(!empty($branchdetails)){{ strtoupper($branchthreename) }} @endif</h6>
                                <h4>
                                    @if($branthreedailysales)
                                        {{ "GHC ".number_format($branthreedailysales,2) }}
                                    @else 
                                        {{ "GHC 0.00" }}
                                    @endif
                                </h4>
                          </div>
                      </div>
                      <div class="iq-progress-bar mt-2">
                          <span class="bg-success iq-progress progress-1" data-percent="75">
                          </span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  
  <div class="col-lg-12 offset-md">
      <div class="row">
          <div class="col-lg-3 col-md-3">
              <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                      <div class="d-flex align-items-center mb-4 card-total-sale">
                          <div class="icon iq-icon-box-2 bg-info-light">
                              <img src="{{url('backend/img/product/1.png')}}" class="img-fluid" alt="image">
                          </div>
                          <div>
                              <h6 class="card-title">CIRCLE BRANCH</h6>
                              <h6 class="mb-2" style="font-size:13px">@if(!empty($branchdetails)){{ strtoupper($branchfourname) }} @endif</h6>
                              <h4>
                                @if($branfourdailysales)
                                    {{ "GHC ".number_format($branfourdailysales,2) }}
                                @else 
                                    {{ "GHC 0.00" }}
                                @endif
                              </h4>
                          </div>
                      </div>                                
                      <div class="iq-progress-bar mt-2">
                          <span class="bg-info iq-progress progress-1" data-percent="85">
                          </span>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-3">
              <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                      <div class="d-flex align-items-center mb-4 card-total-sale">
                          <div class="icon iq-icon-box-2 bg-danger-light">
                              <img src="{{url('backend/img/product/2.png')}}" class="img-fluid" alt="image">
                          </div>
                          <div>

                                <h6 class="card-title">TAKORADI BRANCH</h6>
                                <h6 class="mb-2" style="font-size:13px">@if(!empty($branchdetails)){{ strtoupper($branchfivename) }} @endif</h6>
                                <h4>
                                    @if($branfivedailysales)
                                        {{ "GHC ".number_format($branfivedailysales,2) }}
                                    @else 
                                        {{ "GHC 0.00" }}
                                    @endif
                                </h4>
                          </div>
                      </div>
                      <div class="iq-progress-bar mt-2">
                          <span class="bg-danger iq-progress progress-1" data-percent="70">
                          </span>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-3">
              <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                      <div class="d-flex align-items-center mb-4 card-total-sale">
                          <div class="icon iq-icon-box-2 bg-success-light">
                              <img src="{{url('backend/img/product/3.png')}}" class="img-fluid" alt="image">
                          </div>
                          <div>
                                <h6 class="card-title">TOGO BRANCH</h6>
                                <h6 class="mb-2" style="font-size:13px">@if(!empty($branchdetails)){{ strtoupper($branchsixname) }} @endif</h6>
                                <h4>
                                    @if($bransixdailysales)
                                        {{ "GHC ".number_format($bransixdailysales,2) }}
                                    @else 
                                        {{ "GHC 0.00" }}
                                    @endif
                                </h4>
                          </div>
                      </div>
                      <div class="iq-progress-bar mt-2">
                          <span class="bg-success iq-progress progress-1" data-percent="75">
                          </span>
                      </div>
                  </div>
              </div>
          </div>
           <div class="col-lg-3 col-md-3">
              <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                      <a href="{{ url('/admin/daily_expenses') }}">
                        <div class="d-flex align-items-center mb-4 card-total-sale">
                            <div class="icon iq-icon-box-2 bg-success-light">
                                <img src="{{url('backend/img/product/3.png')}}" class="img-fluid" alt="image">
                            </div>
                            <div>
                                    <h6 class="card-title">EXPENSES FOR ALL BRANCHES</h6>
                                    <h6 class="mb-2" style="font-size:13px">Today's Total Expenses For All Branches</h6>
                                    <h4>
                                        @if($totalexpensesallshop)
                                            {{ "GHC ". number_format($totalexpensesallshop,2) }}
                                        @else
                                            {{ "GHC 0.00" }}
                                        @endif
                                    </h4>
                            </div>
                        </div>
                      </a>
                       <div class="iq-progress-bar mt-2">
                          <span class="bg-success iq-progress progress-1" data-percent="75">
                          </span>
                      </div> 
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  
  
  
   <div class="col-lg-12 offset-md">
      <div class="row">
          <div class="col-lg-3 col-md-3">
              <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                    <a href="{{ url('/admin/credit_paid_details') }}">
                      <div class="d-flex align-items-center mb-4 card-total-sale">
                          <div class="icon iq-icon-box-2 bg-danger-light">
                              <img src="{{url('backend/img/product/2.png')}}" class="img-fluid" alt="image">
                          </div>
                          <div>

                                <h6 class="card-title">CREDIT PAID AT ALL BRANCHES</h6>
                                <h6 class="mb-2" style="font-size:13px">Credit Paid Today At All Branches</h6>
                                <h4>
                                    @if($totalCreditPaidAllBranches)
                                        {{ "GHC ".number_format($totalCreditPaidAllBranches,2) }}
                                    @else 
                                        {{ "GHC 0.00" }}
                                    @endif
                                </h4>
                          </div>
                      </div>
                    </a>
                      <div class="iq-progress-bar mt-2">
                          <span class="bg-danger iq-progress progress-1" data-percent="70">
                          </span>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-3">
              <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                       <a href="{{ url('/admin/lowstock_products') }}">
                        <div class="d-flex align-items-center mb-4 card-total-sale">
                                <div class="icon iq-icon-box-2 bg-info-light">
                                    <img src="{{url('backend/img/product/1.png')}}" class="img-fluid" alt="image">
                                </div>
                                <div>
                                    <h6 class="card-title">Low Stock In Warehouse</h6>
                                    <h6 class="mb-2" style="font-size:13px">Products With Low Stocks</h6>
                                    <h4>
                                        {{ $countlowproducts }}
                                    </h4>
                                </div>
                            </div> 
                       </a>                               
                      <!-- <div class="iq-progress-bar mt-2">
                          <span class="bg-info iq-progress progress-1" data-percent="85">
                          </span>
                      </div> -->
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-3">
              <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                      <div class="d-flex align-items-center mb-4 card-total-sale">
                          <div class="icon iq-icon-box-2 bg-danger-light">
                              <img src="{{url('backend/img/product/2.png')}}" class="img-fluid" alt="image">
                          </div>
                          <div>

                                <h6 class="card-title">Total Product(s) In All Shops</h6>
                                <h6 class="mb-2" style="font-size:13px">Count Total Products In All Shops</h6>
                                <h4>
                                    {{ $countallproduct }}
                                </h4>
                          </div>
                      </div>
                      <!-- <div class="iq-progress-bar mt-2">
                          <span class="bg-danger iq-progress progress-1" data-percent="70">
                          </span>
                      </div> -->
                  </div>
              </div>
          </div>
          <div class="col-lg-3 col-md-3">
              <div class="card card-block card-stretch card-height">
                  <div class="card-body">
                      <div class="d-flex align-items-center mb-4 card-total-sale">
                          <div class="icon iq-icon-box-2 bg-success-light">
                              <img src="{{url('backend/img/product/3.png')}}" class="img-fluid" alt="image">
                          </div>
                          <div>
                                <h6 class="card-title">Total Product(s) In Warehouses</h6>
                                <h6 class="mb-2" style="font-size:13px">Count All Products In Warehouse</h6>
                                <h4>
                                    {{ $countmainwareproduct }}
                                </h4>
                          </div>
                      </div>
                      <!-- <div class="iq-progress-bar mt-2">
                          <span class="bg-success iq-progress progress-1" data-percent="75">
                          </span>
                      </div> -->
                  </div>
              </div>
          </div>
      </div>
  </div>
  

  <div class="col-lg-6">
      <div class="card card-block card-stretch card-height">
          <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                  <h4 class="card-title">Overview</h4>
              </div>                        
              <div class="card-header-toolbar d-flex align-items-center">
                  <div class="dropdown">
                      <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton001"
                          data-toggle="dropdown">
                          This Month<i class="ri-arrow-down-s-line ml-1"></i>
                      </span>
                      <div class="dropdown-menu dropdown-menu-right shadow-none"
                          aria-labelledby="dropdownMenuButton001">
                          <a class="dropdown-item" href="#">Year</a>
                          <a class="dropdown-item" href="#">Month</a>
                          <a class="dropdown-item" href="#">Week</a>
                      </div>
                  </div>
              </div>
          </div>                    
          <div class="card-body">
              <div id="layout1-chart1"></div>
          </div>
      </div>
  </div>
  <div class="col-lg-6">
      <div class="card card-block card-stretch card-height">
          <div class="card-header d-flex align-items-center justify-content-between">
              <div class="header-title">
                  <h4 class="card-title">Revenue Vs Cost</h4>
              </div>
              <div class="card-header-toolbar d-flex align-items-center">
                  <div class="dropdown">
                      <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton002"
                          data-toggle="dropdown">
                          This Month<i class="ri-arrow-down-s-line ml-1"></i>
                      </span>
                      <div class="dropdown-menu dropdown-menu-right shadow-none"
                          aria-labelledby="dropdownMenuButton002">
                          <a class="dropdown-item" href="#">Yearly</a>
                          <a class="dropdown-item" href="#">Monthly</a>
                          <a class="dropdown-item" href="#">Weekly</a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="card-body">
              <div id="layout1-chart-2" style="min-height: 360px;"></div>
          </div>
      </div>
  </div>
  <!-- <div class="col-lg-8">
      <div class="card card-block card-stretch card-height">
          <div class="card-header d-flex align-items-center justify-content-between">
              <div class="header-title">
                  <h4 class="card-title">Top Products</h4>
              </div>
              <div class="card-header-toolbar d-flex align-items-center">
                  <div class="dropdown">
                      <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton006"
                          data-toggle="dropdown">
                          This Month<i class="ri-arrow-down-s-line ml-1"></i>
                      </span>
                      <div class="dropdown-menu dropdown-menu-right shadow-none"
                          aria-labelledby="dropdownMenuButton006">
                          <a class="dropdown-item" href="#">Year</a>
                          <a class="dropdown-item" href="#">Month</a>
                          <a class="dropdown-item" href="#">Week</a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="card-body">
              <ul class="list-unstyled row top-product mb-0">
                  <li class="col-lg-3">
                      <div class="card card-block card-stretch card-height mb-0">
                          <div class="card-body">
                              <div class="bg-warning-light rounded">
                                  <img src="{{url('backEnd/img/product/01.png')}}" class="style-img img-fluid m-auto p-3" alt="image">
                              </div>
                              <div class="style-text text-left mt-3">
                                  <h5 class="mb-1">Organic Cream</h5>
                                  <p class="mb-0">789 Item</p>
                              </div>
                          </div>
                      </div>
                  </li>
                  <li class="col-lg-3">
                      <div class="card card-block card-stretch card-height mb-0">
                          <div class="card-body">
                              <div class="bg-danger-light rounded">
                                  <img src="{{url('backEnd/img/product/02.png')}}" class="style-img img-fluid m-auto p-3" alt="image">
                              </div>
                              <div class="style-text text-left mt-3">
                                  <h5 class="mb-1">Rain Umbrella</h5>
                                  <p class="mb-0">657 Item</p>
                              </div>
                          </div>
                      </div>
                  </li>
                  <li class="col-lg-3">
                      <div class="card card-block card-stretch card-height mb-0">
                          <div class="card-body">
                              <div class="bg-info-light rounded">
                                  <img src="{{url('backEnd/img/product/03.png')}}" class="style-img img-fluid m-auto p-3" alt="image">
                              </div>
                              <div class="style-text text-left mt-3">
                                  <h5 class="mb-1">Serum Bottle</h5>
                                  <p class="mb-0">489 Item</p>
                              </div>
                          </div>
                      </div>
                  </li>
                  <li class="col-lg-3">
                      <div class="card card-block card-stretch card-height mb-0">
                          <div class="card-body">
                              <div class="bg-success-light rounded">
                                  <img src="{{url('backEnd/img/product/02.png')}}" class="style-img img-fluid m-auto p-3" alt="image">
                              </div>
                              <div class="style-text text-left mt-3">
                                  <h5 class="mb-1">Organic Cream</h5>
                                  <p class="mb-0">468 Item</p>
                              </div>
                          </div>
                      </div>
                  </li>
              </ul>
          </div>
      </div>
  </div>
  <div class="col-lg-4">  
      <div class="card-transparent card-block card-stretch mb-4">
          <div class="card-header d-flex align-items-center justify-content-between p-0">
              <div class="header-title">
                  <h4 class="card-title mb-0">Best Item All Time</h4>
              </div>
              <div class="card-header-toolbar d-flex align-items-center">
                  <div><a href="#" class="btn btn-primary view-btn font-size-14">View All</a></div>
              </div>
          </div>
      </div>
      <div class="card card-block card-stretch card-height-helf">
          <div class="card-body card-item-right">
              <div class="d-flex align-items-top">
                  <div class="bg-warning-light rounded">
                      <img src="{{url('backEnd/img/product/04.png')}}" class="style-img img-fluid m-auto" alt="image">
                  </div>
                  <div class="style-text text-left">
                      <h5 class="mb-2">Coffee Beans Packet</h5>
                      <p class="mb-2">Total Sell : 45897</p>
                      <p class="mb-0">Total Earned : $45,89 M</p>
                  </div>
              </div>
          </div>
      </div>
      <div class="card card-block card-stretch card-height-helf">
          <div class="card-body card-item-right">
              <div class="d-flex align-items-top">
                  <div class="bg-danger-light rounded">
                      <img src="{{url('backEnd/img/product/05.png')}}" class="style-img img-fluid m-auto" alt="image">
                  </div>
                  <div class="style-text text-left">
                      <h5 class="mb-2">Bottle Cup Set</h5>
                      <p class="mb-2">Total Sell : 44359</p>
                      <p class="mb-0">Total Earned : $45,50 M</p>
                  </div>
              </div>
          </div>
      </div>
  </div> 
  <div class="col-lg-4">  
      <div class="card card-block card-stretch card-height-helf">
          <div class="card-body">
              <div class="d-flex align-items-top justify-content-between">
                  <div class="">
                      <p class="mb-0">Income</p>
                      <h5>$ 98,7800 K</h5>
                  </div>
                  <div class="card-header-toolbar d-flex align-items-center">
                      <div class="dropdown">
                          <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton003"
                              data-toggle="dropdown">
                              This Month<i class="ri-arrow-down-s-line ml-1"></i>
                          </span>
                          <div class="dropdown-menu dropdown-menu-right shadow-none"
                              aria-labelledby="dropdownMenuButton003">
                              <a class="dropdown-item" href="#">Year</a>
                              <a class="dropdown-item" href="#">Month</a>
                              <a class="dropdown-item" href="#">Week</a>
                          </div>
                      </div>
                  </div>
              </div>
              <div id="layout1-chart-3" class="layout-chart-1"></div>
          </div>
      </div>
      <div class="card card-block card-stretch card-height-helf">
          <div class="card-body">
              <div class="d-flex align-items-top justify-content-between">
                  <div class="">
                      <p class="mb-0">Expenses</p>
                      <h5>$ 45,8956 K</h5>
                  </div>
                  <div class="card-header-toolbar d-flex align-items-center">
                      <div class="dropdown">
                          <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton004"
                              data-toggle="dropdown">
                              This Month<i class="ri-arrow-down-s-line ml-1"></i>
                          </span>
                          <div class="dropdown-menu dropdown-menu-right shadow-none"
                              aria-labelledby="dropdownMenuButton004">
                              <a class="dropdown-item" href="#">Year</a>
                              <a class="dropdown-item" href="#">Month</a>
                              <a class="dropdown-item" href="#">Week</a>
                          </div>
                      </div>
                  </div>
              </div>
              <div id="layout1-chart-4" class="layout-chart-2"></div>
          </div>
      </div>
  </div>
  <div class="col-lg-8">  
      <div class="card card-block card-stretch card-height">
          <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                  <h4 class="card-title">Order Summary</h4>
              </div>                        
              <div class="card-header-toolbar d-flex align-items-center">
                  <div class="dropdown">
                      <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton005"
                          data-toggle="dropdown">
                          This Month<i class="ri-arrow-down-s-line ml-1"></i>
                      </span>
                      <div class="dropdown-menu dropdown-menu-right shadow-none"
                          aria-labelledby="dropdownMenuButton005">
                          <a class="dropdown-item" href="#">Year</a>
                          <a class="dropdown-item" href="#">Month</a>
                          <a class="dropdown-item" href="#">Week</a>
                      </div>
                  </div>
              </div>
          </div> 
          <div class="card-body pb-2">
              <div class="d-flex flex-wrap align-items-center mt-2">
                  <div class="d-flex align-items-center progress-order-left">
                      <div class="progress progress-round m-0 orange conversation-bar" data-percent="46">
                          <span class="progress-left">
                              <span class="progress-bar"></span>
                          </span>
                          <span class="progress-right">
                              <span class="progress-bar"></span>
                          </span>
                          <div class="progress-value text-secondary">46%</div>
                      </div>
                      <div class="progress-value ml-3 pr-5 border-right">
                          <h5>$12,6598</h5>
                          <p class="mb-0">Average Orders</p>
                      </div>
                  </div>
                  <div class="d-flex align-items-center ml-5 progress-order-right">
                      <div class="progress progress-round m-0 primary conversation-bar" data-percent="46">
                          <span class="progress-left">
                              <span class="progress-bar"></span>
                          </span>
                          <span class="progress-right">
                              <span class="progress-bar"></span>
                          </span>
                          <div class="progress-value text-primary">46%</div>
                      </div>
                      <div class="progress-value ml-3">
                          <h5>$59,8478</h5>
                          <p class="mb-0">Top Orders</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="card-body pt-0">
              <div id="layout1-chart-5"></div>
          </div>
      </div>
</div> -->
<!-- Content / Dashboard -->


@endsection