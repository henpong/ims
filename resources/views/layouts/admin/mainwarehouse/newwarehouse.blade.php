@extends('layouts.adminLayout.admin_design')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!-- <div class="col-sm-6">
            <h1 class="m-0 text-dark"><i class="nav-icon fas fas fa-sync-alt fa-spin text-red"></i> Low Stock Request</h1>
          </div> -->
          <div class="col-sm-12 text-right">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{url('/admin/settings')}}">Password Settings</a></li>
              <li class="breadcrumb-item"><a href="{{url('/admin/products')}}">Products</a></li>
              <li class="breadcrumb-item active"> New / House Warehouse</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>


<div class="col-sm-12">

        <!-- Display Error Messages In a Loop -->
        <!-- <div class="container-fluid">  -->

          @if ($errors->any())
            <div class="alert alert-danger" style="margin-top:10px;">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

    <div class="card card-primary">
      <div class="card-header d-flex justify-content-between">
          <div class="header-title">
            <h4 class="card-title"><i class="nav-icon fas fa-file-archive "></i> Data In New/House Warehouse</h4>

            <!--Add & Edit Main Warehouse to Database --> 
                
            <a href="{{url('/admin/add_edit_mainwarehouse')}}" class="btn btn-sm btn-default" style="float:right;color:blue;"> 
                <i class="fas fa-plus" > </i> New Product </a>
          </div>
      </div>
      <div class="card-body">
          <!-- <p>Images in Bootstrap are made responsive with <code>.img-fluid</code>. <code>max-width: 100%;</code> and <code>height: auto;</code> are applied to the image so that it scales with the parent element.</p> -->
        <div class="table-responsive">
        <table id="mainwarehouse" class="table table-bordered table-striped table-hover table-condensed">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th>Supplier Name</th>
                    <th>Tot Qty Avail.(Ctns/Cylns)</th>
                    <th>Add. Qty(pcs)</th>
                    <th>Tot Qty Avail.(PCS)</th>
                    <th>Qty (Ctns)</th>
                    <th>Low Stock</th>
                    <th>Warehouse</th>
                    <th>Status</th>
                    <th>Options</th>
                </tr>
                </thead>

                <tbody>
                @foreach($newwarehouses as $newwarehouse)
                  
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$newwarehouse->product_code}}</td>
                      <td>{{$newwarehouse->main_product_name}}</td>
                      <td>{{$newwarehouse->categoryname->category_name}}</td>
                      <td>{{$newwarehouse->suppliername->supplier_name}}</td>
                      <td>{{$newwarehouse->newprod_qtyctn}}</td>
                      <td>{{$newwarehouse->addprod_qtypcs}}</td>
                      <td>{{$newwarehouse->total_prodqtypcs}}</td>
                      <td>{{$newwarehouse->qtybox}}</td>
                      <td>{{$newwarehouse->lowstock_point}}</td>
                      <td>{{$newwarehouse->warehouse}}</td>
                      <td>@if($newwarehouse->status==1)
                            <a class="updateNewWarehouseStatus" id="newwarehouse-{{ $newwarehouse->id }}" newwarehouse_id="{{ $newwarehouse->id }}" href="javascript:void(0)" style="color:#007bff">Active</a>
                          @else
                            <a class="updateNewWarehouseStatus" id="newwarehouse-{{ $newwarehouse->id }}" newwarehouse_id="{{ $newwarehouse->id }}" href="javascript:void(0)" style="color:#ff0000">Inactive</a>
                          @endif
                      </td>
                      <td style="display: inline-flex;"> 
                        <a title="EDIT PRODUCT" href="{{ url('admin/add_edit_mainwarehouse/'.$newwarehouse->id )}}"><i class="far fa-edit text-blue fa-spin" style="font-size:15px;"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="VIEW PRODUCT ADDED TRANSACTION" href="{{ url('admin/view_product_transaction_mainwarehouse/'.$newwarehouse->id )}}"><i class="far fa-eye text-orange fa-spin" style="font-size:15px;"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="ADD NEW ORDER" href="{{ url('admin/add_new_order/'.$newwarehouse->id )}}"><i class="fas fa-pen text-purple fa-spin" style="font-size:15px;"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a title="VIEW PRODUCT TAKEN TRANSACTION" href="{{ url('admin/view_product_taken_transaction/'.$newwarehouse->id )}}"><i class="fas fa-share-square text-green fa-spin" style="font-size:15px;"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp; 
                        <a title="DELETE PRODUCT" href="javascript:void(0)" class="confirmDelete" record="mainwarehouse" recordid="{{ $newwarehouse->id }}"><i class="fas fa-trash-alt text-red fa-spin" style="font-size:15px;"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
                    <tfoot>
                        <th>No.</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Category Name</th>
                        <th>Supplier Name</th>
                        <th>Tot Qty Avail.(Ctns/Cylns)</th>
                        <th>Add. Qty(pcs)</th>
                        <th>Tot Qty Avail.(PCS)</th>
                        <th>Qty (Ctns)</th>
                        <th>Low Stock</th>
                        <th>Warehouse</th>
                        <th>Status</th>
                        <th>Options</th>
                    </tfoot>
              </table>
        </div>
      </div>
    </div>
</div>
<!-- </div> -->




@endsection