@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}"><i class="ri-notification-line mr-1 float-left"></i>Categories</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}"><i class="ri-notification-line mr-1 float-left"></i>Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Warehouse</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">
               
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                  <h4 class="card-title mb-3"><i class="nav-icon fas fa-home text-blue"> </i> Warehouse</h4>
                </div>
                <button type="button" class="btn btn-primary btn-sm add-list" data-toggle="modal" data-target="#AddWarehouseProduct" title="Add Product In Warehouse"><i class="fas fa-plus"> </i> Add</button>
                <!-- <a href="{{url('/admin/add_edit_mainwarehouse')}}" class="btn btn-primary btn-sm add-list" data-toggle="tooltip" data-placement="top" data-original-title="Add New Warehouse"><i class="fas fa-plus mr-3"></i>Add </a> -->
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

             <p class="mb-0">You can ADD and View all WAREHOUSE</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="products" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Unit</th>
                            <th>Brand</th>
                            <th>Category Name</th>
                            <th>Supplier Name</th>
                            <th>Total Qty<br> Avail.(Ctns)</th>
                            <th>Add. Qty(pcs)</th>
                            <th>Total Qty<br> Avail.(PCS)</th>
                            <th>Qty (Ctns)</th>
                            <th>Unit Cost (GHC)</th>
                            <th>Low Stock</th>
                            <th>Warehouse</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                    @foreach($mainwarehouses as $mainwarehouse)
                      <tr >
                          <td>{{$loop->iteration}}</td>
                          <td>{{$mainwarehouse->product_code}}</td>
                          <td>{{$mainwarehouse->main_product_name}}</td>
                          <td>{{$mainwarehouse->unitname->unit_name}}</td>
                          <td>{{$mainwarehouse->brandname->brand_name}}</td>
                          <td>{{$mainwarehouse->categoryname->category_name}}</td>
                          <td>{{$mainwarehouse->suppliername->supplier_name}}</td>
                          <td>{{$mainwarehouse->newprod_qtyctn}}</td>
                          <td>{{$mainwarehouse->addprod_qtypcs}}</td>
                          <td>{{$mainwarehouse->total_prodqtypcs}}</td>
                          <td>{{$mainwarehouse->qtybox}}</td>
                          <td>{{number_format($mainwarehouse->prodcost,2)}}</td>
                          <td>{{$mainwarehouse->lowstock_point}}</td>
                          <td>{{$mainwarehouse->warehousename->name}}</td>
                          <td>
                              @if($mainwarehouse->status==1)
                                <a class="updateMainWarehouseStatus" id="mainwarehouse-{{ $mainwarehouse->id }}" mainwarehouse_id="{{ $mainwarehouse->id }}" href="javascript:void(0)" style="color:#007bff">Active</a>
                              @else
                                <a class="updateMainWarehouseStatus" id="mainwarehouse-{{ $mainwarehouse->id }}" mainwarehouse_id="{{ $mainwarehouse->id }}" href="javascript:void(0)" style="color:#ff0000">Inactive</a>
                              @endif
                          </td>
                          <td>
                          <div class="d-flex align-items-center list-action">
                              <a class="mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update Product"
                                  href="{{ url('admin/add_edit_mainwarehouse/'.$mainwarehouse->id )}}"><i class="far fa-edit text-green" style="font-size:20px;"></i></a>
                              <a class="mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Product Added Transaction"
                                  href="{{ url('admin/view_product_transaction_mainwarehouse/'.$mainwarehouse->id )}}"><i class="far fa-eye text-orange" style="font-size:20px;"></i></a>
                              <a class="mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Add New Order"
                                  href="{{ url('admin/add_new_order/'.$mainwarehouse->id )}}"><i class="fas fa-pen text-green" style="font-size:20px;"></i></a>
                              <a class="mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Product Taken Transaction"
                                  href="{{ url('admin/view_product_taken_transaction/'.$mainwarehouse->id )}}"><i class="fas fa-share-square text-blue" style="font-size:20px;"></i></a>
                              <a class="mr-2" data-toggle="tooltip" data-placement="top" title="View Product Sold Transaction" data-original-title="View Product Sold Transaction"
                                  href="{{ url('admin/view_product_sold_transaction/'.$mainwarehouse->id )}}"><i class="fas fa-hat-cowboy text-red" style="font-size:20px;"></i></a>
                              <a class="confirmDelete ml-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Product"
                                  href="javascript:void(0)" record="mainwarehouse" recordid="{{ $mainwarehouse->id }}"><i class="fas fa-trash-alt mr-0 text-red" style="font-size:20px;"></i></a>
                          </div>

                          
                          </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Unit</th>
                            <th>Brand</th>
                            <th>Category Name</th>
                            <th>Supplier Name</th>
                            <th>Total Qty<br> Avail.(Ctns)</th>
                            <th>Add. Qty(pcs)</th>
                            <th>Total Qty<br> Avail.(PCS)</th>
                            <th>Qty (Ctns)</th>
                            <th>Unit Cost (GHC)</th>
                            <th>Low Stock</th>
                            <th>Warehouse</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              

    @include('layouts.admin.mainwarehouse.modal.add_mainwarehouse')
@endsection