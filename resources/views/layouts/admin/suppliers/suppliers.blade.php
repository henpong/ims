@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}"><i class="ri-notification-line mr-1 float-left"></i>Products</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/users') }}"><i class="ri-users-4-line mr-1 float-left"></i>Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Suppliers</li>
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
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i>  Suppliers</h4>
                     </div>
                     <button type="button" class="btn btn-primary btn-sm add-list" data-toggle="modal" data-target="#addSupplier" title="Add New Supplier"><i class="fas fa-plus"> </i> Add</button>
                     <!-- <a href="{{url('/admin/add_edit_supplier')}}" class="btn btn-primary btn-sm add-list" data-toggle="tooltip" data-placement="top" data-original-title="Add New Supplier"><i class="fas fa-plus mr-3"></i>Add </a> -->
                  </div>
           
            <div class="card-body">

             <p class="mb-0">You can ADD and View all Suppliers</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="suppliers" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Supplier's Name</th>
                            <th>Supplier's Address</th>
                            <th>Supplier's Phone</th>
                            <th>Supplier's Country</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                    @foreach($getSuppliers as $supply)
                      <tr >
                          <td>
                              <div class="checkbox d-inline-block">
                                  <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                  <label for="checkdelete" class="mb-0"></label>
                              </div>
                          </td>
                          
                          <td>{{$loop->iteration}}</td>
                          <td>{{$supply->supplier_name}}</td>
                          <td>{{$supply->supplier_address}}</td>
                          <td>{{$supply->supplier_contact}}</td>
                          <td>{{$supply->supplier_country}}</td>
                          <td>@if($supply->supplier_status == 1)
                                <a class="updateSupplierStatus" id="supplier-{{ $supply->id }}" supplier_id="{{ $supply->id }}" href="javascript:void(0)" style="color:#007bff">Active</a>
                              @else
                                <a class="updateSupplierStatus" id="supplier-{{ $supply->id }}" supplier_id="{{ $supply->id }}" href="javascript:void(0)" style="color:#ff0000">Inactive</a>
                              @endif
                          </td>
                          <td>
                            <div class="d-flex align-items-center list-action">
                                <a class="mr-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update Supplier"
                                    href="{{ url('admin/add_edit_supplier/'.$supply->id )}}"><i class="far fa-edit" style="font-size:20px;"></i></a>
                                <!-- <a class="ml-2 confirmDelete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Supplier"
                                    href="javascript:void(0)" record="supplier" recordid="{{ $supply->id }}"><i class="ri-delete-bin-line mr-0 text-red" style="font-size:20px;"></i></a> -->
                            </div>

                          
                          </td>
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
                            <th>Supplier's Name</th>
                            <th>Supplier's Address</th>
                            <th>Supplier's Phone</th>
                            <th>Supplier's Country</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              


    @include('layouts.admin.suppliers.modal.add_supplier')
@endsection