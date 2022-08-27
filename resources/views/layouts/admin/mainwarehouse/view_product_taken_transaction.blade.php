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
              @if(!empty($getProductTakenName['id']))
                <legend>
                        <center>
                        <h2>
                            {{ $getProductTakenName->mainwarehouse['main_product_name'] }}   ----  {{ $getProductTakenName->mainwarehouse['product_code'] }}
                        </h2>
                        </center>
                </legend>
                @endif
                <table id="mainwarehouseTransTaken" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Taken By</th>
                            <th>Action</th>
                            <th>Qty Taken (Ctns/Cylns)</th>
                            <th>Add. Qty Taken (pcs)</th>
                            <th>Tot Qty (pcs)</th>
                            <th>Date Taken</th>
                            <th>Request Status</th>
                            <th>Warehouse</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($viewProducts as $viewProduct)
                      
                          <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$viewProduct->users->name}}</td>
                            <td>{{$viewProduct->action}}</td>
                            <td>{{$viewProduct->qty_takenctn}}</td>
                            <td>{{$viewProduct->stockrequest->additional_qty_requested}}</td>
                            <td>{{$viewProduct->qty_takenpcs}}</td>
                            <td>{{date("jS M., Y  H:i:s",strtotime($viewProduct->date_taken))}}</td>
                            <td>{{$viewProduct->stockrequest->request_status}}</td>
                            <td>{{$viewProduct->mainwarehouse->warehousename->name}}</td>
                            <td>
                                
                              <a href="javascript:void(0)" class="confirmDelete" record="mainwarehouseLogTaken" recordid="{{ $viewProduct->id }}"><i class="fas fa-trash-alt text-red fa-spin" ></i></a>
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Taken By</th>
                            <th>Action</th>
                            <th>Qty Taken (Ctns/Cylns)</th>
                            <th>Add. Qty Taken (pcs)</th>
                            <th>Tot Qty (pcs)</th>
                            <th>Date Taken</th>
                            <th>Request Status</th>
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