
  <div class="iq-sidebar  sidebar-default ">
            <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
              <a href="{{url('/admin/dashboard')}}" class="header-logo">
                  <img src="{{url('backend/img/logo.jpg')}}" class="img-fluid rounded-normal light-logo" alt="logo" onContextMenu="return false;" style="width:140px;height:70px;margin-top:25px;">
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
                          <a href="{{url('/admin/dashboard')}}" class="svg-icon ">                        
                              <svg  class="svg-icon" id="p-dash1" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line>
                              </svg>
                              <span class="ml-4">Dashboard</span>
                          </a>
                      </li>

                      

                        <!-- Cash book -->
                        @if(Session::get('page')=="cashbook" )
                            <?php $active = "active"; ?>
                        @else 
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                                <a href="{{url('admin/cashbook')}}" class="svg-icon nav-link {{ $active }}">  
                                    <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                        <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                    </svg>

                                    <span class="ml-4">Cash Book</span>
                            
                            </a>
                        </li>

                        
                        <!-- Stock Request -->
                        @if(Session::get('page')=="stockrequest" )
                            <?php $active = "active"; ?>
                        @else 
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                                <a href="{{url('admin/stock_request')}}" class="svg-icon nav-link {{ $active }}">                        
                                    <svg class="svg-icon" id="p-dash6" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 14 10 14 10 20"></polyline><polyline points="20 10 14 10 14 4"></polyline><line x1="14" y1="10" x2="21" y2="3"></line><line x1="3" y1="21" x2="10" y2="14"></line>
                                    </svg>
                                
                                
                                <?php

                                    use App\Models\StockRequest;
                                    //Count Number of Pending Requests In The Stock Request Table
                                    $countRequest = StockRequest::where('request_status','Pending')->where('del_id',1)->count();
                                    //echo "<pre>"; print_r($countRequest); die;

                                    ?>

                                    <span class="ml-4">Stock Request</span>
                                    
                                    <span class="badge badge-danger ml-2" style="font-size:13px;padding:5px 5px 5px 5px;"> {{ $countRequest }} </span>
                            
                            </a>
                        </li>
                        <!-- Temporal Credit -->
                        @if(Session::get('page')=="tempcredit" )
                            <?php $active = "active"; ?>
                        @else 
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                                <a href="{{url('admin/temporal_credit')}}" class="svg-icon nav-link {{ $active }}">                        
                                    <svg class="svg-icon" id="p-dash6" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 14 10 14 10 20"></polyline><polyline points="20 10 14 10 14 4"></polyline><line x1="14" y1="10" x2="21" y2="3"></line><line x1="3" y1="21" x2="10" y2="14"></line>
                                    </svg>
                                
                                
                                    <?php

                                    use App\Models\TemporalCredit;
                                    //Count Number of Temporal Credits Not Paid In The Temporal Credit Table
                                    $allgoodscounts = TemporalCredit::allgoodscounts();
                                    // echo "<pre>"; print_r($allgoodscounts); die;

                                    ?>

                                <span class="ml-4">Temporal Credit</span>
                                
                                <span class="badge badge-danger ml-2" style="font-size:13px;padding:5px 5px 5px 5px;">  {{ $allgoodscounts }}  </span>
                            
                            </a>
                        </li>
                        <!-- Credit Request -->
                        @if(Session::get('page')=="creditrequest" )
                            <?php $active = "active"; ?>
                        @else 
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                                <a href="{{url('admin/credit_requests')}}" class="svg-icon nav-link {{ $active }}">                        
                                    <svg class="svg-icon" id="p-dash6" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 14 10 14 10 20"></polyline><polyline points="20 10 14 10 14 4"></polyline><line x1="14" y1="10" x2="21" y2="3"></line><line x1="3" y1="21" x2="10" y2="14"></line>
                                    </svg>
                                
                                
                                <?php

                                    use App\Models\Customers;
                                    //Count Number of Temporal Credits Not Paid In The Temporal Credit Table
                                    $countCredit = Customers::where('credit_status','Pending')->where('status',2)->count();
                                    //echo "<pre>"; print_r($countCredit); die;

                                    ?>

                                    <span class="ml-4">Credit Request</span>
                                    
                                    <span class="badge badge-danger ml-2" style="font-size:13px;padding:5px 5px 5px 5px;"> {{ $countCredit }} </span>
                            
                            </a>
                        </li>


                        

                        <!-- Spoilt Goods -->
                        @if(Session::get('page')=="spoiltgoods" )
                            <?php $active = "active"; ?>
                        @else 
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                                <a href="{{url('admin/spoilt_goods')}}" class="svg-icon nav-link {{ $active }}">                        
                                    <svg class="svg-icon" id="p-dash6" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 14 10 14 10 20"></polyline><polyline points="20 10 14 10 14 4"></polyline><line x1="14" y1="10" x2="21" y2="3"></line><line x1="3" y1="21" x2="10" y2="14"></line>
                                    </svg>
                                
                                
                                <?php

                                    use App\Models\SpoiltGoods;
                                    // Get All Spoilt Goods From The Soilt Goods Table
                                    $spoiltGoods = SpoiltGoods::with('products')->where('spoilt_status',1)->where('check_status',1)->count();
                                    // echo "<pre>"; print_r($spoiltGoods); die;

                                ?>

                                    <span class="ml-4">Spoilt Goods</span>
                                    
                                    <span class="badge badge-danger ml-2" style="font-size:13px;padding:5px 5px 5px 5px;"> {{ $spoiltGoods }} </span>
                            
                            </a>
                        </li>
                        
                      
                        <!-- Gas Pounds -->
                        @if(Session::get('page')=="gaspds" )
                            <?php $active = "active"; ?>
                        @else 
                            <?php $active = ""; ?>
                        @endif
                        <li class="nav-item">
                                <a href="{{url('admin/gas_pds_shops')}}" class="svg-icon nav-link {{ $active }}">                        
                                    <svg class="svg-icon" id="p-dash6" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 14 10 14 10 20"></polyline><polyline points="20 10 14 10 14 4"></polyline><line x1="14" y1="10" x2="21" y2="3"></line><line x1="3" y1="21" x2="10" y2="14"></line>
                                    </svg>
                                
                                
                                <?php

                                    use App\Models\Products;
                                    // Count Number of Gas Pds Without Price In The Products Table
                                    $countGasPdsWithoutPrice = Products::where('product_wholesale_price','0.00')->where('product_price','0.00')->where('main_warehouse_id','0')->count();
                                    // echo "<pre>"; print_r($countGasPdsWithoutPrice); die;

                                ?>

                                    <span class="ml-4">Gas Pounds</span>
                                    
                                    <span class="badge badge-danger ml-2" style="font-size:13px;padding:5px 5px 5px 5px;"> {{ $countGasPdsWithoutPrice }} </span>
                            
                            </a>
                        </li>
                        
                   
                        
                        @if(Session::get('page')=="branches" || Session::get('page')=="sections" || Session::get('page')=="categories" || Session::get('page')=="brands" || Session::get('page')=="units" )
                            <?php $active = "active"; ?>
                        @else 
                            <?php $active = ""; ?>
                        @endif
                      <li class=" ">
                          <a href="#catalogue" class="collapsed {{ $active }}" data-toggle="collapse" aria-expanded="false">
                                <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                </svg>
                              <span class="ml-4">Catalogue</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="catalogue" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            @if(Session::get('page')=="branches")
                                <?php $active = "active"; ?>
                            @else 
                                <?php $active = ""; ?>
                            @endif
                              <li class="">
                                  <a href="{{url('admin/branches')}}" class="nav-link  {{ $active }}">
                                      <i class="fas fa-home text-blue"></i><span>Branches</span>
                                  </a>
                              </li>

                            @if(Session::get('page')=="sections")
                                <?php $active = "active"; ?>
                            @else 
                                <?php $active = ""; ?>
                            @endif
                              <li class="">
                                  <a href="{{url('admin/sections')}}" class="nav-link  {{ $active }}">
                                      <i class="fab fa-buffer text-orange"></i><span>Sections</span>
                                  </a>
                              </li>

                            @if(Session::get('page')=="categories")
                                <?php $active = "active"; ?>
                            @else 
                                <?php $active = ""; ?>
                            @endif
                              <li class="">
                                  <a href="{{url('admin/categories')}}" class="nav-link  {{ $active }}">
                                  <i class="fas fa-chart-pie text-green"></i></i><span>Categories</span>
                                  </a>
                              </li>
                              @if(Session::get('page')=="brands")
                                <?php $active = "active"; ?>
                            @else 
                                <?php $active = ""; ?>
                            @endif
                              <li class="">
                                  <a href="{{url('admin/brands')}}" class="nav-link  {{ $active }}">
                                      <i class="fas fa-coins text-orange"></i><span>Brands</span>
                                  </a>
                              </li>
                              @if(Session::get('page')=="units")
                                <?php $active = "active"; ?>
                            @else 
                                <?php $active = ""; ?>
                            @endif
                              <li class="">
                                  <a href="{{url('admin/units')}}" class="nav-link  {{ $active }}">
                                  <i class="fas fa-hockey-puck"></i><span>Units</span>
                                  </a>
                              </li>
                            @if(Session::get('page')=="warehouse")
                                <?php $active = "active"; ?>
                            @else 
                                <?php $active = ""; ?>
                            @endif
                              <li class="">
                                  <a href="{{url('admin/warehouses')}}" class="nav-link  {{ $active }}">
                                      <i class="fas fa-home text-blue"></i><span>Create Warehouse</span>
                                  </a>
                              </li>
                          </ul>
                      </li>



                      <!-- Customers/Creditors -->

                    @if(Session::get('page')=="customers" || Session::get('page')=="creditors" || Session::get('page')=="distributors")
                        <?php $active = "active"; ?>
                    @else 
                        <?php $active = ""; ?>
                    @endif
                      <li class=" ">
                          <a href="#customers" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <svg class="svg-icon" id="p-dash8" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                              <span class="ml-4" style="font-size:15px">Customers / Creditors</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="customers" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                @if(Session::get('page')=="customers")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                        <a href="{{url('/admin/customers')}}" class="nav-link  {{ $active }}">
                                            <i class="fas fa-users text-blue"></i><span>Customers</span>
                                        </a>
                                </li>
                                @if(Session::get('page')=="creditors")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                        <a href="{{url('admin/creditors')}}" class="nav-link  {{ $active }}">
                                            <i class="fas fa-users text-orange"></i><span>Creditors</span>
                                        </a>
                                </li>
                                @if(Session::get('page')=="distributors")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                        <a href="{{url('admin/big_customers')}}" class="nav-link  {{ $active }}">
                                            <i class="fas fa-user-tie text-green"></i><span>Big Customers</span>
                                        </a>
                                </li>
                          </ul>
                      </li>



                    <!-- Suppliers, Bankers -->
                    @if(Session::get('page')=="suppliers" || Session::get('page')=="bankers")
                        <?php $active = "active"; ?>
                    @else 
                        <?php $active = ""; ?>
                    @endif
                      <li class=" ">
                          <a href="#suppliers" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash3" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                              </svg>
                              <span class="ml-4">Suppliers / Bankers</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="suppliers" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                @if(Session::get('page')=="suppliers")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                        <a href="{{url('admin/suppliers')}}" class="nav-link  {{ $active }}">
                                            <i class="fas fa-user-tie text-blue"></i><span>Suppliers</span>
                                        </a>
                                </li>
                                @if(Session::get('page')=="bankers")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                        <a href="{{url('admin/bankers')}}" class="nav-link  {{ $active }}">
                                            <i class="fas fa-home text-orange"></i><span>Bankers</span>
                                        </a>
                                </li>
                          </ul>
                      </li>
                        @if(Session::get('page')=="mainwarehouse" || Session::get('page')=="products" )
                            <?php $active = "active"; ?>
                        @else 
                            <?php $active = ""; ?>
                        @endif
                      <li class=" ">
                          <a href="#warehouse" class="collapsed" data-toggle="collapse" aria-expanded="false">
                              <svg class="svg-icon" id="p-dash4" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                              </svg>
                              <span class="ml-4">Warehouses/Product</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="warehouse" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                @if(Session::get('page')=="mainwarehouse")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                  <li class="">
                                          <a href="{{url('admin/mainwarehouse')}}" class="nav-link  {{ $active }}">
                                              <i class="fas fa-home text-blue"></i><span>Warehouse</span>
                                          </a>
                                  </li>
                                
                                @if(Session::get('page')=="products")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                    <a href="{{url('admin/products')}}" class="nav-link  {{ $active }}">
                                    <i class="fas fa-database"></i><span>Products In Shops</span>
                                    </a>
                                </li>
                                   
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#sales" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span class="ml-4">Sales Transactions</span>
                                <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                          </a>
                          <ul id="sales" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="">
                                          <a href="{{ url('admin/daily_sales') }}">
                                            <i class="fas fa-book text-orange"></i><span>Daily Sales</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="{{ url('admin/monthly_sales') }}">
                                            <i class="fas fa-book"></i><span>Monthly Sales</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="#">
                                            <i class="fas fa-book text-blue"></i><span>Yearly Sales</span>
                                          </a>
                                  </li>
                                  
                          </ul>
                      </li>
                      </li>
                      <li class=" ">
                            <a href="#expenses" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                                <span class="ml-4">Expenses</span>
                                <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                </svg>
                            </a>
                            <ul id="expenses" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="">
                                          <a href="{{ url('admin/shops_daily_expenses') }}">
                                            <i class="fas fa-book text-orange"></i><span>Daily Expenses</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="{{ url('admin/shops_monthly_expenses') }}">
                                            <i class="fas fa-book"></i><span>Monthly Expenses</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="#">
                                            <i class="fas fa-book text-blue"></i><span>Yearly Expenses</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="#">
                                            <i class="fas fa-book text-orange"></i><span>Daily Susu</span>
                                          </a>
                                  </li>
                                  
                            </ul>
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
                                          <a href="#">
                                              <i class="fas fa-folder-open text-green"></i><span>Daily Reports</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="#">
                                              <i class="fas fa-folder-open text-blue"></i><span>Monthly Reports</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="#">
                                              <i class="fas fa-folder-open text-orange"></i><span>Yearly Reports</span>
                                          </a>
                                  </li>
                                  <li class="">
                                          <a href="#">
                                              <i class="fas fa-folder-open "></i><span>Balance Sheet</span>
                                          </a>
                                  </li>
                                  
                          </ul>
                      </li>
                        @if(Session::get('page')=="settings" || Session::get('page')=="users")
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
                                  
                                  <li class="">
                                      <a href="{{url('admin/admins')}}" class="svg-icon">
                                            <i class="fas fa-users text-green"></i><span class="ml-4">Admin Users</span>
                                      </a>
                                  </li>
                                  
                                @if(Session::get('page')=="users")
                                    <?php $active = "active"; ?>
                                @else 
                                    <?php $active = ""; ?>
                                @endif
                                <li class="">
                                    <a href="{{url('admin/users')}}" class="nav-link  {{ $active }}">
                                        <i class="fas fa-users text-blue"></i><span class="ml-4">Users</span>
                                    </a>
                                </li>
                                  <li class=" ">
                                      <a href="{{url('admin/update_admin_details')}}" >
                                        <i class="fas fa-user text-orange"></i><span class="ml-4">Update Profile</span>
                                      </a>
                                  </li>
                                  <li class="">
                                          <a href="{{url('admin/settings')}}">
                                            <i class="fas fa-user-lock"></i><span class="ml-4">Update Password</span>
                                          </a>
                                  </li>
                                  <li class=" ">
                                      <a href="#maintenance" class="collapsed" data-toggle="collapse" aria-expanded="false">
                                            <i class="fas fa-cogs text-blue"></i><span class="ml-4">Maintenance</span>
                                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                                            </svg>
                                      </a>
                                      <ul id="maintenance" class="iq-submenu collapse" data-parent="#settings">
                                              <li class="">
                                                  <a href="">
                                                    <i class="fas fa-database"></i><span>History</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="">
                                                  <i class="fas fa-folder-open text-green"></i><span>Backup Files</span>
                                                  </a>
                                              </li>
                                              <li class="">
                                                  <a href="">
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