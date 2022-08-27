@extends('layouts.salesLayout.sales_design')
@section('content')


  <div class="col-sm-6 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/sales/dashboard') }}"><i class="ri-home-8-line mr-1 float-left"></i>Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/sales/stocks') }}"><i class="ri-user-line mr-1 float-left"></i>Stocks</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Price List</li>
        </ol>
      </nav>
  </div>
  <br><br><br><br>
  <div class="col-sm-12">
    <div class="card">


            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title mb-3"><i class="nav-icon far fa-circle text-blue"> </i> Product Price List</h4>
                </div>
                <!-- <button class="btn btn-sm btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addStock" data-backdrop="static">
                    <i class="fas fa-plus"></i>
                    Add
                </button> -->
            </div>
           
            <div class="card-body">

             <p class="mb-0">This is where you check all your PRODUCT PRICES</p><br><br>

              <div class="table-responsive rounded mb-3">
                <table id="pricelist" class="table data-table mb-0 table-bordered table-striped table-hover table-condensed">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty Remaining (pcs)</th>
                            <th>Wholesale Price(GHC)</th>
                            <th>Retail Price(GHC)</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach($viewprices as $price)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $price->product_code }}</td>
                                <td>{{ $price->product_name }}</td>
                                <td style="text-align:center">{{ $price->product_qty }}</td>
                                <td style="text-align:right">{{ number_format( $price->product_wholesale_price,2) }}</td>
                                <td style="text-align:right">{{ number_format( $price->product_price,2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Qty Remaining (pcs)</th>
                            <th>Wholesale Price(GHC)</th>
                            <th>Retail Price(GHC)</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        
      </div>
    </div>
  
@endsection