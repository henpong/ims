@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/customers') }}"><i class="ri-user-line mr-1 float-left"></i>Customers</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/branches') }}"><i class="ri-home-4-line mr-1 float-left"></i>Branches</a></li>
            <li class="breadcrumb-item active" aria-current="page">Warehouses</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">
           
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                  <h4 class="card-title mb-3"><i class="nav-icon fas fa-home text-blue"> </i> Warehouses</h4>
                </div>
                <button type="button" class="btn btn-primary btn-sm add-list" data-toggle="modal" data-target="#addWarehouse" title="Add New Warehouse"><i class="fas fa-plus"> </i> Add</button>
                <!-- <a href="{{url('/admin/add_edit_warehouse')}}" class="btn btn-primary btn-sm add-list" data-toggle="tooltip" data-placement="top" data-original-title="Add New Warehouse" title=""><i class="fas fa-plus mr-3"></i>Add </a> -->
            </div>
      
            <div class="card-body">


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


             <p class="mb-0">You can ADD and View all WAREHOUSES</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="sections" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Warehouse Name</th>
                            <th>Warehouse Location</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                      @foreach($warehouses as $house)
                      <tr >
                          <td>
                              <div class="checkbox d-inline-block">
                                  <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                  <label for="checkdelete" class="mb-0"></label>
                              </div>
                          </td>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$house->name}}</td>
                          <td>{{$house->location}}</td>
                          <td>
                              @if($house->warehouse_status == 1)
                                  <a class="updateWarehouseStatus" id="warehouse-{{ $house->id }}" warehouse_id="{{ $house->id }}" href="javascript:void(0)" style="color:#007bff">Active</a>
                              @else
                                  <a class="updateWarehouseStatus" id="warehouse-{{ $house->id }}" warehouse_id="{{ $house->id }}" href="javascript:void(0)" style="color:#ff0000">Inactive</a>
                                
                              @endif
                            
                          </td>
                          <td>
                          <div class="d-flex align-items-center list-action">
                              <a class="mr-3" data-toggle="tooltip" data-placement="top" data-original-title="Update Warehouse"
                                  href="{{ url('admin/add_edit_warehouse/'.$house->id )}}"><i class="far fa-edit text-blue" style="font-size:20px;"></i></a>
                              <a class="ml-2 confirmDelete" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Warehouse"
                                  href="javascript:void(0)" record="warehouse" recordid="{{ $house->id }}"><i class="fas fa-trash-alt mr-0 text-red" style="font-size:20px;"></i></a>
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
                            <th>Warehouse Name</th>
                            <th>Warehouse Location</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              


  @include('layouts.admin.warehouse.modal.add_warehouse')
@endsection