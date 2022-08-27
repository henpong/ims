@extends('layouts.salesLayout.sales_design')
@section('content')

<?php
	use App\Models\Products;
	use App\Models\Receipt;
	use App\Models\User;
	use App\Models\Expenses;
	use App\Models\Payments;
	


	// Count Total Products In Various Shops
	$countproduct = Products::countproduct();
	// dd($countproduct); die;

	// Count Total Products With Low Stock
	$countlowstock = Products::countlowstock();
	// dd($countlowstock); die;
	

	// Count Total Number of Sales For A Day
	$numbersales = Receipt::numbersales();
	// dd($numbersales); die;


	// Calculate Total Sales For Today
	$totalsales = Receipt::totalsales();

	$totalexpenses = Expenses::totalexpenses();
	// echo "<pre>"; print_r($totalexpenses); die;

	$dailysales = $totalsales - $totalexpenses;
	// dd($dailysales); die;


	// Get User Details
	$details = User::details();
	$details = json_decode(json_encode($details));

    // echo "<pre>"; print_r($details); die;


	// Calculate Total Credit Paid For Today
	$totalCreditPaid = Payments::totalCreditPaid();

?>
<!-- Content / Dashboard -->
	<div class="col-lg-4">
		<div class="card card-transparent card-block card-stretch card-height border-none">
			<div class="card-body p-0 mt-lg-2 mt-0">
				<h3 class="mb-3">
					Hello  
						<?php 

							$string =  Auth::guard('user')->user()->name ; 
							$name = explode(" ", $string);
							echo $name[0];

					    ?>, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					@include('layouts.salesLayout.greet')
				</h3>
				<p class="mb-0 mr-4">Your dashboard gives you everything you need for your sales transaction. Enjoy.</p>
			</div>
		</div>
	</div> 

	<div class="col-lg-8">
		<div class="row">
			<div class="col-lg-6 col-md-6">
				<div class="card card-block card-stretch card-height">
					<div class="card-body">
						<div class="d-flex align-items-center mb-4 card-total-sale">
							<div class="icon iq-icon-box-2 bg-info-light">
								<img src="{{url('backEnd/img/product/1.png')}}" class="img-fluid" alt="image">
							</div>
							<div>
								<p class="mb-2">Total Products In Your Shop</p>
								<h4><strong>{{ $countproduct }}</strong></h4>
							</div>
						</div>                                
						<div class="iq-progress-bar mt-2">
							<span class="bg-info iq-progress progress-1" data-percent="85">
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6">
				<div class="card card-block card-stretch card-height">
					<div class="card-body">
						<div class="d-flex align-items-center mb-4 card-total-sale">
							<div class="icon iq-icon-box-2 bg-danger-light">
								<img src="{{url('backEnd/img/product/2.png')}}" class="img-fluid" alt="image">
							</div>
							<div>
								<p class="mb-2">Product(s) With Low Stock</p>
								<h4><strong>{{ $countlowstock }}</strong></h4>
							</div>
						</div>
						<div class="iq-progress-bar mt-2">
							<span class="bg-danger iq-progress progress-1" data-percent="70">
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-3 col-md-4">
				<div class="card card-block card-stretch card-height">
					<div class="card-body">
						<div class="d-flex align-items-center mb-4 card-total-sale">
							<div class="icon iq-icon-box-2 bg-info-light">
								<img src="{{url('backend/img/product/1.png')}}" class="img-fluid" alt="image">
							</div>
							<div>
								<a href="{{ url('sales/expenses_details/' ) }}" style="text-decoration:none;color:#6E6D6D;">
									<p class="mb-2">Total Expenses For Today</p>
									<h4><strong>{{ "GHC "." ". number_format($totalexpenses,2) }}</strong></h4>
								</a>
							</div>
						</div>                                
						<div class="iq-progress-bar mt-2">
							<span class="bg-info iq-progress progress-1" data-percent="85">
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-4">
				<div class="card card-block card-stretch card-height">
					<div class="card-body">
						<div class="d-flex align-items-center mb-4 card-total-sale">
							<div class="icon iq-icon-box-2 bg-success-light">
								<img src="{{url('backEnd/img/product/3.png')}}" class="img-fluid" alt="image">
							</div>
							<div>
								<a href="{{ url('sales/credit_paid_details/' ) }}" style="text-decoration:none;color:#6E6D6D;">
									<p class="mb-2">Total Credit Paid For Today</p>
									<h4><strong>{{  "GHC "." ". number_format($totalCreditPaid,2) }}</strong></h4>
								</a>
							</div>
						</div>
						<div class="iq-progress-bar mt-2">
							<span class="bg-success iq-progress progress-1" data-percent="75">
							</span>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-4">
				<div class="card card-block card-stretch card-height">
					<div class="card-body">
						<div class="d-flex align-items-center mb-4 card-total-sale">
							<div class="icon iq-icon-box-2 bg-danger-light">
								<img src="{{url('backend/img/product/2.png')}}" class="img-fluid" alt="image">
							</div>
							<div>
								<p class="mb-2">Total Revenue(Sales) For Today</p>
								<h4>
									<strong>
										@if($dailysales)
											{{ "GHC "." ". number_format($dailysales,2) }}
										@else 
											{{ "GHC "." "."0.00" }}
										@endif
									</strong>
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

			<div class="col-lg-3 col-md-4">
				<div class="card card-block card-stretch card-height">
					<div class="card-body">
						<div class="d-flex align-items-center mb-4 card-total-sale">
							<div class="icon iq-icon-box-2 bg-success-light">
								<img src="{{url('backend/img/product/3.png')}}" class="img-fluid" alt="image">
							</div>
							<div>
								<a href="{{ url('sales/sales_details/' ) }}" style="text-decoration:none;color:#6E6D6D;">
									<p class="mb-2">Total No. Of Sales For Today</p>
									<h4><strong>{{ $numbersales }}</strong></h4>
								</a>
							</div>
						</div>
						<div class="iq-progress-bar mt-2">
							<span class="bg-success iq-progress progress-1" data-percent="75">
							</span>
						</div>
					</div>
				</div>
			</div>

			<!-- <div class="col-lg-3 col-md-3">
				<div class="card card-block card-stretch card-height">
					<div class="card-body">
						<div class="d-flex align-items-center mb-4 card-total-sale">
							<div class="icon iq-icon-box-2 bg-success-light">
								<img src="{{url('backEnd/img/product/3.png')}}" class="img-fluid" alt="image">
							</div>
							<div>
								<a href="{{ url('sales/credit_paid_details/' ) }}" style="text-decoration:none;color:#6E6D6D;">
									<p class="mb-2">Total Credit Paid For Today</p>
									<h4>
										<strong>{{  "GHC "." ". number_format($totalCreditPaid,2) }}</strong>
									</h4>
								</a>
							</div>
						</div>
						<div class="iq-progress-bar mt-2">
							<span class="bg-success iq-progress progress-1" data-percent="75">
							</span>
						</div>
					</div>
				</div>
			</div> -->
			<!-- <div class="col-lg-3 col-md-3">
				<div class="card card-block card-stretch card-height">
					<div class="card-body">
						<div class="d-flex align-items-center mb-4 card-total-sale">
							<div class="icon iq-icon-box-2 bg-warning-light">
								<img src="{{url('backEnd/img/product/3.png')}}" class="img-fluid" alt="image">
							</div>
							<div>
								
								<p class="mb-2">Product Sold</p>
								<h4>4589 M</h4>
							</div>
						</div>
						<div class="iq-progress-bar mt-2">
							<span class="bg-warning iq-progress progress-1" data-percent="75">
							</span>
						</div>
					</div>
				</div>
			</div> -->
		</div>
	</div>

	<!-- <div class="col-lg-6">
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
	</div> -->

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
									<img src="../assets/images/product/01.png" class="style-img img-fluid m-auto p-3" alt="image">
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
									<img src="../assets/images/product/02.png" class="style-img img-fluid m-auto p-3" alt="image">
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
									<img src="../assets/images/product/03.png" class="style-img img-fluid m-auto p-3" alt="image">
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
									<img src="../assets/images/product/02.png" class="style-img img-fluid m-auto p-3" alt="image">
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
	</div> -->
	<!-- <div class="col-lg-4">  
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
						<img src="../assets/images/product/04.png" class="style-img img-fluid m-auto" alt="image">
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
						<img src="../assets/images/product/05.png" class="style-img img-fluid m-auto" alt="image">
					</div>
					<div class="style-text text-left">
						<h5 class="mb-2">Bottle Cup Set</h5>
						<p class="mb-2">Total Sell : 44359</p>
						<p class="mb-0">Total Earned : $45,50 M</p>
					</div>
				</div>
			</div>
		</div>
	</div>-->
	<div class="col-lg-4">  
		<div class="card card-block card-stretch card-height-helf">
			<div class="card-body">
				<div class="d-flex align-items-top justify-content-between">
					<div class="">
						<p class="mb-0">Income</p>
						<h5>GHC 98,7800 K</h5>
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
						<h5>GHC 45,8956 K</h5>
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
							<h5>GHC 12,6598</h5>
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
							<h5>GHC 59,8478</h5>
							<p class="mb-0">Top Orders</p>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body pt-0">
				<div id="layout1-chart-5"></div>
			</div>
		</div>
	</div>
	<!-- Content / Dashboard -->

	
@endsection