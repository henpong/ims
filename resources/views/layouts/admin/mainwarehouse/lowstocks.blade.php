@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/branches') }}"><i class="ri-home-line mr-1 float-left"></i>Branches</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/mainwarehouse') }}"><i class="ri-notification-line mr-1 float-left"></i>Warehouse</a></li>
            <li class="breadcrumb-item active" aria-current="page">Low Stocks In Warehouse</li>
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
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-home text-blue"> </i> Low Stocks In Warehouse</h4>
                     </div>
                     <!-- <button type="button" class="btn btn-primary btn-sm add-list" data-toggle="modal" data-target="#addCategory" title="Add New Category"><i class="fas fa-plus"> </i> Add</button> -->
                     <!-- <a href="{{url('/admin/add_edit_category')}}" class="btn btn-primary btn-sm add-list" data-toggle="tooltip" data-placement="top" data-original-title="Add New Category"><i class="fas fa-plus mr-3"></i>Add </a> -->
                  </div>
           
            <div class="card-body">

             <p class="mb-0">You can view Low Stocks In Warehouse</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="lowstock" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>
                                <div class="checkbox d-inline-block">
                                    <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                    <label for="checkdelete" class="mb-0"></label>
                                </div>
                            </th>
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Total Qty Available (Ctns/Cylns)</th>
                            <th>Additional Qty(pcs)</th>
                            <th>Total Qty Available (PCS)</th>
                            <th>Qty (Ctns)</th>
                            <th>Warehouse</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                      @foreach($lowproducts as $mainwarehouse)
                          <tr >
                              <td>
                                  <div class="checkbox d-inline-block">
                                      <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                      <label for="checkdelete" class="mb-0"></label>
                                  </div>
                              </td>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$mainwarehouse->product_code}}</td>
                              <td>{{$mainwarehouse->main_product_name}}</td>
                              <td style="text-align:center">{{$mainwarehouse->newprod_qtyctn}}</td>
                              <td style="text-align:center">{{$mainwarehouse->addprod_qtypcs}}</td>
                              <td style="text-align:center">{{$mainwarehouse->total_prodqtypcs}}</td>
                              <td style="text-align:center">{{$mainwarehouse->qtybox}}</td>
                              <td>{{$mainwarehouse->warehouse}}</td>
                              <td>
                                <a href="javascript:void(0)" style="color:#ff0000">Low Stock</a>
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
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Total Qty Available (Ctns/Cylns)</th>
                            <th>Additional Qty(pcs)</th>
                            <th>Total Qty Available (PCS)</th>
                            <th>Qty (Ctns)</th>
                            <th>Warehouse</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              


@endsection