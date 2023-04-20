
<?php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Products;
    use App\Models\TemporalCredit;


    $countlowstock = Products::countlowstock();
    // dd($countlowstock); die;


    // Count Unpaid Goods Given To Other Shops
    $goodscounts = TemporalCredit::goodscounts();
    // dd($goodscounts); die;
?>


  <div class="iq-sidebar  sidebar-default ">
          <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
              <a href="{{url('/sales/dashboard')}}" class="header-logo">
                  <img src="{{url('backend/img/logo.jpg')}}" class="img-fluid rounded-normal light-logo" alt="logo" style="width:140px;height:70px;margin-top:25px;">
                  <h5 class="logo-title light-logo ml-3" style="font-size:14px;padding-top:35px;text-align:center">IMS CHIBOY ENTERPRISE</h5>
              </a>
              <div class="iq-menu-bt-sidebar ml-0">
                  <i class="fas fa-bars wrapper-menu" style="cursor:pointer"></i>
              </div>
          </div>
          <div class="data-scrollbar" data-scroll="1">
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">

                      <li class="active">
                          <a href="{{ url('sales/dashboard') }}" class="svg-icon ">                        
                              <svg  class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
                              </svg>
                              <span class="ml-4">Dashboard</span>
                          </a>
                      </li>



                       <!-- Sales/Customers -->

                    @if(Session::get('page')=="dailysales" || Session::get('page')=="customers")
                        <?php $active = "active"; ?>
                    @else 
                        <?php $active = ""; ?>
                    @endif
                      <li class=" ">
                          <a href="#sales" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                              </svg>
                              <span class="ml-4">Customers / Sales</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="sales" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                @if(Session::get('page')=="dailysales")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                        <a href="{{url('sales/transaction')}}" class="nav-link  {{ $active }}">
                                            <i class="fas fa-check text-green"></i><span>Daily Sales</span>
                                        </a>
                                </li>
                                @if(Session::get('page')=="customers")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                        <a href="{{url('sales/customers')}}" class="nav-link  {{ $active }}">
                                            <i class="fas fa-users text-blue"></i><span>Customers</span>
                                        </a>
                                </li>
                          </ul>
                      </li>



                    <!-- Sales/Creditors -->

                    @if(Session::get('page')=="creditors" )
                        <?php $active = "active"; ?>
                    @else 
                        <?php $active = ""; ?>
                    @endif
                      <li class=" ">
                          <a href="#creditor" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <!-- <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                              </svg> -->
                              <i class="fas fa-users text-orange"></i>
                              <span class="ml-4">Creditors</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="creditor" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                <!-- @if(Session::get('page')=="dailysales")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                        <a href="{{url('sales/transaction')}}" class="nav-link  {{ $active }}">
                                            <i class="fas fa-check text-green"></i><span>Daily Sales</span>
                                        </a>
                                </li> -->
                                @if(Session::get('page')=="creditors")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                        <a href="{{url('sales/creditors')}}" class="nav-link  {{ $active }}">
                                            <i class="fas fa-users text-blue"></i><span>Creditors</span>
                                        </a>
                                </li>
                          </ul>
                      </li>



                        
                        @if(Session::get('page')=="stocks" || Session::get('page')=="lowstock" || Session::get('page')=="returnedstock" || Session::get('page')=="spoiltgoods" )
                            <?php $active = "active"; ?>
                        @else 
                            <?php $active = ""; ?>
                        @endif
                      <li class=" ">
                          <a href="#stocks" class="collapsed {{ $active }}" data-toggle="collapse" aria-expanded="false">
                                <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                              <span class="ml-4">Stocks</span>
                              <!-- <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg> -->
                              <span class="badge badge-danger ml-2" style="font-size:13px;padding:5px 5px 5px 5px;">{{ $countlowstock }}</span>
                          </a>
                          <ul id="stocks" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            @if(Session::get('page')=="stocks")
                                <?php $active = "active"; ?>
                            @else 
                                <?php $active = ""; ?>
                            @endif
                              <li class="">
                                  <a href="{{ url('sales/stocks') }}" class="nav-link  {{ $active }}">
                                      <i class="fas fa-plus text-green"></i><span>Add Stock</span>
                                  </a>
                              </li>

                            @if(Session::get('page')=="lowstock")
                                <?php $active = "active"; ?>
                            @else 
                                <?php $active = ""; ?>
                            @endif
                              <li class="">
                                  <a href="{{ url('sales/lowstock') }}" class="nav-link  {{ $active }}">
                                      <i class="fas fa-sync-alt text-red"></i><span>Low Stock</span>
                                      <span class="badge badge-danger ml-2" style="font-size:13px;padding:5px 5px 5px 5px;">{{ $countlowstock }}</span>
                                  </a>
                              </li>


                            @if(Session::get('page')=="gaspds")
                                <?php $active = "active"; ?>
                            @else 
                                <?php $active = ""; ?>
                            @endif
                            <li class="">
                                <a href="{{ url('sales/gas_pds') }}" class="nav-link  {{ $active }}">
                                    <i class="fas fa-wine-bottle text-red"></i><span>Gas Pounds</span>
                                </a>
                            </li>


                            @if(Session::get('page')=="returnedstock")
                                <?php $active = "active"; ?>
                            @else 
                                <?php $active = ""; ?>
                            @endif
                              <li class="">
                                  <a href="{{ url('sales/returned_goods') }}" class="nav-link  {{ $active }}">
                                      <i class="fas fa-th-list text-blue"></i><span>Returned Stock(s)</span>
                                  </a>
                              </li>
                            @if(Session::get('page')=="spoiltgoods")
                                <?php $active = "active"; ?>
                            @else 
                                <?php $active = ""; ?>
                            @endif
                              <li class="">
                                  <a href="{{ url('sales/spoilt_goods') }}" class="nav-link  {{ $active }}">
                                      <i class="far fa-circle text-red"></i><span>Spoilt Stock(s)</span>
                                  </a>
                              </li>
                          </ul>
                      </li>



                      <li class="nav-item">
                            <a data-toggle="collapse" href="#stockshop">
                                <i class="fas fa-pen"></i>
                                <span class="ml-3">Temporal Credit</span>
                                <span class="badge badge-danger ml-2" style="font-size:13px;padding:5px 5px 5px 5px;">{{ $goodscounts }}</span>
                                <!-- <span class="badge badge-danger"></span> -->
                            </a>
                            <div class="collapse" id="stockshop">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a class="dropdown-item"  href="{{ url('sales/temp_creditors') }}">
                                            <i class="far fa-circle text-red"> </i> <span class="mr-5">Temporal Credit</span>
                                            <span class="badge badge-danger " style="font-size:13px;padding:5px 5px 5px 5px;">{{ $goodscounts }}</span>
                                            <!-- <span class="badge badge-danger"></span> -->
                                        </a>

                                    </li>
                                </ul>
                            </div>
                        </li>


                    <!-- Suppliers, Bankers -->
                    @if(Session::get('page')=="expenses" )
                        <?php $active = "active"; ?>
                    @else 
                        <?php $active = ""; ?>
                    @endif
                      <li class=" ">
                          <a href="#expenses" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                              </svg>
                              <span class="ml-4">Expenses</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="expenses" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                @if(Session::get('page')=="expenses")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                        <a href="{{ url('/sales/daily_expenses') }}" class="nav-link  {{ $active }}">
                                            <i class="fas fa-hand-holding-usd text-red"></i><span>Daily Expenses</span>
                                        </a>
                                </li>


                                @if(Session::get('page')=="prevexpenses")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                        <a href="{{ url('/sales/expenses_made') }}" class="nav-link  {{ $active }}">
                                            <i class="fas fa-hand-holding-usd text-blue"></i><span>Previous Expenses</span>
                                        </a>
                                </li>
                                
                                
                                @if(Session::get('page')=="susu")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                        <a href="{{ url('/sales/daily_susu') }}" class="nav-link  {{ $active }}">
                                            <i class="fas fa-hand-holding-usd text-green"></i><span>Daily SuSu</span>
                                        </a>
                                </li>
                          </ul>
                      </li>



                      

                        <!-- Sales Transaction, Bankers -->
                        @if(Session::get('page')=="dailyreport" || Session::get('page')=="monthlylyreport" )
                            <?php $active = "active"; ?>
                        @else 
                            <?php $active = ""; ?>
                        @endif
                        <li class=" ">
                            <a href="#salestrans" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                                <span class="ml-4">Sales Transaction</span>
                                <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                            </a>
                                <ul id="salestrans" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                    @if(Session::get('page')=="dailyreport")
                                        <?php $active = "active"; ?>
                                    @else 
                                        <?php $active = ""; ?>
                                    @endif
                                    <li class="">
                                        <a href="{{ url('/sales/sales_trans') }}" class="nav-link  {{ $active }}">
                                            <i class="fab fa-buffer text-red"></i><span>Daily Sales Transaction</span>
                                        </a>
                                    </li>
                                    @if(Session::get('page')=="monthlyreport")
                                        <?php $active = "active"; ?>
                                    @else 
                                        <?php $active = ""; ?>
                                    @endif
                                    <li class="">
                                        <a href="{{ url('/sales/monthly_trans') }}" class="nav-link  {{ $active }}">
                                            <i class="fab fa-buffer text-blue"></i><span>Monthly Sales Transaction</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <!-- Cash Book -->
                            <li class="active">
                                <a href="{{ url('sales/cashbook') }}" class="svg-icon ">                        
                                    <svg  class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
                                    </svg>
                                    <span class="ml-4">Cash Book</span>
                                </a>
                            </li>

                      


                            <li class=" ">
                                <a href="#reports" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                        <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                        <span class="ml-4">Reports</span>
                                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                        </svg>
                                </a>
                                <ul id="reports" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                        <li class="">
                                                <a href="#viewReport" data-toggle="modal" data-target="#viewReport" data-backdrop="static">
                                                    <i class="fas fa-folder-open text-blue"></i><span>Daily Reports</span>
                                                </a>
                                        </li>
                                        <li class="">
                                                <a href="#viewReport" data-toggle="modal" data-target="#viewReport" data-backdrop="static">
                                                    <i class="fas fa-folder-open text-blue"></i><span>Monthly Reports</span>
                                                </a>
                                        </li>
                                        <li class="">
                                                <a href="#viewReport" data-toggle="modal" data-target="#viewReport" data-backdrop="static">
                                                    <i class="fas fa-folder-open text-blue"></i><span>Yearly Reports</span>
                                                </a>
                                        </li>
                                        <li class="">
                                                <a href="#viewReport" data-toggle="modal" data-target="#viewReport" data-backdrop="static">
                                                    <i class="fas fa-folder-open text-blue"></i><span>Inventory</span>
                                                </a>
                                        </li>
                                        
                                </ul>
                            </li>
                                @if(Session::get('page')=="settings")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                            <li class=" ">
                                <a href="#settings" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                        <svg class="svg-icon" id="p-dash19" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                                        </svg>
                                    <span class="ml-4">Settings</span>
                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                    </svg>
                                </a>
                                <ul id="settings" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                        
                                        <!-- <li class=" ">
                                            <a href="#" >
                                                <svg class="svg-icon" id="p-dash17" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line>
                                                </svg>
                                                <span class="ml-4">Update Profile</span>
                                                
                                            </a>
                                        </li> -->
                                        <li class="">
                                                <a href="{{ url('sales/view_price_list') }}">
                                                    <!-- <svg class="svg-icon" id="p-dash18" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline>
                                                    </svg> -->

                                                    <span class="ml-4"> <i class="fas fa-eye text-orange"></i>View Price List</span>
                                                </a>
                                        </li>
                                        <li class="">
                                                <a href="{{ url('sales/account_settings') }}">
                                                    <!-- <svg class="svg-icon" id="p-dash18" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline>
                                                    </svg> -->

                                                    <span class="ml-4"> <i class="fas fa-lock text-blue"></i>Update Password</span>
                                                </a>
                                        </li>
                                        <li class=" ">
                                            <a href="#maintenance" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                                    <svg class="svg-icon" id="p-dash19" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
                                                    </svg>
                                                    <span class="ml-4">Maintenance</span>
                                                    <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                                    </svg>
                                            </a>
                                            <ul id="maintenance" class="iq-submenu collapse" data-parent="#settings">
                                                    
                                                    <li class="">
                                                        <a href="#">
                                                        <i class="fas fa-folder-open text-blue"></i><span>Backup Files</span>
                                                        </a>
                                                    </li>
                                                    <li class="">
                                                        <a href="#">
                                                        <i class="fas fa-folder-open text-blue"></i><span>Restore Files</span>
                                                        </a>
                                                    </li>
                                            </ul>
                                        </li>
                                </ul>
                            </li>
                  </ul>
              </nav>
              
              <div class="p-3"></div>
          </div>
      </div>  