@extends('layouts.salesLayout.sales_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Details of Daily Sales</li>
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
                    <h4 class="card-title mb-3"><i class="nav-icon fas fa-users text-blue"> </i> Sales Made For Today</h4>
                </div>
                <!-- <a class="btn btn-sm btn-primary btn-round ml-auto" href="{{ url('sales/lowstockrequest') }}">
                    <i class="fas fa-eye"></i>
                    View Requests
                </a> -->
            </div>
           
            <div class="card-body">

              <div class="table-responsive ">
                <table id="lowstocks" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Receipt No.</th>
                            <th>Customer's Name</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price (GHC)</th>
                            <th>Discount (GHC)</th>
                            <th>New Price (GHC)</th>
                            <th>Total Amt (GHC)</th>
                            <th>Date of Sales</th>
                            <th>Sales Attendant</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($salesdetails as $sales)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sales->receipt_no }}</td>
                                <td>{{ $sales->customer_name }}</td>
                                <td>{{ $sales->products->product_name }}</td>
                                <td>{{ $sales->qty_bought }}</td>
                                <td style="text-align:right">{{ number_format($sales->price,2) }}</td>
                                <td style="text-align:right">
                                    @if($sales->discount == "")
                                        {{ "0.00" }}
                                    @else 
                                        {{ number_format($sales->discount,2) }}
                                    @endif
                                </td>
                                <td style="text-align:right">{{ number_format($sales->newprice,2) }}</td>
                                <td style="text-align:right">{{ number_format($sales->sub_total,2) }}</td>
                                <td>{{ $sales->transaction_date }}</td>
                                <td>{{ $sales->user_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Receipt No.</th>
                            <th>Customer's Name</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price (GHC)</th>
                            <th>Discount (GHC)</th>
                            <th>New Price (GHC)</th>
                            <th>Total Amt (GHC)</th>
                            <th>Date of Sales</th>
                            <th>Sales Attendant</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
              


@endsection