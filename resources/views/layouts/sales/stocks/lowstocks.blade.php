@extends('layouts.salesLayout.sales_design')
@section('content')

<?php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Products;

    $countlowstock = Products::countlowstock();
    // dd($countlowstock); die;
?>


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/stocks') }}"><i class="ri-user-line mr-1 float-left"></i>Product Stocking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Low Stock (s) List</li>
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
                    <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i> Low Stock (s) List</h4>
                </div>
                <a class="btn btn-sm btn-primary btn-round ml-auto" href="{{ url('sales/lowstockrequest') }}">
                    <i class="fas fa-eye"></i>
                    View Requests
                </a>
            </div>
           
            <div class="card-body">
             <div class="d-flex align-items-center" style="margin-left:550px">
                <span style="text-align: center;font-size: 20px;color: red;"><strong>ATTENTION PLEASE!</strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:20px">You have <span class="badge badge-danger" style="font-size:15px;font-weight:bolder">{{ $countlowstock }} </span> products that have low stock.</span>
            </div><br>
            <p class="mb-0">This is where you check all STOCKS WITH LOW QUANTITY.</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="lowstocks" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty(pcs) Left</th>
                            <th>Wholesale Price (GHC)</th>
                            <th>Retail Price (GHC)</th>
                            <th>Category</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($lowstocks as $low)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $low->product_code }}</td>
                                <td>{{ $low->product_name }}</td>
                                <td>{{ $low->product_qty }}</td>
                                <td>{{ number_format($low->product_wholesale_price, 2) }}</td>
                                <td>{{ number_format($low->product_price, 2) }}</td>
                                <td>{{ $low->category->category_name }}</td>
                                <td>
                                    <a href="#cancelRequest" title="Send Product Request" data-target="#sendRequest{{ $low->id }}" data-toggle="modal"  data-backdrop="static"><i class="fas fa-share text-green fa-fadeOut"></i></a>
                                </td>
                            </tr>



                                    <!-- Send Low Stock Request -->
                                    <div class="modal fade" id="sendRequest{{ $low->id }}" tabindex="-1" role="dialog" aria-labelledby="sendRequest" aria-hidden="true" style="background: rgba(0, 0, 0, 0.6)">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="sendRequest"><i class="far fa-edit text-blue"></i> Request New Stock (s)</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true" style="color: #ff0000;">×</span>
                                            </button>
                                            </div>

                                            <form action="{{ url('sales/sendrequest/'.$low->id ) }}" method="post">@csrf
                                                <div class="modal-body m-3">
                                                    <input type="hidden" class="form-control" id="warehouseid" name="warehouseid" value="{{ $low->warehouse->id }}" required> 
                                                    <input type="hidden" class="form-control" id="productid" name="productid" value="{{ $low->id }}" required> 

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="" for="qtypcs">Product Code</label>
                                                                <div class="input-group mb-2 mr-sm-2">
                                                                    <input type="text" class="form-control" id="" name="" value="{{ $low->product_code }}"  disabled style="font-size:15px;font-weight:bolder"/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="" for="qtypcs">Quantity (CTN)</label>
                                                                <div class="input-group mb-2 mr-sm-2">
                                                                    <input type="text" class="form-control" id="" name="" value="{{ $low->warehouse->qtybox }}" disabled style="font-size:15px;font-weight:bolder"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="" for="qtypcs">Product Name</label>
                                                                <div class="input-group mb-2 mr-sm-2">
                                                                    <input type="text" class="form-control" id="" name="" value="{{ $low->product_name }}" disabled style="font-size:15px;font-weight:bolder"/>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="" for="qtypcs">Category Name</label>
                                                                <div class="input-group mb-2 mr-sm-2">
                                                                    <input type="text" class="form-control" id="" name="" value="{{ $low->category->category_name }}" disabled style="font-size:15px;font-weight:bolder"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="" for="qtyrequestctns">Quantity Requesting (CTNS)</label>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <input type="text" class="form-control" id="qtyrequestctns" name="qtyrequestctns" min="1" autocomplete="off" placeholder="Enter Quantity Requesting (CTNS)" />
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="" for="qtyrequestpcs">Quantity Requesting (PCS)</label>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <input type="text" class="form-control" id="qtyrequestpcs" name="qtyrequestpcs" min="1" autocomplete="off" placeholder="Enter Quantity Requesting (PCS)" />
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <label class="" for="addqtypcs">Additional Quantity Requesting (PCS)</label>
                                                        <div class="input-group mb-2 mr-sm-2">
                                                            <input type="text" class="form-control" id="addqtypcs" name="addqtypcs" autocomplete="off" placeholder="Enter Additional Quantity Requesting (PCS)" />
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="modal-footer">
                                                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">
                                                        <i class="fas fa-times text-white fa-spin"> </i> &nbsp;&nbsp;
                                                        Cancel Request
                                                    </button>
                                                    <button class="btn btn-sm btn-primary" type="submit" >
                                                        <i class="fas fa-paper-plane text-white"> </i> &nbsp;&nbsp;
                                                        Send Request
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- End of Send Low Stock Request -->

                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty(pcs) Left</th>
                            <th>Wholesale Price (GHC)</th>
                            <th>Retail Price (GHC)</th>
                            <th>Category</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              



  
@endsection