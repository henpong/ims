@extends('layouts.adminLayout.admin_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i class="ri-home-4-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Low Stock Request</li>
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
                        <h4 class="card-title mb-3"><i class="nav-icon fas fa-sync-alt text-red"> </i> Low Stock Request</h4>
                     </div>
                     <!-- <a href="#" class="btn btn-primary add-list"><i class="fas fa-plus mr-3"></i>Add </a> -->
                  </div>
           
            <div class="card-body">

             <p class="mb-0">This is where you take decisions on the REQUEST sent by users.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="stockrequest" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
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
                            <th>Qty (ctns) <br>Requested</th>
                            <th>Add. Qty (pcs) <br>Requested</th>
                            <th>Total Qty (pcs) <br>Requested</th>
                            <th>Price (GHC)</th>
                            <th>Date <br>Requested</th>
                            <th>Requested By</th>
                            <th>Branch Name</th>
                            <th>Request Status</th>
                            <th>Stock Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody >
                      @foreach($stockrequests as $stock)
                            <tr >
                                <td>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkdelete" name="checkdelete">
                                        <label for="checkdelete" class="mb-0"></label>
                                    </div>
                                </td>
                                  <td>{{$loop->iteration}}</td>
                                  <td>{{$stock->products->product_code}}</td>
                                  <td>{{$stock->products->product_name}}</td>
                                  <td>{{$stock->qty_requestedCTNS}}</td>
                                  <td>{{$stock->additional_qty_requested}}</td>
                                  <td>{{$stock->qty_requestedPCS}}</td>
                                  <td>{{ number_format($stock->products->product_price,2) }}</td>
                                  <td>{{date("jS F, Y  H:i:s", strtotime($stock->date_requested))}}</td>
                                  <td>{{$stock->requested_by}}</td>
                                  <td>{{$stock->branch->branch_name}}</td>
                                  <td>
                                    @if($stock->request_status == "Pending")
                                        <span style=color:#FF0000;font-weight:bold;>{{$stock->request_status}}</span>
                                    @elseif($stock->request_status == "Approved")
                                        <span style=color:#006b06;font-weight:bold;>{{$stock->request_status}}</span>
                                    @else
                                        <span class="badge badge-danger" style="font-weight:bold;">{{$stock->request_status}}</span>
                                    @endif
                                  </td>
                                  <td>
                                    @if($stock->status_id == 1)
                                        <span style=color:#EC4909;font-weight:bold;>Not Stocked</span>
                                    @elseif($stock->status_id == 4)
                                        <span style=color:#006b06;font-weight:bold;>Stocked</span>
                                    @else 
                                        <span style=color:#FF0000;font-weight:bold;>Rejected</span>
                                    @endif 
                                  </td>
                                  <td>
                                    @if($stock->request_status == "Pending")
                                      <div class="d-flex align-items-center list-action">
                                          <a  data-toggle="modal" data-placement="top" title="Take Decision" data-original-title="Edit"
                                              href="#approveLowstockRequest" data-target="#approveLowstockRequest" data-request_id="{{ $stock->id }}" data-request_status="{{ $stock->request_status }}"><i class="fas fa-pencil-alt mr-0" style="font-size:20px;padding-top:1px;"></i></a>
                                          
                                      </div>
                                      
                                    @endif
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
                            <th>Qty (ctns) <br>Requested</th>
                            <th>Add. Qty (pcs) <br>Requested</th>
                            <th>Total Qty (pcs) <br>Requested</th>
                            <th>Price (GHC)</th>
                            <th>Date <br>Requested</th>
                            <th>Requested By</th>
                            <th>Branch Name</th>
                            <th>Request Status</th>
                            <th>Stock Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              
@include('layouts.admin.stocks.modal.stock_request_decision')
  
@endsection