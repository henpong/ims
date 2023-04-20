

<?php
  use App\Models\User;

  $userdetails = User::details();

//   $image = $userdetails->image;

//   echo "<pre>"; print_r($image); die;

$branchname = $userdetails->userbranch->branch_name;

// echo "<pre>"; print_r($branchname); die;

?>

<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from iqonic.design/themes/posdash/html/backend/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 21 Jun 2021 11:23:33 GMT -->
<head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>{{ $metaTitle ?? config('app.name', 'Nakwasoft') }}</title>
      
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" sizes="32x32" href="{{url('backend/img/chiboy_logo.png')}}">
        <link rel="stylesheet" href="{{url('backend/css/backend-plugin.min.css')}}">
        <link rel="stylesheet" href="{{url('backend/css/backende209.css?v=1.0.0')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{url('backend/plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{url('backend/vendor/fortawesome/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{url('backend/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css')}}">
        <link rel="stylesheet" href="{{url('backend/vendor/remixicon/fonts/remixicon.css')}}">
        <!-- Select 2 -->
        <link rel="stylesheet" href="{{url('backend/plugins/select2/css/select2.min.css')}}">
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
        <!-- DataTable CSS -->
        <link rel="stylesheet" href="{{url('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
        <link rel="stylesheet" href="{{asset('backend/plugins/bootstrap-datepicker/css/daterangepicker.min.css')}}">
        <!-- Sweet Alert2 -->
        <link rel="stylesheet" href="{{url('backend/js/sweetalert2/dist/sweetalert2.min.css')}}">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{url('backend/login_css/custom.css')}}">
        <!-- Toastr Notification -->
        <link rel="stylesheet" href="{{url('backend/css/toastr.min.css')}}">
        <script src="{{asset('backend/js/moment.js')}}"></script>
  </head>
  <body class="  ">
    <!-- loader Start -->
    <!-- <div id="loading">
          <div id="loading-center">
          </div>
    </div> -->
    <!-- loader END -->


    <!-- Wrapper Start -->
    <div class="wrapper">
      
      <!-- Sidebar -->
        @include('layouts.salesLayout.sidebar')    
      <!-- End Sidebar -->




        <!-- Header -->
        <div class="iq-top-navbar">
          <div class="iq-navbar-custom">
              <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                      <i class="ri-menu-line wrapper-menu"></i>
                      <a href="{{url('/sales/dashboard')}}" class="header-logo">
                          <img src="{{url('backend/img/logo.jpg')}}" class="img-fluid rounded-normal" alt="logo">
                          <h5 class="logo-title ml-3">IMS CHIBOY</h5>
      
                      </a>
                  </div>
                    
                  <div class="iq-search-bar device-search">
                    <span style="margin-right:20px;color:#000fff;font-weight:bold">{{ date('l').' , '.' '.date('jS') .' '.date('F').', '.date('Y') }}</span>
                    <span style="margin-right:20px;"> @include('layouts.salesLayout.datetime') </span>

                    <span style="margin-right:20px;color:#24166B">|</span>
                        
                    <span style="color:#ff0000;font-size:20px;font-weight:bold">{{ $branchname }}</span>
                  </div>

                  <div class="d-flex align-items-center">
                      <!--<div class="change-mode">
                          <div class="custom-control custom-switch custom-switch-icon custom-control-inline">
                              <div class="custom-switch-inner">
                                  <p class="mb-0"> </p>
                                  <input type="checkbox" class="custom-control-input" id="dark-mode" data-active="true">
                                  <label class="custom-control-label" for="dark-mode" data-mode="toggle">
                                      <span class="switch-icon-left"><i class="a-left ri-moon-clear-line"></i></span>
                                      <span class="switch-icon-right"><i class="a-right ri-sun-line"></i></span>
                                  </label>
                              </div>
                          </div>
                      </div>-->
                      <button class="navbar-toggler" type="button" data-toggle="collapse"
                          data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                          aria-label="Toggle navigation">
                          <i class="ri-menu-3-line"></i>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav ml-auto navbar-list align-items-center">
                          <!--  -->
                            <li class="pull-left welcome-name">
							    <span style="color:#000000;margin-right:10px"> 
                                    Welcome: 
                                </span> 
                                
                                <span> 
                                    <?php

                                        $string =  Auth::guard('user')->user()->name ; 
                                        $name = explode(" ", $string);
                                        echo $name[0];

                                    ?>
                                </span>
						    </li>
                            
                              <li class="nav-item nav-icon dropdown caption-content">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        @if(($userdetails->image) !== "NULL")
                                            <img src="{{asset('backend/img/uploadedImages/usersImages/'.Auth::guard('user')->user()->image)}}" alt="user" class="img-fluid rounded">
                                        @elseif(($userdetails->image) == "NULL")
                                            <img src="{{asset('backend/img/uploadedImages/usersImages/user.jpg')}}" alt="user" class="img-fluid rounded">
                                        @endif

                                    </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 text-center">
                                              <div class="media-body profile-detail text-center">
                                                  <img src="{{url('backend/img/logo.jpg')}}" alt="profile-bg" class="rounded-top img-fluid " style="width:200px; height: 200px;">
                                                        @if(($userdetails->image) !== "NULL")
                                                            <img src="{{asset('backend/img/uploadedImages/usersImages/'.Auth::guard('user')->user()->image)}}" alt="profile-img" class="rounded profile-img img-fluid avatar-70" style="width:150px; height: 120px;">
                                                        @elseif(($userdetails->image) == "NULL") 
                                                            <img src="{{asset('backend/img/uploadedImages/usersImages/user.jpg')}}" alt="profile-img" class="rounded profile-img img-fluid avatar-70" style="width:150px; height: 120px;">
                                                        @endif
                                              </div>
                                              <div class="p-3">
                                                  <h5 class="mb-1"><span style="font-size: 12px">{{ Auth::guard('user')->user()->email }}</span></h5>
                                                  <p class="mb-0">{{  date("jS F, Y ",strtotime(Auth::guard('user')->user()->created_at )) }}</p>
                                                  <div class="d-flex align-items-center justify-content-center mt-3">
                                                      <a href="{{ url('sales/account_settings') }}" class="btn border mr-2"><i class="fas fa-user text-blue"> </i> Profile</a>
                                                      <a href="#" class="btn border" data-toggle="modal" data-target="#logoutModal" data-backdrop="static">
                                                      <i class="fas fa-power-off text-red fa-spin"></i>Sign Out</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>

                          </ul>
                      </div>
                  </div>
              </nav>
          </div>
      </div>


      <!-- <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-body">
                      <div class="popup text-left">
                          <h4 class="mb-3">New Order</h4>
                          <div class="content create-workform bg-body">
                              <div class="pb-3">
                                  <label class="mb-2">Email</label>
                                  <input type="text" class="form-control" placeholder="Enter Name or Email">
                              </div>
                              <div class="col-lg-12 mt-4">
                                  <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                      <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                                      <div class="btn btn-outline-primary" data-dismiss="modal">Create</div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div> -->
      
      <!-- End Header -->



     
    <div class="content-page">
     <div class="container-fluid">
        <div class="row">