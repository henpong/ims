@extends('layouts.adminLayout.admin_design')
@section('content')




  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}"><i class="ri-notification-line mr-1 float-left"></i>Products</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mainwarehouse') }}"><i class="ri-notification-line mr-1 float-left"></i>Main Warehouse</a></li>
            <li class="breadcrumb-item active" aria-current="page">Main Warehouse - Transactions</li>
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
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-home text-blue"> </i> Transactions In Main Warehouse</h4>
                     </div>
                     <!-- <button type="button" class="btn btn-primary btn-sm add-list" data-toggle="modal" data-target="#AddProduct" title="Add Product In Various Branch"><i class="fas fa-plus"> </i> Add</button> -->
                     <!-- <a href="{{url('/admin/add_edit_products_in_branches')}}" class="btn btn-primary btn-sm add-list" data-toggle="modal" data-target=".update-product" data-toggle="tooltip" data-placement="top" data-original-title="Add New Product In Branch"><i class="fas fa-plus mr-3"></i>Add </a> -->
                  </div>
           
            <div class="card-body">

             <p class="mb-0">View all transactions in the Warehouse</p><br><br>

              <div class="table-responsive rounded mb-3">

              <!-- Display Product Name And Code Here  -->
              @if(!empty($getProductName['id']))
                <legend>
                        <center>
                        <h2>
                            {{ $getProductName->mainwarehouse['main_product_name'] }}   ----  {{ $getProductName->mainwarehouse['product_code'] }}
                        </h2>
                        </center>

                        <li class="dropdown-divider" style="color:#000000;font-weight:bolder"></li>
                </legend>
                @endif
                <table id="mainwarehouseTrans" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Added By</th>
                            <th>Action</th>
                            <th>Category Name</th>
                            <th>Brand Name</th>
                            <th>Qty Added (Ctns)</th>
                            <th>Add. Qty <br>Added (pcs)</th>
                            <th>Tot Qty (pcs)</th>
                            <th>Units</th>
                            <th>Date Added</th>
                            <th>Supplier Name</th>
                            <th>Warehouse</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($transact as $trans)
                          @if(isset($trans))
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$trans->admins->name}}</td>
                            <td>{{$trans->action}}</td>
                            <td>{{$trans->category->category_name}}</td>
                            <td>{{$trans->brandname->brand_name}}</td>
                            <td>{{$trans->qty_addctn}}</td>
                            <td>{{$trans->additional_qty}}</td>
                            <td>{{$trans->total_qtypcs}}</td>
                            <td>{{$trans->unitname->unit_name}}</td>
                            <td>{{date("jS M., Y  H:i:s",strtotime($trans->date_added))}}</td>
                            <td>{{$trans->supplier->supplier_name}}</td>
                            <td>{{$trans->warehousename->name}}</td>
                            <td>
                              
                              <a href="javascript:void(0)" class="confirmDelete" record="mainwarehouseLog" recordid="{{ $trans->id }}"><i class="fas fa-trash-alt text-red fa-spin" ></i></a>
                            </td>
                          </tr>
                          @endif
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Added By</th>
                            <th>Action</th>
                            <th>Category Name</th>
                            <th>Brand Name</th>
                            <th>Qty Added (Ctns)</th>
                            <th>Add. Qty <br>Added (pcs)</th>
                            <th>Tot Qty (pcs)</th>
                            <th>Units</th>
                            <th>Date Added</th>
                            <th>Supplier Name</th>
                            <th>Warehouse</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              

@endsection