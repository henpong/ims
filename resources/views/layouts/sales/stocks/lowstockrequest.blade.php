@extends('layouts.salesLayout.sales_design')
@section('content')

<?php
   // use App\Models\Products;

    // $getlowproducts = Products::getlowproducts();
    // dd($getlowproducts); die;
?>


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/lowstock') }}"><i class="ri-user-line mr-1 float-left"></i>Low Stocks</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/stocks') }}"><i class="ri-user-line mr-1 float-left"></i>Stocks</a></li>
            <li class="breadcrumb-item active" aria-current="page">Low Stock Request(s) List</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">


            <!-- Display Error Messages In a Loop -->
            @if ($errors->any())
                  <div class="alert bg-danger" style="margin-top:10px;">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                 @endif

            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i> Low Stock Request(s) List</h4>
                </div>
                <!-- <a class="btn btn-sm btn-primary btn-round ml-auto" href="{{ url('sales/lowstockrequest') }}">
                    <i class="fas fa-eye"></i>
                    View Requests
                </a> -->
            </div>
           
            <div class="card-body">

            <p class="mb-0">This is where you check all STOCKS REQUESTED.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="lowstockrequested" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty(ctns) <br>Requested</th>
                            <th>Qty(pcs) <br>Requested</th>
                            <th>Add. Qty(pcs) <br>Requested</th>
                            <th>Requested By</th>
                            <th>Date / Time Requested</th>
                            <th>Request Status</th>
                            <th>Stock Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($lowstockrequest as $lowstock)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lowstock->products->product_code }}</td>
                                <td>{{ $lowstock->products->product_name }}</td>
                                <td>{{ $lowstock->qty_requestedCTNS }}</td>
                                <td>{{ $lowstock->qty_requestedPCS }}</td>
                                <td>{{ $lowstock->additional_qty_requested }}</td>
                                <td>{{ $lowstock->requested_by }}</td>
                                <td>{{ date("jS F, Y H:i:s",strtotime($lowstock->date_requested)) }}</td>
                                <td>
                                    @if( $lowstock->request_status == "Pending")
                                        <span style=color:#FF0000;font-weight:bold;>{{ $lowstock->request_status}}</span>
                                    @elseif( $lowstock->request_status == "Approved")
                                        <span style=color:#006b06;font-weight:bold;>{{ $lowstock->request_status}}</span>
                                    @else
                                        <span class="badge badge-danger" style="font-weight:bold;">{{ $lowstock->request_status}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if( $lowstock->status_id == 1)
                                        <span style=color:#EC4909;font-weight:bold;>Not Stocked</span>
                                    @elseif( $lowstock->status_id == 4)
                                        <span style=color:#006b06;font-weight:bold;>Stocked</span>
                                    @else 
                                        <span style=color:#FF0000;font-weight:bold;>Rejected</span>
                                    @endif 
                                </td>
                                <td>
                                    @if( $lowstock->request_status == "Pending")
                                        <a href="#cancelRequest" title="Cancel Request" data-target="#cancelRequest{{ $lowstock->id }}" data-toggle="modal"  data-backdrop="false"><i class="fas fa-times text-red fa-spin"></i></a>
                                    @endif
                                </td>
                            </tr>



                                <!-- Cancel Low Stock Request -->
                                <div class="modal fade" id="cancelRequest{{ $lowstock->id }}" tabindex="-1" role="dialog" aria-labelledby="cancelRequest" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="cancelrequest"><i class="fas fa-times text-red"></i> CANCEL REQUEST (S)</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true" style="color: #ff0000;">×</span>
                                                    </button>
                                                </div>

                                                <form action="{{ url('sales/cancelrequest/'.$lowstock->id ) }}" method="post">@csrf

                                                    <div class="modal-body m-3" style="max-height:450px; overflow:auto;">


                                                        <p>Are you sure you want to cancel this request ?</p>

                                                        <!-- Get the stock request id -->
                                                        <input type="hidden" name="requestId" value="{{ $lowstock->id }}">
                                                        <!-- Get the product id -->
                                                        <input type="hidden" name="productId" value="{{ $lowstock->products->id }}">
                                                        <!-- Get the request status -->
                                                        <input type="hidden" name="requestStatus" value="{{ $lowstock->request_status }}">


                                                    </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                                                                <i class="fas fa-times text-white fa-spin"> </i> &nbsp;&nbsp;
                                                                No
                                                            </button>
                                                            <button class="btn btn-sm btn-primary" type="submit" >
                                                                <i class="fas fa-paper-plane text-white"> </i> &nbsp;&nbsp;
                                                                Yes
                                                            </button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Cancel Low Stock Request -->

                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty(ctns) <br>Requested</th>
                            <th>Qty(pcs) <br>Requested</th>
                            <th>Add. Qty(pcs) <br>Requested</th>
                            <th>Requested By</th>
                            <th>Date / Time Requested</th>
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
              



  
@endsection