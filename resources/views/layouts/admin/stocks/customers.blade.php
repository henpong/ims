@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/stock_request') }}"><i class="ri-notification-line mr-1 float-left"></i>Stock Request</a></li>
            <li class="breadcrumb-item active" aria-current="page">Customers</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">
                <!-- Display Error Messages In a Loop -->
                @if ($errors->any())
                  <div class="alert alert-danger" style="margin:20px;width:40%;">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i> Customers</h4>
                     </div>
                     <!-- <a href="#" class="btn btn-primary add-list"><i class="fas fa-plus mr-3"></i>Add </a> -->
                  </div>
           
            <div class="card-body">

             <p class="mb-0">This is where you check all CUSTOMERS served by users.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="customers" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Shop Attendant</th>
                            <th>Branch Name</th>
                            <th>Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                      @foreach($customers as $customer)
                            <tr >
                                <td>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                        <label for="checkdelete" class="mb-0"></label>
                                    </div>
                                </td>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$customer->fullname}}</td>
                                <td>{{$customer->customer_address}}</td>
                                <td>{{$customer->customer_contact}}</td>
                                <td></td>
                                <td></td>
                                <td>{{date("jS F, Y  ", strtotime($customer->created_at))}}</td>
                              </tr>
                          @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Shop Attendant</th>
                            <th>Branch Name</th>
                            <th>Transaction Date</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              

@endsection