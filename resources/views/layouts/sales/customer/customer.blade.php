@extends('layouts.salesLayout.sales_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/transaction') }}"><i class="ri-notification-line mr-1 float-left"></i>New Transaction</a></li>
            <li class="breadcrumb-item active" aria-current="page">Customers</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">


            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i> Customers</h4>
                </div>
                <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#printModal" data-backdrop="static" title="Re-print Customer's Receipt" style="font-size:15px;width:120px;height;30px">
                    <i class="fas fa-print mr-2"> </i> Re-Print 
                </button>
                <!-- <a data-toggle="modal" data-target="#printModal" data-backdrop="static" class="btn btn-sm btn-primary"><i class="fas fa-print mr-3"></i>Re-Print </a> -->
            </div>
           
            <div class="card-body">

             <p class="mb-0">This is where you check all CUSTOMERS you have served.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="customers" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Customer's Address</th>
                            <th>Phone Number</th>
                            <th>Company Name</th>
                            <th>Shop Attendant</th>
                            <th>Branch Name</th>
                            <th>Transaction Date</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                      @foreach($customers as $customer)
                            <tr >                                
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$customer->fullname}}</td>
                                    <td>{{$customer->customer_address}}</td>
                                    <td>{{$customer->customer_contact}}</td>
                                    <td>{{$customer->company}}</td>
                                    <td> {{ Auth::guard('user')->user()->name }}</td>
                                    <td>{{$customer->branch->branch_name}} </td>
                                    <td>{{date("jS F, Y  ", strtotime($customer->created_at))}}</td>
                                    <td>
                                        
                                        <a  href="javascript:void(0)" title="Delete Customer" data-toggle="modal" data-target="#deleteCustomer{{ $customer->id }}" data-backdrop="static"> <i class="fas fa-trash text-red"></i> </a>
                                    </td>
                              </tr>


                                    <!-- Delete Customer -->
                                    <div class="modal fade" id="deleteCustomer{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCustomer" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteCustomer"><i class="fas fa-trash text-red"></i> DELETE CUSTOMER</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true" style="color: #ff0000;">×</span>
                                                    </button>
                                                </div>


                                                    <div class="modal-body m-3" style="max-height:450px; overflow:auto;">

                                                        

                                                        <div class="col-12">
                                                            <p>
                                                                Ooooh why do you want to delete me ?<br>
                                                                Sorry I won't allow you to delete me.  Press "OK" to go back.
                                                            </p>
                                                        </div>
                                                        
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                                                            <i class="fas fa-times text-white"> </i> &nbsp;&nbsp;
                                                            OK
                                                        </button>
                                                    </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Delete Customer -->
                          @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Customer's Address</th>
                            <th>Phone Number</th>
                            <th>Company Name</th>
                            <th>Shop Attendant</th>
                            <th>Branch Name</th>
                            <th>Transaction Date</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              

  @include('layouts.sales.customer.modal.customer_print')
@endsection